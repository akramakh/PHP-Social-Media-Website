<?php
session_start();
include "../functions/functions.php";
include "../db.php";

$userid =  isset($_SESSION['logged_in']) ? $_SESSION['userID'] : 0 ;    

$stmt = $con->prepare("SELECT * FROM nafications WHERE user_id = ? ORDER BY time DESC ");
$stmt->execute(array($userid));
//$row = $stmt->fetch();
$count = $stmt->rowCount();
if($count > 0){
    while($row = $stmt->fetch()){

?>
<li>
    <a href="#">
        <div class="nafication-item">
            <div class="nafication-item-img">
                <img src="<?php echo getPostInfo('post_content',$row['post_id']) ?>"/>
            </div>
            <div class="nafication-item-content">
                <abbr><b><?php echo getUserInfo('first_name',getPostInfo('user_id',$row['post_id'])).' '.getUserInfo('last_name',getPostInfo('user_id',$row['post_id'])) ?></b> has posted a new post at <dd> <?php echo $row['time'] ?></dd></abbr>
            </div>
        </div>
    </a>
</li>

<?php 
    }
}else{}

?>