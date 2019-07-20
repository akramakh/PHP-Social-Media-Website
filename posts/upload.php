<?php
session_start();
include "db.php";
$stmt = $con->prepare("SELECT * FROM posts ");
$stmt->execute();
$count = $stmt->rowCount();
$last = 1;
while($row = $stmt->fetch()){
    $last =  $row['post_id']+1;
}
if($_FILES['file']['name'] != ''){
    $test = explode('.',$_FILES['file']['name']);
    $extension = end($test);
    $name = 'p'.$last.'.'.$extension;
    $location = 'posts/upload/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$name);
    $_SESSION['post_image_location'] = $location;
}?>
<script>
   /* var location = <?php //echo $location ?>;
$.ajax({
    type:'POST',
    url:'share-post.php',
    data:{location:location},
    success:function(){
        alert(location);
    }
});*/
</script>

<?php

?>