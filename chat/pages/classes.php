<?php

class user{
    private $UserId,$UserFirstName,$UserLastName,$UserMail,$UserPassword;
    
    public function getUserId(){
        return $this->UserId;
    }
    public function setUserId($UserId){
        $this->UserId = $UserId;
    }
    
    public function getUserFirstName(){
        return $this->UserFirstName;
    }
    public function setUserFirstName($UserFirstName){
        $this->UserFirstName = $UserFirstName;
    }
    
    public function getUserLastName(){
        return $this->UserLastName;
    }
    public function setUserLastName($UserLastName){
        $this->UserLastName = $UserLastName;
    }
    
    public function getUserMail(){
        return $this->UserMail;
    }
    public function setUserMail($UserMail){
        $this->UserMail = $UserMail;
    }
    
    public function getUserPassword(){
        return $this->UserPassword;
    }
    public function setUserPassword($UserPassword){
        $this->UserPassword = $UserPassword;
    }
    
    public function insertUser(){
        include "conn.php";
        $req=$concon->prepare("INSERT INTO users (UserName,UserMail,UserPassword) VALUES (:UserName,:UserMail,:UserPassword)");
        $req->execute(array(
            'UserName'=>$this->getUserName(),
            'UserMail'=>$this->getUserMail(),
            'UserPassword'=>$this->getUserPassword()
        ));
        header("Location: ../index.php?success=1");
    }
    
    public function userLogin(){
        include "conn.php";
        $req=$concon->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $req->execute(array(
            'email'=>$this->getUserMail(),
            'password'=>$this->getUserPassword()
        ));
        if($req->rowCount() > 0){
            while($data = $req->fetch()){
                $this->setUserId($data['id']);
                $this->setUserFirstName($data['first_name']);
                $this->setUserLastName($data['last_name']);
                $this->setUserMail($data['email']);
                $this->setUserPassword($data['password']);
                header("Location: Home.php?ChatFriendId=5");
                return true;
            }
        }else{
            header("Location: ../index.php?error=1");
            return false;
        }
    }
    
    public function getUserInfo($type,$val){
     include "conn.php";
    $stmt = $concon->prepare("SELECT * FROM users WHERE id = ? ");
    
        $stmt->execute(array($val));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
      return $row[''.$type.''];  
    }else{
    return null; 
    }
}
}

class arr{
     private $x ,$counter;
    public function init(){
        $this->x = array(0,0,0);
        $this->counter=0;
    }
    public function add($item){
        $this->x[$this->counter]=$item;
        $this->counter++;
    }
    
    public function getItem($i){
        return $this->x[i];
    }
    
    public function getCounter(){
        return $this->counter;
    }
    
    public function isEmpty(){
        if($this->counter == 0){
            return true;
        }else{
            return false;
        }
        return false;
    }
}

class chatMesenger{
    private $UserId,$friendid,$Text,$Time,$friendsList,$counter;
    public function getUserId(){
        return $this->UserId;
    }
    public function setUserId($UserId){
        $this->UserId = $UserId;
    }
    
    public function getFriendId(){
        return $this->friendid;
    }
    public function setFriendId($id){
        $this->friendid = $id;
    }
    
    public function getText(){
        return $this->Text;
    }
    public function setText($Text){
        $this->Text = $Text;
    }
    
    public function getTime(){
        return $this->Time;
    }
    public function setTime($Time){
        $this->Time = $Time;
    }
    
    public function initFriendsList(){
        $this->friendsList = array(0,0,0);
        //$this->friendsList->init();
        $this->counter=3;
    }
    public function getFriendsList(){
        return $this->friendsList;
    }
    public function addFriendToList($id){
        $this->friendsList->add($id);
        $this->counter++;
    }
    public function isEmpty(){
        if($this->counter == 0){
            return true;
        }else{
            return false;
        }
        
    }
    
   /* public function init(){
        $this->x = array(0,0,0);
        $this->counter=0;
    }*/
    public function addItem($item){
        $this->friendsList[$this->counter]=$item;
        $this->counter++;
    }
    
    public function getItem($i){
        return $this->friendsList[$i];
    }
    
