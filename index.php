<?php 
session_start();
//include 'inc/db.php';
$pageTitle = 'Index';
require 'init.php';

if(!isset($_SESSION['logged_in'])){
    $pageTitle = 'Login';
   // require 'init.php';
   // include $tpl.'navbar-defualt.php';
    $noNavbar = 1;
    header("refresh:0; url=login-system");
    
}else{
    $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    $pageTitle = 'Index';
    include $tpl.'navbar.php';
    // require 'friends-section.php';
    $noNavbar = null;
    
    $stmt = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
    $stmt->execute(array( $userid, $userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
?>

<div class="container-floud">
<div class="container-temp"></div>    
    <div class="row">
        <div class="col-lg-4 ">
            <?php if($count > 0){ ?>
            <div class="container-friends-list">
                <ul>
                     <?php 
                    do{
                        if($userid == $row['friend_id']){
                            $friendid = $row['user_id'];
                        }elseif($userid == $row['user_id']){
                            $friendid = $row['friend_id'];
                        }
                        ?>
                    <li id="user_chat_mesenger_<?php echo $friendid ?>">
                        <a href="friend-area-section.php?friendID=<?php echo $friendid ?>">
                            <div class="friend-img-cont"><img src="<?php echo getUserInfo('user_img', $friendid); ?>"/></div>
                            <div class="friend-name-cont"><?php echo getUserInfo('first_name',$friendid) ?></div>
                            <i class="fa fa-circle online-i"></i>
                            <input type="hidden" id="friend_chat_<?php echo $friendid ?>" value="<?php echo $friendid ?>"/>
                        </a>
                    </li>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#user_chat_mesenger_<?php echo $friendid ?>").click(function(){
                                var friendid = $("#friend_chat_<?php echo $friendid ?>").val().trim();
                                //$(".mesenger-count").load("chat/pages/createUserMesenger.php?FID=<?php echo $friendid ?>");
                                $.ajax({
                                    type:'POST',
                                    url:'chat/pages/createUserMesenger.php?FID=<?php echo $friendid ?>',
                                    data:{FID : 3},
                                    success:function(){
                                        $(".mesenger-count").load("chat/pages/displayUserMesenger.php?FID=<?php echo $friendid ?>");
                                        alert(friendid);
                                       // pop.play();
                                    }
                            });
                            });
                        });
                    </script>    
                    <?php
                       }while($row = $stmt->fetch())
                    ?>
                   
                </ul>    
            </div>
            <?php } ?>
        </div>
        <div class="col-lg-4 ">
            <ul id="posts_list">
                <?php include "posts/display-posts.php"; ?> 
            </ul>
        </div>
        <div class="col-lg-4 ">
            <div class="container-post-edit">
                <div class="post-header">
                    <div class="post-img-cont" id="post_img_cont"><img src="<?php echo getUserInfo('user_img',$userid); ?>"/></div>
                    <div class="post-name-cont"><?php echo getUserInfo('username',$userid); ?></div>
                    <i class="fa fa-ellipsis-v post-i"></i>
                </div>
                <div id="post_image_viewer" href="#animatedModal" style="width:100%; overflow: hidden; display:none; margin:5px 0;">
                        <img id="edit_post_image" style="object-fit: contain; object-position: center; width: 100%; max-height: 500px;" src="img/5.jpg"/>
                    </div>
                    <textarea class="post-text" name="post-text" id="post_text" placeholder="Type Your Text Here To Post It ..."></textarea>
                    
                    <button  id="btn_post" class="btn btn-primary">Share <i class="fa fa-send"></i></button>
                    
                    <span style=" left: 110px;">
                        <i class="fa fa-video-camera"></i>
                        <input type="file" name="video_file" id="video_file"/>
                    </span>
                    <span>
                        <i class="fa fa-photo"></i>
                        <input type="file" name="photo_file" id="photo_file"/>
                    </span>
                   <!-- <input type="file"  name="file" id="file" /><i class="fa fa-photo"></i>-->
                <img src="" width="200" style="display:none;" />
            </div>
            
            
            <!--DEMO01-->
<div id="animatedModal">
    <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID -->


    <div class="modal-content">
        <form class="form-horizontal" action="#" method="post">
            <!-- Start Date of Birth Field -->
            <div class="row" style="margin:0;">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                        <div class="setting-header ">
                            <div class="img-cont"><img src="#"/></div>
                            <div class="name-cont">
                                <a href="profile.php" target="_blank" style=" " ></a>
                            </div>
                        </div>
                </div>
                <div class="col-lg-2"></div>
            </div>    
            <div class="row" style="margin:0 0 10px 0;">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <b class="col-lg-12 modal-para" style="text-align:center;">This Option will put your Account in unactive state AND You will NOT use any feature in this Application </b>
                </div>
                <div class="col-lg-1"></div>
            </div>    
                
        </form>

    </div>
    <div class="btn-modal-cont list-item"> 
        <button id="btn-continue-modal">Save & Share</button>
        <button id="btn-close-modal" class="close-animatedModal">Cancel</button>
    </div>
</div>
<script src="js/animatedModal.js"></script>
            
        </div>
    </div>
</div>
<script>
    //demo 01
    $("#post_image_viewer").animatedModal();
    
    $("#btn-continue-modal").click(function(){
        $.ajax({
            type:'POST',
            url:'edit-post.php',
            data:{
                post_id : 1
                 },
            success:function(){
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var flag = false;
        $(document).on('change','#photo_file', function(){
                //var tmppath = this.files[0].mozFullPath;
    
                var property = document.getElementById("photo_file").files[0];
                var image_name = property.name;
                var image_path = property.location;
                var image_extension = image_name.split(".").pop().toLowerCase();
                if(jQuery.inArray(image_extension, ['gif','png','jpg','jpeg']) == -1){
                    alert("its not an image !");
                }
                var image_size = property.size;
                if(image_size != 0){
                    flag = true;
                }
                if(image_size > 2000000){
                    alert("this image is too long !");
                }
                else{
                    var form_data = new FormData();
                    form_data.append("file", property);
                    $.ajax({
                        type:'POST',
                        url:'posts/upload.php',
                        data:form_data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        beforeSend:function(){
                           // var tmppath = URL.createObjectURL(event.target.files[0]);
                            //alert("uploading... ");
                            //$("img").fadeIn("fast").attr('src',tmppath);
                            //$("#edit_post_image").attr("src",tmppath);
                            //$("#post_image_viewer").slideDown(500);
                        },
                        success:function(data){
                            pop.play();
                            //$("#post_image_viewer").slideDown(500);
                            //alert("uploaded ");
                        }
                    });
                }
            });
        
        $("#post_img_cont").click(function(){
            
           // $("#post_image_viewer").slideToggle(500);
            
            //$("#post_image_viewer").css({"height":"100%"});
        });
        
        $("#btn_post").click(function(){
                    var pop = new Audio();
                    pop.src = "posts/sounds/pop.mp3";
                    var postText = $("#post_text").val();
                    
                    if(postText != '' | flag){
                        $.ajax({
                            type:'POST',
                            url:'posts/share-post.php',
                            data:{postText:postText},
                            success:function(){
                                pop.play();
                               // $("#posts_list").load("posts/display-posts.php");
                                $("#post_text").val("");
                            }
                        });
                        
                    }
                });
    });
</script>
<?php 
    }
include $tpl."footer.php"?>
