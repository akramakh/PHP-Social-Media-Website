
<?php 
session_start();
require "db.php";

function getUserInfo($type,$val){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
    
        $stmt->execute(array($val));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
      return $row[$type];  
    }else{
    return null; 
    }
}

$stmt_comments = $con->prepare("SELECT * FROM comments WHERE post_id= ?");
$stmt_comments->execute(array($_GET['postID']));

while($row_comments = $stmt_comments->fetch()){ 
                        
                        $target = $row_comments['user_id'] == $_SESSION['userID'] ? 'profile.php' : 'friend-area-section.php?friendID='.$row_comments['user_id'] ;
                ?>
                <div class="comment-item-cont">
                    <a href="<?php echo $target; ?>" target="_blank">
                        <div class="comment-img-cont">
                            <img src="<?php echo getUserInfo('user_img', $row_comments['user_id']); ?>"/>
                        </div>
                    </a>
                    <div class="comment-content-cont">
                        <p><?php echo $row_comments['text'] ?></p>
                    </div>
                </div>
                <?php } ?>

<?php /* while($row_comments = $stmt_comments->fetch()){ 
                            if( isFriend($row_comments['user_id'])){
                            $target = $row_comments['user_id'] == $userid ? 'profile.php' : 'friend-area-section.php?friendID='.$row_comments['user_id'] ;}
                    ?>
                    <div class="comment-item-cont">
                        <a href="<?php echo $target; ?>" target="_blank">
                            <div class="comment-img-cont">
                                <img src="<?php echo getUserInfo('user_img', $row_comments['user_id']); ?>"/>
                            </div>
                        </a>
                        <div class="comment-content-cont">
                            <p><?php echo $row_comments['text'] ?></p>
                        </div>
                    </div>
                    <?php } */?>