    public function createChatMesenger($friendid){
        include "conn.php";
        $stmt = $con->prepare("INSERT INTO realTimeChats VALUES(?,?,?,?) ");
        $stmt->execute(array(null,$friendid,'test',1));

    }
    public function displayChatMesenger($id){
        include "conn.php";
        $stmt1 = $con->prepare("SELECT * FROM test WHERE active=? LIMIT 3");
        $stmt1->execute(array(1));
        $count1 = $stmt1->rowCount();
        while($row1 = $stmt1->fetch()){
            $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
            $stmt->execute(array($row1["user_id"]));
            $row = $stmt->fetch();
           echo'<li>
                    <div id="mesenger_user_'.$row["id"].'">
                        <div class="friend-img-cont"><img src="'.$row["user_img"].'"/></div>
                        <i class="fa fa-circle online-i"></i>
                    </div>
                </li>'; 
        }
    }//for delete
    
    public function displayMessageType2(){
        include "conn.php";
        $ChatReq=$con->prepare("SELECT * FROM chats WHERE (ChatUserId = ? AND ChatFriendId = ?) OR (ChatFriendId = ? AND ChatUserId = ?)");
        $ChatReq->execute(array( $this->UserId , $this->friendid , $this->UserId , $this->friendid));
        while($DataChat=$ChatReq->fetch()){
            $UserReq=$con->prepare("SELECT * FROM users WHERE id = :id OR id = :id");
            $UserReq->execute(array(
                'id'=>$DataChat['ChatUserId'],
                'id'=>$DataChat['ChatFriendId']
            )); 
            $DataUser=$UserReq->fetch();
           
            
            if($DataChat['ChatFriendId'] == $_SESSION['userID']) {
                $class='friend';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li style=" width: 75%;float: right;text-align: right;display: inline-grid;">
                    <div class="message-info" style="float: right; display: contents;">
                      <span class="message-info-time right" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' " style="display: inline-block; width: 100%;">
                    
                        <div class="message-info-img right" style="display: inline-block;"><img src="'.$row['user_img'].'" /></div>
                       <div class="message" style="float: right;">'.$DataChat['ChatText'].'</div> 
                    </div>
                </li>
                ';
            }
            elseif($DataChat['ChatUserId'] == $_SESSION['userID']) {
                $class='self';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li style="width: 75%; float: left;text-align: left;display: inline-grid;">
                    <div class="message-info" style="display: contents;">
                      <span class="message-info-time left" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' " style="/*display: inline-block;*/ width: 100%;">
                        <div class="message-info-img left" style="display: inline-table; float: left;"><img src="'.$row['user_img'].'" /></div>
                        <div class="message" style="float: left;">'.$DataChat['ChatText'].'</div>
                    </div>
                </li>
                ';
            }
            
        }
    }

    
    
public function createChatMesengerBox($id){
    ?>
    <ul class="mesenger-submenu submenu-hide" id="mesenger_submenu_<?php echo $id ?>" >
            <div >
                <?php
                include "conn.php";
        $ChatReq=$con->prepare("SELECT * FROM chats WHERE (ChatUserId = ? AND ChatFriendId = ?) OR (ChatFriendId = ? AND ChatUserId = ?)");
        $ChatReq->execute(array( $this->UserId , $this->friendid , $this->UserId , $this->friendid));
        while($DataChat=$ChatReq->fetch()){
            $UserReq=$con->prepare("SELECT * FROM users WHERE id = :id OR id = :id");
            $UserReq->execute(array(
                'id'=>$DataChat['ChatUserId'],
                'id'=>$DataChat['ChatFriendId']
            )); 
            $DataUser=$UserReq->fetch();
           
            
            if($DataChat['ChatFriendId'] == $_SESSION['userID']) {
                $class='friend';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li style=" width: 75%;float: right;text-align: right;display: inline-grid;">
                    <div class="message-info" style="float: right; display: contents;">
                      <span class="message-info-time right" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' " style="display: inline-block; width: 100%;">
                    
                        <div class="message-info-img right" style="display: inline-block;"><img src="'.$row['user_img'].'" /></div>
                       <div class="message" style="float: right;">'.$DataChat['ChatText'].'</div> 
                    </div>
                </li>
                ';
            }
            elseif($DataChat['ChatUserId'] == $_SESSION['userID']) {
                $class='self';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li style="width: 75%; float: left;text-align: left;display: inline-grid;">
                    <div class="message-info" style="display: contents;">
                      <span class="message-info-time left" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' " style="/*display: inline-block;*/ width: 100%;">
                        <div class="message-info-img left" style="display: inline-table; float: left;"><img src="'.$row['user_img'].'" /></div>
                        <div class="message" style="float: left;">'.$DataChat['ChatText'].'</div>
                    </div>
                </li>
                ';
            }
            
        }
           ?>
            <div class="clearfix"></div> 
            </div>
            <div class="message_input">
                <textarea id="sendMessage_<?php echo $id ?>" name="message_input_text"></textarea>
            </div>
        </ul>
<script type="text/javascript">
            $(document).ready(function(){
                $("#sendMessage_<?php  echo $id ?>").keydown(function(k){
                if(k.keyCode == 13){
                   
                   var ChatText = $("#sendMessage_<?php echo $id ?>").val().trim();
                        if(ChatText != null){

                            $.ajax({
                                type:'POST',
                                url:'chat/pages/InsertMesengerMsg.php?FID=<?php echo $id ?>',
                                data:{ChatText:ChatText},
                                success:function(){
                                     //alert(ChatText);
                                    //pop.play();
                                    $("#mesenger_submenu_<?php echo $id ?> .cont100").load("chat/pages/displayMesengerMsg.php?FID=<?php echo $id ?>");
                                    $("#sendMessage_<?php echo $id ?>").val("");
                                }
                            });
                        }
                }    
                });
                /*setInterval(function(){
                    $("#mesenger_submenu_<?php echo $id ?> .cont100").load("chat/pages/displayMesengerMsg.php?FID=<?php echo $id ?>");
                    
                },1000);*/
                    
            });
        </script>
<script type="text/javascript">
        $(function(){
           $("#mesenger_user_<?php echo $id ?>").click(function() {
                    $("#mesenger_submenu_<?php echo $id; ?>").toggleClass("submenu-hide");
                    $("#mesenger_user_<?php echo $id; ?>").toggleClass('friend_active');
            }); 
            $("#messenger_btn").click(function() {
                    $("#mesenger_submenu_<?php echo $id; ?>").addClass("submenu-hide");
            }); 
        });
    </script>
       <?php  
    
}
          
