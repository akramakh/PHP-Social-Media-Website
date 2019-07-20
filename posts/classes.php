<?php

class post{
    private $PostId,$PostUserId,$PostText,$PostTime,$PostImageName,$PostImage;
    
    public function getPostId(){
        return $this->PostId;
    }
    public function setPostId($PostId){
        $this->PostId = $PostId;
    }
    
    public function getPostUserId(){
        return $this->PostUserId;
    }
    public function setPostUserId($PostUserId){
        $this->PostUserId = $PostUserId;
    }
    
    public function getPostText(){
        return $this->PostText;
    }
    public function setPostText($PostText){
        $this->PostText = $PostText;
    }
    
    public function getPostImageName(){
        return $this->PostImageName;
    }
    public function setPostImageName($PostImageName){
        $this->PostImageName = $PostImageName;
    }
    
    public function getPostImage(){
        return $this->PostImage;
    }
    public function setPostImage($PostImage){
        $this->PostImage = $PostImage;
    }
    
    public function getPostTime(){
        return $this->PostTime;
    }
    public function setPostTime($PostTime){
        $this->PostTime = $PostTime;
    }

    
    public function insertPost($location){
        include "db.php";
        $req=$con->prepare("INSERT INTO posts(user_id, post_text, post_content, post_time) 
                                     VALUES (:user_id,:post_text,:post_content,:post_time)");
        $req->execute(array(
            'user_id'=>$this->getPostUserId(),
            'post_text'=>$this->getPostText(),
            'post_content'=>$location,
            'post_time'=>$this->getPostTime()
        ));
        
        $stmt1 = $con->prepare("SELECT * FROM posts where user_id = ? ORDER BY post_time DESC LIMIT 1 ");
        $stmt1->execute(array( $this->getPostUserId()));    
        $row1 = $stmt1->fetch();
                        
        $friendids = array();
        $stmt2 = $con->prepare("SELECT * FROM friends WHERE user_id = ? OR friend_id = ?");
        $stmt2->execute(array( $this->getPostUserId(), $this->getPostUserId()));
        $count2 = $stmt2->rowCount();
        if($count2 > 0){
        while($row2 = $stmt2->fetch()){
            if($userid == $row2['friend_id']){
                $friendid = $row2['user_id'];
            }elseif($userid == $row2['user_id']){
                $friendid = $row2['friend_id'];
            }
            $req=$con->prepare("INSERT INTO nafications(user_id, post_id, time) 
                                     VALUES (:user_id,:post_id,:time)");
                $req->execute(array(
                    'user_id'=>$friendid,
                    'post_id'=>$row1['id'],
                    'time'=>$this->getPostTime()
                ));
           }
            foreach($friendids as $friendid){
               /* $req=$con->prepare("INSERT INTO nafications(user_id, post_id, time) 
                                     VALUES (:user_id,:post_id,:time)");
                $req->execute(array(
                    'user_id'=>$friendid,
                    'post_id'=>$this->getPostText(),
                    'time'=>$this->getPostTime()
                ));
                /*
                $req=$con->prepare("INSERT INTO naficationsstatus(friend_id, naf_id) 
                                     VALUES (:friend_id,:naf_id)");
                $req->execute(array(
                    'friend_id'=>$friendid,
                    'naf_id'=>$this->getPostText()
                ));*/
            }
        }
    }

    public function displayPost(){
include "db.php";
$userid = isset($_SESSION['logged_in']) ? $_SESSION['userID'] : null;    

$stmt = $con->prepare("SELECT * FROM posts ORDER BY post_time DESC");
$stmt->execute();
$count = $stmt->rowCount();
if($count > 0){
    while($row = $stmt->fetch()){
        if($row['user_id'] == $userid || isFriend($row['user_id'])){
            $target = $row['user_id'] == $userid ? 'profile.php' : 'friend-area-section.php?friendID='.$row['user_id'] ;
?>
<li>
    <div class="post-v2" >
        <div class="content" style="">
            <div class="post-content" style=""><img src="<?php echo $row['post_content'] ?>"/></div>
            <div class="post-header">

                <div class="post-img-cont"><img src="<?php echo getUserInfo('user_img', $row['user_id']); ?>"/></div>
                <div class="post-name-cont" style="">
                    <a href="<?php echo $target; ?>" target="_blank" style=" " ><?php echo getUserInfo('first_name', $row['user_id']).' '.getUserInfo('last_name', $row['user_id']); ?></a>
                </div>
                <tt class="post-time" style="">at <?php echo $row['post_time'] ?></tt>
                <i  class="fa fa-ellipsis-v post-i" id="post-option<?php echo $row['post_id'] ?>" style=""></i>
                <div class="post-options" id="post_<?php echo $row['post_id'] ?>">
                    <ul>
                        <li><a href="#animatedModal">Edit Post</a></li>
                        <li><a href="#">Edit Visibility</a></li>
                        <li><a href="#">Remove Post</a></li>
                    </ul>
                </div>
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
      
?>

 <script type="text/javascript">
    $(document).ready(function(){
        $("#post-option"+<?php echo $row['post_id'] ?>+"").click(function(){
            $("#post_"+<?php echo $row['post_id'] ?>+"").toggleClass(" visible");
        });
    });
</script>
    <?php 
    }
}       
    }
    
    //display posts in your profile
    
    public function displayPostPrivate(){
include "db.php";
$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    
$friendid = isset($_GET['friendID']) ? $_GET['friendID'] : 0 ;    

$stmt = $con->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY post_time DESC ");
$stmt->execute(array($userid));
$count = $stmt->rowCount();
if($count > 0){
    while($row = $stmt->fetch()){
       // if($row['user_id'] == $userid  || isFriend($row['user_id'])){
            $target = $_SESSION['logged_in'] ? 'profile.php' :'friend-area-section.php?friendID='.$row['user_id'] ;
?>

<li>
    <div class="post-v2" >
        <div class="content" style="">
            <div class="post-content" style=""><img src="<?php echo $row['post_content'] ?>"/></div>
            <div class="post-header">

                <div class="post-img-cont"><img src="<?php echo getUserInfo('user_img', $row['user_id']); ?>"/></div>
                <div class="post-name-cont" style="">
                    <a href="<?php echo $target; ?>" target="_blank" style=" " ><?php echo getUserInfo('first_name', $row['user_id']).' '.getUserInfo('last_name', $row['user_id']); ?></a>
                </div>
                <tt class="post-time" style="">at <?php echo $row['post_time'] ?></tt>
                <i  class="fa fa-ellipsis-v post-i" id="post-option<?php echo $row['post_id'] ?>" style=""></i>
                <div class="post-options" id="post_<?php echo $row['post_id'] ?>">
                    <ul>
                        <li><a href="#">Edit Post</a></li>
                        <li><a href="#">Edit Visibility</a></li>
                        <li><a href="#">Remove Post</a></li>
                    </ul>
                </div>
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

 <script type="text/javascript">
    $(document).ready(function(){
        $("#post-option"+<?php echo $row['post_id'] ?>+"").click(function(){
            $("#post_"+<?php echo $row['post_id'] ?>+"").toggleClass(" visible");
        });
        
    });
</script>
    <?php 
    }
}       
    }
    
     public function displayFriendPostPrivate(){
include "db.php";
$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    
$friendid = isset($_GET['friendID']) ? $_GET['friendID'] : 0 ;
         
$stmt = $con->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY post_time DESC ");
$stmt->execute(array($friendid));
$count = $stmt->rowCount();
if($count > 0){
    while($row = $stmt->fetch()){
        if($row['user_id'] == $friendid  || $row['user_id'] == $friendid ){
            $target = 'friend-area-section.php?friendID='.$row['user_id'] ;
        }else $target =  'profile.php' ;
?>

<li>
    <div class="post-v2" >
        <div class="content" style="">
            <div class="post-content" style=""><img src="<?php echo $row['post_content'] ?>"/></div>
            <div class="post-header">

                <div class="post-img-cont"><img src="<?php echo getUserInfo('user_img', $row['user_id']); ?>"/></div>
                <div class="post-name-cont" style="">
                    <a href="<?php echo $target; ?>" target="_blank" style=" " ><?php echo getUserInfo('first_name', $row['user_id']).' '.getUserInfo('last_name', $row['user_id']); ?></a>
                </div>
                <tt class="post-time" style="">at <?php echo $row['post_time'] ?></tt>
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
    
    
}