

<?php
    // Show Members here

    //$friendid = isset($_GET['friendID']) ? $_GET['friendID'] : null;
    $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    //$friendid = 5;
    //$userid = 3;
    //isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $stmt = $con->prepare("SELECT DISTINCT * FROM users WHERE id != ? ");
    
        $stmt->execute(array( $userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($count > 0){
        
?>

<div >
    <div class="frinds-section ">
        
        <?php do{
            
            ?>
            
        <a href="friend-area-section.php?friendID=<?php echo $row['id'] ?>">
            <div class="user-photo">
                <img src="img/user-photo2.jpg"/>
            </div>
        </a>  
           
        <?php
           }while($row = $stmt->fetch())
        ?>
    </div>
    
</div>

    <?php
        }

    ?>

