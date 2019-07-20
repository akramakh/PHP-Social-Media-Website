<?php 
/* Main page with two forms: sign up and log in */
//require 'inc/db.php';
session_start();
$friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
include 'init.php';
$pageTitle = getUserInfo('username',$friendid);

if(isset($_SESSION['logged_in'])){
    include $tpl.'navbar.php';
    $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
}else{
    //include $tpl.'navbar-defualt.php';
} 
    $stmt = $con->prepare("SELECT DISTINCT * FROM users WHERE id = ? ");
    
        $stmt->execute(array( $friendid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

?>
<style type="text/css">
 /*   .container-friend-friends-list {
    width: 285px;
    margin: 10px;
    padding: 5px;
    border: 1px solid #dad1d1;
    background-color: #fafafa;
    border-radius: 3px;
    display: inline-block;
    text-align: center;
}
    .container-friend-friends-list ul li {
    display: flex;
    float: left;
}
    .container-friend-friends-list .friend-img-cont{
    width: 60px;
    height: 60px;
    display: flex;
    border: 2px solid #1279be;
    border-radius: 50%;
    margin-right: 10px;
    overflow: hidden;
    padding: 3px;
    outline: 2px #1279be;
}
    .container-friend-friends-list .friend-img-cont > img{
        object-fit: cover;
        object-position: center;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }*/
</style>

<div class="container-fluod">
<div class="container-temp"></div>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="profile-img">
                    <img src="<?php echo getUserInfo('user_prof_img', $friendid); ?>" height="200px" title="Profile Image" alt="Profile Image">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-2">
                <div class="person-img">
                    <img src="<?php echo getUserInfo('user_img', $friendid); ?>" title="Person Image" alt="Person Image">
                </div>
            </div>
            <div class="col-lg-5"></div>
        </div>
        <div class="row person-menu-cont">
        <?php if(isFriend($friendid)){ 
                    $value = 'Cancel Friendship'; 
                    $btn_id= 'removeFriendBtn';
                }
                else{
                    $value = 'Add Friend'; 
                    $btn_id= 'addFriendBtn';
                } ?>
            <div class="col-lg-4">
                <div class="left-person-menu">
                    <ul>
                        <li><a href="chat/index.php?friendID=<?php echo $friendid ?>" target="_blank">Start Chat</a></li>
                        <li><a href="" id="<?php echo $btn_id; ?>" ><?php echo $value; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="right-person-menu">
                    <ul>
                        <li><a href="portfolio/index.php">Images</a></li>
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
                $stmt->execute(array($friendid));
                $count = $stmt->rowCount();
                if($count > 0){ ?>
                <div class="container-portfolio">
                    <h3>Images</h3>
                    <a href="portfolio" target="_blank">view all</a>
                    <div>
                        <?php
                            while($row = $stmt->fetch()){
                        ?>
                        <div class="box">
                        <img src="<?php echo $row['post_content']; ?>" />
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
                        <?php include 'posts/display-friend-posts-private.php'?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <?php 
                    $stmt2 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
                    $stmt2->execute(array( $friendid, $friendid));
                    $row2 = $stmt2->fetch();
                    $count2 = $stmt2->rowCount();

                    if($count2 > 0){ ?>
            <div class="container-friend-friends-list">
                <h3>My Friends</h3>
                <a href="#">view all</a>
                <div>
                <ul>
                     <?php 
                    do{
                        if($friendid == $row2['friend_id']){
                            $friendfriendid = $row2['user_id'];
                        }elseif($friendid == $row2['user_id']){
                            $friendfriendid = $row2['friend_id'];
                        }
                        ?>
                    <li>
                        <a href="friend-area-section.php?friendID=<?php echo $friendfriendid ?>">
                            <div class="friend-img-cont"><img src="<?php echo getUserInfo('user_img', $friendfriendid); ?>"/></div>
                        </a>
                    </li>
                    <?php
                       }while($row2 = $stmt2->fetch())
                    ?>
                </ul>   
                </div>
                                                
            </div>
             <?php } 
                        
                    $stmt2 = $con->prepare("SELECT * FROM pages WHERE id in(SELECT id FROM pages WHERE ownerID = ? UNION SELECT page_id FROM pageLikers WHERE user_id = ? UNION SELECT page_id FROM pagefollowers WHERE user_id = ?) ");
                    $stmt2->execute(array( $friendid, $friendid, $friendid));
                    $row2 = $stmt2->fetch();
                    $count2 = $stmt2->rowCount();
                    if($count2 > 0){ ?>
             <div class="container-friend-pages-list">
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
                        
                    <!--h3>Pages</h3>
                    <a href="#">view all</a>
                    <div>
                        <a >
                            <div class="page-count camera-page"><i class="fa fa-camera "></i></div>
                        </a>
                        <a >
                            <div class="page-count star-page"><i class="fa fa-star"></i></div>
                        </a>
                        <a >
                            <div class="page-count coffee-page"><i class="fa fa-coffee "></i></div>
                        </a>
                        <a >
                            <div class="page-count sport-page"><i class="fa fa-soccer-ball-o"></i></div>
                        </a>
                        <a >
                            <div class="page-count music-page"><i class="fa fa-music"></i></div>
                        </a>
                        <a >
                            <div class="page-count film-page"><i class="fa fa-film"></i></div>
                        </a>
                        <a >
                            <div class="page-count photo-page"><i class="fa fa-photo"></i></div>
                        </a>
                        <a >
                            <div class="page-count"><i class="fa fa-image"></i></div>
                        </a>
                    </div-->    
                </div>
                <?php } ?>
            </div>
        </div>
        
    </div>
    <div class="col-lg-1"></div>
    
</div>
</div>

<?php
include $tpl."footer.php"?>

<script>
    $(document).ready(function() {
        $("#addFriendBtn").click( function() {

            $("#addFriendBtn").load("addfriend.php",{
                userid: <?php echo $userid ?>,
                friendid: <?php echo $friendid ?>
            });
        });
        
        $("#removeFriendBtn").click( function() {
            $("#removeFriendBtn").load("removefriend.php",{
                userid: <?php echo $userid ?>,
                friendid: <?php echo $friendid ?>
            });
        });
        
    });
    
</script>
