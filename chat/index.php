<?php
include "pages/conn.php";
session_start();
$_SESSION['ChatFriendId'] = isset($_GET['friendID']) ? $_GET['friendID'] : null;
?>

        <link rel="stylesheet" type="text/css" href="style/style.css"/>
        <link rel='stylesheet' href='style/box.css'>
        <link rel="stylesheet" href="style/bootstrap.min.css">
        <link rel="stylesheet" href="style/font-awesome/css/font-awesome.min.css">

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#sendMessage").click(function(){
                    var pop = new Audio();
                    pop.src = "sounds/pop.mp3";
                    var ChatText = $("#ChatText").val().trim();
                    if(ChatText != null){
                        
                        $.ajax({
                            type:'POST',
                            url:'pages/InsertMessage.php',
                            data:{ChatText:ChatText},
                            success:function(){
                                pop.play();
                                $("#ChatMessage").load("pages/displayMessage.php");
                                $("#ChatText").val("");
                            }
                        });
                    }
                });
                setInterval(function(){
                    $("#ChatMessage").load("pages/displayMessage.php");
                    
                },1000);
                
                if(true){
                    var msgAlert = new Audio();
                    msgAlert.src = "sounds/msgAlert.mp3";
                    msgAlert.play();
                }
            });
        </script>


<?php 
require '../inc/db.php';
$pageTitle = 'My Messages';
include '../init.php';


function getFriendID($fid){
     global $con;
     global $userid;
    $stmt = $con->prepare("SELECT DISTINCT * FROM friends WHERE user_id = ? OR friend_id = ?");
    
        $stmt->execute(array( $userid, $userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
        if($userid == $row['friend_id']){
            $fid = $row['user_id'];
        }elseif($userid == $row['user_id']){
            $fid = $row['friend_id'];
        }
    }
    return $fid;            
}

if(isset($_SESSION['logged_in'])){
    $friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
    $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    ?>

    <div class="container-body">
    <div class="people-list" id="people-list">
      <div class="search">
        <input type="text" placeholder="search" />
        <i class="fa fa-search"></i>
      </div>
        <?php
        $stmt1 = $con->prepare("SELECT DISTINCT * FROM friends WHERE user_id = ? OR friend_id = ?");
    
        $stmt1->execute(array( $userid, $userid));
        $row1 = $stmt1->fetch();
        $count1 = $stmt1->rowCount();
        
        if($count1 > 0){?>
      <ul class="list">
          <?php do{
            if($userid == $row1['friend_id']){
            $friendid = $row1['user_id'];
        }elseif($userid == $row1['user_id']){
            $friendid = $row1['friend_id'];
        }
            //getFriendID($friendid);
            ?>
        <li class="clearfix">
            <a href="?friendID=<?php echo $friendid ?>">
              <img src="<?php echo '../'.getUserInfo('user_img',$friendid); ?>" style="width:50px; hieght:50px;" alt="avatar" />
              <div class="about">
                <div class="name"><?php echo getUserInfo('first_name',$friendid).' '.getUserInfo('last_name',$friendid);?></div>
                <div class="status">
                <?php if(getUserInfo('active',$friendid) == 1){
                    echo '<i class="fa fa-circle online"></i> online';
                }else{
                    echo '<i class="fa fa-circle offline"></i> offline';
                } ?>
                </div>
              </div>
            </a>
        </li>
          <?php
           }while($row1 = $stmt1->fetch())
        ?>
        </ul>
    </div>
    <?php
                       }
    if(isset($_GET['friendID']) && $_GET['friendID'] !== $userid){
        $friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
        $stmt = $con->prepare("SELECT * FROM chats WHERE (ChatUserId = ? AND ChatFriendId = ?) OR (ChatFriendId = ? AND ChatUserId = ?) ");
    
        $stmt->execute(array($userid, $friendid , $userid, $friendid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        
        
?>
        
    <div class="chat" >
      <div class="chat-header">
        <img src="<?php echo '../'.getUserInfo('user_img',$friendid); ?>" style="width:50px; hieght:50px;" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with">Chat with <b><?php echo getUserInfo('first_name',$friendid).' '.getUserInfo('last_name',$friendid); ?></b></div>
          <div class="chat-num-messages">Already <?php echo $count; ?> Messages  |  no new messages
          </div>
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      <?php if($count > 0){ ?>
      <div class="chat-box">
        <ul id="ChatMessage">
          <li  class="clearfix">
              <?php echo $row["ChatText"] ?> 
          </li>
        </ul>
        
      </div> <!-- end chat-history -->
      <?php }
?>
      
          <div class="input-message">
            <textarea name="message-to-send" id="ChatText" placeholder ="Type your message" rows="2"></textarea>

            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-file-image-o"></i>

            <button id="sendMessage">Send</button>

          </div> <!-- end chat-message -->

    </div> <!-- end chat -->
    <?php } ?>
  </div> <!-- end container -->



<?php } include "../".$tpl."footer.php"?>

<script src="../js/bootstrap.min.js"></script>

