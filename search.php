<?php 

require 'inc/db.php';
session_start();
$pageTitle = 'Result';
include 'init.php';
isset($_SESSION['logged_in']) ? include $tpl.'navbar.php' : include $tpl.'navbar-defualt.php';
if(isset($_GET['q']) && $_GET['q'] != ''){
    $userid = isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 1;
    $question = $_GET['q'];
?>
<div class="container-fluod">
<div class="container-temp"></div>    
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-3">
    
    <div class="frinds-section">
        <h3>Persons</h3>
        <?php
    $stmt = $con->prepare("SELECT DISTINCT * FROM users WHERE (username = ? OR first_name like ? OR last_name like ?) ");
    
        $stmt->execute(array( $question, $question, $question));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();      
    if($count > 0){       
?>
        <ul>
        <?php do{
            $friendid = $row['id'];
        ?>
        <li>
            <a href="friend-area-section.php?friendID=<?php echo $friendid ?>">
                <div class="user-photo">
                    <img src="<?php echo $row['user_img'] ?>"/>
                </div>
                <p><?php echo $row['first_name'].' '.$row['last_name'] ?><br/>
                <?php echo '@'.$row['username']?></p>
            </a>  
        </li>  
        <?php
           }while($row = $stmt->fetch())
        ?>
            </ul>
        <?php
        }else{
        $friendid=$userid;
        echo '<div style="font-family:tahoma;color:#999;font-weight:500;">there is no Users attaches</div>';
    }
?>
    </div>
    
    </div>
    <div class="col-lg-4">
        
    <div class="frinds-section" >
        <h3>Posts</h3>

        <ul id="posts_list">
            <?php
            $stmt1 = $con->prepare("SELECT DISTINCT * FROM users WHERE (username = ? OR first_name like ? OR last_name like ?) ");
            $stmt1->execute(array( $question, $question, $question));
            $row1 = $stmt1->fetch();
            $count1 = $stmt1->rowCount();      
        if($count1 > 0){
            $stmt = $con->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY post_time DESC ");
            $stmt->execute(array($row1['id']));
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch()){
                    if($row['user_id'] == $userid ){
                        $target =  'profile.php' ;
                        
                    }else $target = 'friend-area-section.php?friendID='.$row['user_id'] ;
?>

<li>
    <div class="post-v2">
        <div class="content" style="">
            <div class="post-content" style=""><img src="<?php echo $row['post_content'] ?>"/></div>
            <div class="post-header">

                <div class="post-img-cont"><img src="<?php echo getUserInfo('user_img', $row['user_id']); ?>"/></div>
                <div class="post-name-cont" style="">
                    <a href="<?php echo $target; ?>" target="_blank" style=" " ><?php echo getUserInfo('first_name', $row['user_id']).' '.getUserInfo('last_name', $row['user_id']); ?></a>
                </div>
                <tt class="post-time" style="">at <?php echo $row['post_time'] ?> </tt>
            </div>
            <div class="post-text" style="border:0px; background:#fff; color:#777"><abbr><?php echo $row['post_text'] ?></abbr></div>
        </div>
        <div class="post-footer">
            <a id="cont_comment_post_<?php echo $row['post_id'] ?>"></a>
            <a id="cont_like_post_<?php echo $row['post_id'] ?>"></a>
            <a id="cont_dislike_post_<?php echo $row['post_id'] ?>"></a>
            <a id="cont_share_post_<?php echo $row['post_id'] ?>"></a>
        </div>
        <div class="comments-container" id="comments_container_<?php echo $row['post_id']; ?>">
            <?php
            $stmt_comments = $con->prepare("SELECT * FROM comments WHERE post_id= ?");
            $stmt_comments->execute(array($row['post_id']));
            //$row_comments = $stmt_comments->fetch();
            if($stmt_comments->rowCount() > 0){
            ?>
            <div id="comments_box_<?php echo $row['post_id']; ?>" class="comments-box">
                
            </div>
            <?php } ?>
            <div class="type-comments-container">
                    <div>
                        <div class="textarea-cont">
                            <textarea id="post_comment_text_<?php echo $row['post_id']; ?>" placeholder="Comment here "></textarea>
                        </div>
                        <a href="profile.php">
                            <div class="comment-img-cont">
                                <img src="<?php echo getUserInfo('user_img', $userid); ?>"/>
                            </div>
                        </a>
                    </div>
                    <button id="post_comment_btn_<?php echo $row['post_id']; ?>">Comment</button>
            </div>
        </div>    
    </div>
<script type="text/javascript">
$("#cont_comment_post_<?php echo $row['post_id'] ?>").load('posts/operations/DisplayCommentPost.php?postID=<?php echo $row['post_id'] ?>');
$("#cont_like_post_<?php echo $row['post_id'] ?>").load('posts/operations/DisplayLikePost.php?postID=<?php echo $row['post_id'] ?>');
$("#cont_dislike_post_<?php echo $row['post_id'] ?>").load('posts/operations/DisplayDislikePost.php?postID=<?php echo $row['post_id'] ?>');
$("#cont_share_post_<?php echo $row['post_id'] ?>").load('posts/operations/DisplaySharedPost.php?postID=<?php echo $row['post_id'] ?>');
    </script>
    
</li>
    <?php 
    }
}
        }
            ?>
        </ul>
        
    </div>
    </div>
    <div class="col-lg-3">

    <div class="frinds-section">
        <h3>Pages</h3>
        <ul>
        <?php
    /*$stmt1 = $con->prepare("SELECT DISTINCT * FROM users WHERE (username = ? OR first_name like ? OR last_name like ?) ");
    $stmt1->execute(array( $question, $question, $question));
    $row1 = $stmt1->fetch();
    $count1 = $stmt1->rowCount();      
    if($count1 > 0){
        
    while($row1 = $stmt1->fetch()){    
    $stmt = $con->prepare("SELECT DISTINCT * FROM pages WHERE ownerID=? ");
        $stmt->execute(array($row1['id']));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();     
    if($count > 0){      
        //while($row = $stmt->fetch()){
        ?>
        <li>
            <a href="#">
                <div class="user-photo">
                    <img src="<?php echo $row1['user_img'] ?>"/>
                </div>
                <p><?php echo $row1['first_name'].' '.$row1['last_name'] ?><br/>
                <?php echo '@'.$row['name']?></p>
            </a>  
        </li>
        <?php
          // }
        }
    }
        }*/
    $stmt = $con->prepare("SELECT DISTINCT * FROM pages WHERE name = ? ");
        $stmt->execute(array( $question));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();     
    if($count > 0){
        while($row = $stmt->fetch()){
            //$friendid = $row['id'];
        ?>
        <li>
            <a href="#">
                <div class="user-photo">
                    <img src="<?php echo $row['id'] ?>"/>
                </div>
                <p><?php echo $row['name'] ?><br/>
                <?php echo '@'.$row['type']?></p>
            </a>  
        </li>
        <?php
           }
        }
        ?>
            </ul>
    </div>
  </div>
    </div>
</div>
<?php
    
}else{
    header("Location: index.php");
}
    include $tpl."footer.php";?>
