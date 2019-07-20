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

    $stmt = $con->prepare("SELECT * FROM Posts WHERE post_id= ?");
    $stmt->execute(array($_POST['postID']));
    $row = $stmt->fetch();
//if(isset($_POST['postID'])){
    $stmt_shares = $con->prepare("INSERT INTO sharedPosts VALUES(?, ?, ?, ?)");
    $stmt_shares->execute(array(null,$_POST['userID'],$_POST['postID'],date('Y-m-d H:i:s', time())));

    $postText=" was shared this post from <a href='/friend-area-section.php?friendID=".$row['user_id']."' target='_blank'>".getUserInfo('first_name',$row['user_id'])."</a></br>".$row['post_text'];

    $req=$con->prepare("INSERT INTO posts(user_id, post_text, post_content, post_time) 
                                 VALUES (:user_id,:post_text,:post_content,:post_time)");
    $req->execute(array(
        'user_id'=>$_POST['userID'],
        'post_text'=>$postText,
        'post_content'=>$row['post_content'],
        'post_time'=>date('Y-m-d H:i:s', time())
    ));

     //}

 
?>
CREATE TABLE `socialnetwork`.`sharedPosts` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `userID` INT(255) NOT NULL REFERENCES users(id),
    `postID` INT(255) NOT NULL REFERENCES posts(post_id),
    `time` DATETIME NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;