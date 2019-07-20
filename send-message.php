<?php 
include "inc/db.php";
            $userid = isset($_POST['userid']) ? $_POST['userid'] : null;
            $friendid = isset($_POST['friendid']) ? $_POST['friendid'] : null;
            $msgarea   = isset($_POST['msgarea']) ? $_POST['msgarea'] : null;

            if(!empty($msgarea)){
?>
              
<?php
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

?>
         <div class="chat 
                           <?php if($row1['receiverID'] == $userid) echo' friend';
                             elseif($row1['senderID'] == $userid) echo' self';?>
                                    ">

                        <div class="user-photo">
                            <img src="
                                      <?php if($row1['receiverID'] == $userid) echo'img/user-photo2.jpg';
                                            elseif($row1['senderID'] == $userid) echo'img/user-photo1.jpg';?>
                                      "/>
                        </div>

                        <p class="chat-message"><?php echo $msgarea ?></p>
                    </div> 
        