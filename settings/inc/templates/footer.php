
<div class="footer">
    <?php
            $x=array(0,0,0,0);
            static $wind=0;
            $counter1=0;
            $counter2=0;
            $stmt5 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
            $stmt5->execute(array( $userid, $userid));
            $row5 = $stmt5->fetch();
            $count5 = $stmt5->rowCount();
            if($count5 > 0){ ?>
        <div class="messenger">
            
        <span id="messenger_btn" ><i class="fa fa-wechat"></i></span>
            
        <div class="">
            <div class="messenger_form" style="overflow-x: visible; overflow-y: visible;">
                <ul class="mesenger-count">
                    <?php /*
                do{
                    $counter1++;
                    if($userid == $row5['friend_id']){
                        $friendid1 = $row5['user_id'];
                    }elseif($userid == $row5['user_id']){
                        $friendid1 = $row5['friend_id'];
                    }
                    $x[$counter1]=$friendid1;*/
                ?>
                     <!--<li>
                        <div id="mesenger_user_<?php //echo $counter1 ?>">
                            <div class="friend-img-cont"><img src="<?php //echo getUserInfo('user_img', $friendid1); ?>"/></div>
                            <i class="fa fa-circle online-i"></i>
                        </div>
                    </li>-->
                    <?php
                    
        //}while($row5 = $stmt5->fetch())            
        ?>
                </ul>   
            </div>
        </div>
            <?php 
                    $stmt5 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
                    $stmt5->execute(array( $userid, $userid));
                    $row5 = $stmt5->fetch();
                    $count5 = $stmt5->rowCount();
                    
                    do{
                        $counter2++;
                        if($userid == $row5['friend_id']){
                            $friendid1 = $row5['user_id'];
                        }elseif($userid == $row5['user_id']){
                            $friendid1 = $row5['friend_id'];
                        }
                    ?>
         <ul class="mesenger-submenu submenu-hide" id="mesenger_submenu_<?php echo ($counter2) ?>" >
            <div>
                
                <li>
                    <div class="message-info ">
                      <span class="message-info-time right" >02:50:00</span> 
                    </div>
                    <div class="message-content friend ">
                        <div class="message-info-img right"><img src="<?php echo getUserInfo('user_img', $friendid1); ?>" /></div>
                        <div class="message"><?php echo $row["ChatText"] ?></div>
                    </div>
                </li>
                <div class="clearfix"></div>
                <li>
                    <div class="message-info ">
                      <span class="message-info-time left" >02:51:00</span> 
                    </div>
                    <div class="message-content self">
                        <div class="message-info-img left"><img src="<?php echo getUserInfo('user_img', $userid); ?>" /></div>
                        <div class="message ">hi ahmad</div>
                    </div>
                </li>
                <div class="clearfix"></div>
                <li>
                    <div class="message-info ">
                      <span class="message-info-time right" >02:50:00</span> 
                    </div>
                    <div class="message-content friend ">
                        <div class="message-info-img right"><img src="<?php echo getUserInfo('user_img', $friendid1); ?>" /></div>
                        <div class="message">hi ahmad</div>
                    </div>
                </li>
                <div class="clearfix"></div>
                <li>
                    <div class="message-info ">
                      <span class="message-info-time left" >02:51:00</span> 
                    </div>
                    <div class="message-content self">
                        <div class="message-info-img left"><img src="<?php echo getUserInfo('user_img', $userid); ?>" /></div>
                        <div class="message ">hi ahmad</div>
                    </div>
                </li>
                
            </div>
            <div class="message_input">
                <textarea id="sendMessage_<?php echo $friendid1 ?>" name="message_input_text" placeholder="put Your Message"></textarea>
            </div>
        </ul>
             
          <?php
            }while($row5 = $stmt5->fetch())
            ?>
    </div>
    
  <?php } ?> 
    
    <script>
        $(function(){
            $("#messenger_btn").click(function(){
                $(this).toggleClass("btn_visited");
                    $(".mesenger-count").toggleClass("show_form");
                    $("#mesenger_submenu_1").addClass('submenu-hide');
                    $("#mesenger_submenu_2").addClass('submenu-hide');
                    $("#mesenger_submenu_3").addClass('submenu-hide');
            });
         /*   $("#mesenger_user_1").on('click blur focus',function(e) {
                if(e='click'){
                    <?php //$_SESSION['ChatFriendId']= $x[1];
                        //$wind=1;
                    ?>
                    alert(<?php// echo $wind ?>);
                    $("#mesenger_submenu_1").toggleClass('submenu-hide');
                    $("#mesenger_submenu_2").addClass('submenu-hide');
                    $("#mesenger_submenu_3").addClass('submenu-hide');
                    
                }
            });
            
            $("#mesenger_user_2").on('click blur focus',function(e) {
                if(e='click'){
                    
                    <?php //$_SESSION['ChatFriendId']= $x[2]; 
                        //$wind=2;
                    ?>
                    alert(<?php //echo $wind ?>);
                    $("#mesenger_submenu_2").toggleClass('submenu-hide');
                    $("#mesenger_submenu_1").addClass('submenu-hide');
                    $("#mesenger_submenu_3").addClass('submenu-hide');
            }});
            
            $("#mesenger_user_3").on('click blur focus',function(e) {
                if(e='click'){
                    
                    <?php //$_SESSION['ChatFriendId']= $x[3]; 
                        //$wind=3;
                    ?>
                    alert(<?php //echo $wind ?>);
                    $("#mesenger_submenu_3").toggleClass('submenu-hide');
                    $("#mesenger_submenu_1").addClass('submenu-hide');
                    $("#mesenger_submenu_2").addClass('submenu-hide');
            }});*/
        });
    </script>
   
    <script >
           /* $(document).ready(function(){
                $(".message_input #sendMessage_<?php //echo $_SESSION['ChatFriendId'] ?>").keydown(function(e){
                    if(e.keyCode == 13){
                        //alert();
                        var pop = new Audio();
                        pop.src = "chat/sounds/pop.mp3";
                        var ChatText = $("#sendMessage_<?php //echo $_SESSION['ChatFriendId'] ?>").val().trim();
                        if(ChatText != null){

                            $.ajax({
                                type:'POST',
                                url:'chat/pages/InsertMessage.php',
                                data:{ChatText:ChatText},
                                success:function(){
                                    pop.play();
                                    $("#mesenger_submenu_<?php //echo $wind ?>").load("chat/pages/displayMessageType2.php");
                                    $("#sendMessage_<?php //echo $_SESSION['ChatFriendId'] ?>").val("");
                                }
                            });
                        }
                    }
                });
                setInterval(function(){
                    $("#mesenger_submenu_<?php //echo $wind ?>").load("chat/pages/displayMessageType2.php");
                    
                },1000);
                
               /* if(true){
                    var msgAlert = new Audio();
                    msgAlert.src = "sounds/msgAlert.mp3";
                    msgAlert.play();
                }
            });*/
        </script>
        </div>
        <script src="<?php echo $js;?>jquery-3.3.1.min.js"></script>
        <script src="<?php echo $js;?>bootstrap.min.js"></script>
        <script src="<?php echo $js;?>backend.js"></script>

    </body>
</html>