    public function insertChatMessage(){
        include "conn.php";
        $req=$con->prepare("INSERT INTO chats(ChatUserId,ChatText,ChatFriendId,ChatTime) VALUES (:ChatUserId,:ChatText,:ChatFriendId,:ChatTime)");
        $req->execute(array(
            'ChatUserId'=>$this->getUserId(),
            'ChatText'=>$this->getText(),
            'ChatFriendId'=>$this->getFriendId(),
            'ChatTime'=>$this->getTime()
        ));
    }
   } ?> 
    
    
     
    <?php
 


class chat{
    private $ChatId,$ChatUserId,$ChatText,$ChatTime,$FriendId;
    
    public function getChatId(){
        return $this->ChatId;
    }
    public function setChatId($ChatId){
        $this->ChatId = $ChatId;
    }
    
    public function getChatUserId(){
        return $this->ChatUserId;
    }
    public function setChatUserId($ChatUserId){
        $this->ChatUserId = $ChatUserId;
    }
    
    public function getChatText(){
        return $this->ChatText;
    }
    public function setChatText($ChatText){
        $this->ChatText = $ChatText;
    }
    
    public function getChatTime(){
        return $this->ChatTime;
    }
    public function setChatTime($ChatTime){
        $this->ChatTime = $ChatTime;
    }
    
    public function getChatFriendId(){
        return $this->FriendId;
    }
    public function setChatFriendId($FriendId){
        $this->FriendId = $FriendId;
    }
    
