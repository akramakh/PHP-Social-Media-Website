
<?php 
/* Main page with two forms: sign up and log in */
require 'inc/db.php';
session_start();
$pageTitle = 'My Messages';
include 'init.php';
include $tpl.'navbar.php';
if(isset($_SESSION['logged_in'])){
    $friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
    $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    //$friendid = 5;
    //$userid = 3;
    //isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $stmt1 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
    
        $stmt1->execute(array( $userid, $userid));
        $row1 = $stmt1->fetch();
        $count1 = $stmt1->rowCount();
        
        if($count1 > 0){
        
?>
<div >
    <div class="frinds-section">
        
        <?php do{
            if($userid == $row1['friend_id']){
                
                $friendid = $row1['user_id'];
                
            }elseif($userid == $row1['user_id']){
                
                $friendid = $row1['friend_id'];
                
            }
            ?>
            
        <a href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $friendid ?>')">
            <div class="user-photo">
                <img src="img/user-photo2.jpg"/>
            </div>
        </a>  
           
        <?php
           }while($row1 = $stmt1->fetch())
        ?>
    </div>
    
</div>

    <?php
        }
    /*
     //send message to friend
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['msgarea'])){
            $friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
            $msgarea   =   $_POST['msgarea'];
            if(!empty($msgarea)){
                
                // Insert into DB With This Info
                $stmt = $con->prepare("INSERT INTO
                messages(senderID, receiverID, content, send_date)
                VALUES(:zsenderID, :zreceiverID, :zcontent, :zsend_date)");
                $stmt->execute(array(
                    'zsenderID'     => $userid, 
                    'zreceiverID'   => $friendid, 
                    'zcontent'      => $msgarea, 
                    'zsend_date'    => '1/1/1997'
                ));

                
            }
        }
        }*/
    
    
    if(isset($friendid) && $friendid !== $userid){
        $friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
        $stmt = $con->prepare("SELECT * FROM messages WHERE (senderID = ? AND receiverID = ?) OR (receiverID = ? AND senderID = ?) ");
    
        $stmt->execute(array($userid, $friendid , $userid, $friendid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($count > 0){
        
?>
<div class="chatbox">
    <div class="chatlogs">
        
        <?php do{
             ?>
        <div class="chat 
               <?php if($row['receiverID'] == $userid) echo' friend';
                 elseif($row['senderID'] == $userid) echo' self';?>
                        ">
            <?php if($count > 0){ ?>
            <div class="user-photo">
                <img src="
                          <?php if($row['receiverID'] == $userid) echo'img/user-photo2.jpg';
                                elseif($row['senderID'] == $userid) echo'img/user-photo1.jpg';?>
                          "/>
            </div>
            <?php } ?>
            <p class="chat-message"><?php echo $row["content"] ?></p>
        </div>
        
         <?php  }while($row = $stmt->fetch())?>
    </div>
    
    <div class="chat-form">
        <form >
            <textarea name="msgarea" id="msgcontent"></textarea>
            <button type="submit" id="sendMsgBtn">Send</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        var uid = <?php echo $userid ?>;
         var fid = <?php echo $friendid ?>;
        $("#sendMsgBtn").click( function() {

            $("#msgcontent").load("send-message.php",{
                userid:  uid,
                friendid:  fid,
                msgarea: $("#msgcontent").val()
            });
            //$("#msgcontent").val('');
        });
    });
</script>
<?php }
    }else{
    }
    
   
    
    
    
    
}else {
    header("Location: index.php");
     }

 include $tpl."footer.php";?>
