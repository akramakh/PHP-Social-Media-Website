<?php 
/* Main page with two forms: sign up and log in */
//require 'inc/db.php';
session_start();
$pageTitle = $_SESSION['first_name'];
include 'init.php';
include $tpl.'navbar.php';

?>

<div class="container-fluod">
<div class="container-temp"></div>    
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="profile-img">
                    <span>
                        <i class="fa fa-camera"></i>
                        <input type="file" name="profile-img" id="profile_img"/>
                    </span>
                    <img src="<?php echo $row['user_prof_img'] ?>" height="200px" title="Profile Image" alt="Profile Image">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-2">
                <div class="person-img">
                    <span>
                        <i class="fa fa-camera"></i>
                        <input type="file" name="user-img" id="user_img"/>
                    </span>
                    <img src="<?php echo $row['user_img'] ?>" title="Person Image" alt="Person Image">
                </div>
            </div>
            <div class="col-lg-5"></div>
        </div>
        <div class="row person-menu-cont">
            <div class="col-lg-4">
                <div class="left-person-menu">
                    <ul>
                        <li><a href="#" type="submit">Edit Profile</a></li>
                        <li><a href="settings/index.php">My Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="right-person-menu">
                    <ul>
                        <li><a href="portfolio/index.html">Images</a></li>
                        <li><a href="#">My Friends</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="person-info">
                    <div class="person-name">
                        <b><?php echo $row['first_name'].' '.$row['last_name']?></b>
                    </div>
                    <div class="person-bio">
                        <p><?php echo $row['bio']?></p>
                    </div>
                </div>    
                <?php
                $stmt = $con->prepare("SELECT * FROM posts WHERE user_id= ? ORDER BY post_time DESC");
                $stmt->execute(array($userid));
                $count = $stmt->rowCount();
                if($count > 0){ ?>
                <div class="container-portfolio">
                    <h3>My Images</h3>
                    <a href="portfolio" target="_blank">view all</a>
                    <div>
                        <?php
                            while($row = $stmt->fetch()){
                        ?>
                        <div class="box">
                        <img src="<?php echo $row['post_content'] ?>" />
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-lg-5">
                <div class="container-floud">
                    <ul>
                        <?php include "posts/display-posts-private.php"; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                
            
                <div class="container-friend-friends-list">
                    <?php
                    $stmt2 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
                    $stmt2->execute(array( $userid, $userid));
                    $row2 = $stmt2->fetch();
                    $count2 = $stmt2->rowCount();
                    if($count2 > 0){ ?>
                    <h3>My Friends</h3>
                    <a href="#">view all</a>
                    <div>
                        <?php 
                    do{
                        if($userid == $row2['friend_id']){
                            $friendid = $row2['user_id'];
                        }elseif($userid == $row2['user_id']){
                            $friendid = $row2['friend_id'];
                        }
                        ?>
                        <a href="friend-area-section.php?friendID=<?php echo $friendid ?>">
                            <div class="friend-img-cont"><img src="<?php echo getUserInfo('user_img', $friendid); ?>"/></div>
                        </a>
                        <?php
                       }while($row2 = $stmt2->fetch())
                    ?>
                    </div>
                        <?php } ?>
            </div>
                
                
                <div class="container-friend-pages-list">
                    <?php
                    $stmt2 = $con->prepare("SELECT * FROM pages WHERE id in(SELECT id FROM pages WHERE ownerID = ? UNION SELECT page_id FROM pageLikers WHERE user_id = ? UNION SELECT page_id FROM pagefollowers WHERE user_id = ?) ");
                    $stmt2->execute(array( $userid, $userid, $userid));
                    $row2 = $stmt2->fetch();
                    $count2 = $stmt2->rowCount();
                    if($count2 > 0){ ?>
                    <h3><?php echo $count2; ?> Pages</h3>
                    <a href="#">view all</a>
                    <div>
                        <?php 
                    do{
                        
                        ?>
                        <a >
                            <div class="page-count <?php echo $row2['type'] ?>-page"><i class="fa fa-<?php echo $row2['type'] ?>" ></i></div>
                        </a>
                        <?php
                       }while($row2 = $stmt2->fetch())
                    ?>
                    </div>
                        <?php } ?>
                </div>
                
            </div>
        </div>
        
    </div>
    <div class="col-lg-1"></div>
</div>
    
</div>
<script>
    $(document).on('change','#profile_img', function(){
       // alert();
                var property = document.getElementById("profile_img").files[0];
                var image_name = property.name;
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
                        url:'profile/upload.php',
                        data:form_data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        beforeSend:function(){
                          // alert("uploading... ");
                        },
                        success:function(data){
                            pop.play();
                             alert("uploaded ");
                            //$("#post_text").val("");
                        }
                    });
                }
            });
    
    $(document).on('change','#user_img', function(){
       // alert();
                var property = document.getElementById("user_img").files[0];
                var image_name = property.name;
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
                        url:'profile/upload_u.php',
                        data:form_data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        beforeSend:function(){
                          // alert("uploading... ");
                        },
                        success:function(data){
                            pop.play();
                             alert("uploaded ");
                            //$("#post_text").val("");
                        }
                    });
                }
            });
</script>


<?php include $tpl."footer.php"?>