    public function insertChatMessage(){
        include "conn.php";
        $req=$con->prepare("INSERT INTO chats(ChatUserId,ChatText,ChatFriendId,ChatTime) VALUES (:ChatUserId,:ChatText,:ChatFriendId,:ChatTime)");
        $req->execute(array(
            'ChatUserId'=>$this->getChatUserId(),
            'ChatText'=>$this->getChatText(),
            'ChatFriendId'=>$this->getChatFriendId(),
            'ChatTime'=>$this->getChatTime()
        ));
    }
    function getUserInfo($type,$val){
     include "conn.php";
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
    
        $stmt->execute(array($val));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
      return $row[''.$type.''];  
    }else{
    return null; 
    }
}
    
    
    public function displayMessage($UID,$FID){
        include "conn.php";
        $ChatReq=$con->prepare("SELECT * FROM chats WHERE (ChatUserId = ? AND ChatFriendId = ?) OR (ChatFriendId = ? AND ChatUserId = ?)");
        $ChatReq->execute(array( $UID,$FID,$UID,$FID));
        while($DataChat=$ChatReq->fetch()){
            $UserReq=$con->prepare("SELECT * FROM users WHERE id = :id OR id = :id");
            $UserReq->execute(array(
                'id'=>$DataChat['ChatUserId'],
                'id'=>$DataChat['ChatFriendId']
            )); 
            $DataUser=$UserReq->fetch();
           
            
            if($DataChat['ChatFriendId'] == $_SESSION['userID']) {
                $class='friend';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                    <li id="ChatMessage" class="clearfix">
                    <div class="message-info ">
                    <div class="message-info-img float-right"><img src="../'.$row['user_img'].'" /></div>
                     <!-- <span class="message-info-name float-right" >'./*$cName.*/
                      '</span> <i class="fa fa-circle me float-right"></i>-->
                      <span class="message-info-time float-right" >'.$DataChat['ChatTime'].'</span> &nbsp; &nbsp;
                    </div>
                    <div class="message '.$class.' ">'.$DataChat['ChatText'].'</div><br/>';
            }
            elseif($DataChat['ChatUserId'] == $_SESSION['userID']) {
                $class='self';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                    <li id="ChatMessage" class="clearfix">
                    <div class="message-info ">
                    <div class="message-info-img float-left" ><img style="margin: 20px 0;" src="../'.$row['user_img'].'" /></div>
                   <!-- <i class="fa fa-circle me"></i>
                      <span class="message-info-name" >'.//$cName.
                      '</span> -->
                      <span class="message-info-time " style="margin-left: 30px;">'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message '.$class.' ">'.$DataChat['ChatText'].'</div><br/>';
            }
            
        }
    }
    
    public function displayMessageType2($UID,$FID){
        include "conn.php";
        $ChatReq=$con->prepare("SELECT * FROM chats WHERE (ChatUserId = ? AND ChatFriendId = ?) OR (ChatFriendId = ? AND ChatUserId = ?)");
        $ChatReq->execute(array( $UID,$FID,$UID,$FID));
        while($DataChat=$ChatReq->fetch()){
            $UserReq=$con->prepare("SELECT * FROM users WHERE id = :id OR id = :id");
            $UserReq->execute(array(
                'id'=>$DataChat['ChatUserId'],
                'id'=>$DataChat['ChatFriendId']
            )); 
            $DataUser=$UserReq->fetch();
           
            
            if($DataChat['ChatFriendId'] == $_SESSION['userID']) {
                $class='friend';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li>
                    <div class="message-info ">
                      <span class="message-info-time right" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' ">
                        <div class="message-info-img right"><img src="../'.$row['user_img'].'" /></div>
                        <div class="message">'.$DataChat['ChatText'].'</div>
                    </div>
                </li>
                ';
            }
            elseif($DataChat['ChatUserId'] == $_SESSION['userID']) {
                $class='self';
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $stmt->execute(array($DataChat['ChatUserId']));
                $row = $stmt->fetch();
                $cName = $row['first_name'].' '.$row['last_name'];
                echo '
                <li>
                    <div class="message-info ">
                      <span class="message-info-time right" >'.$DataChat['ChatTime'].'</span> 
                    </div>
                    <div class="message-content '.$class.' ">
                        <div class="message-info-img right"><img src="../'.$row['user_img'].'" /></div>
                        <div class="message">'.$DataChat['ChatText'].'</div>
                    </div>
                </li>
                ';
            }
            
        }
    }
}
?>