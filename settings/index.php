<?php 
require 'inc/db.php';
session_start();
$pageTitle = 'My Settings';
include 'init.php';
include $tpl.'navbar.php';
if(isset($_SESSION['logged_in'])){
    
       $userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
        
        if($stmt->rowCount() > 0){?>
<style>

</style>
<div id="header-redirect" class="container-temp"></div>
<div class="col-lg-2"></div>
<div class="container-sittings col-lg-8">
    <div class="col-lg-3">
        <div class="settings-cat">
            <h2 class="text-center">Settings Page</h2>
            <ul>
                <li><button id="accountset_btn">Account Settings</button></li>
                <li><button id="personalset_btn">Personal Settings</button></li>
                <li><button id="passwordSetting_btn">Change Password</button></li>
                <li><button id="privacy_btn">Privacy</button></li>
                <li><button id="removeAccount_btn">Remove Account</button></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-8">
        <div class="row" style="margin:0;">
            <div class="setting-header ">
                <div class="img-cont"><img src="../<?php echo getUserInfo('user_img', $row['id']); ?>"/></div>
                <div class="name-cont">
                    <a href="../profile.php" target="_blank" style=" " ><?php echo getUserInfo('first_name', $row['id']).' '.getUserInfo('last_name', $row['id']); ?></a>
                </div>
            </div>
        </div> 
        <div class="row">
            <div id="container_settings" class="container col-lg-12" style="background-color: transparent;">

            </div>
        </div>
            
    </div>    
</div>
<div class="col-lg-2"></div>
<script>
    $("#accountset_btn").click(function(){
        $("#personalset_btn").removeClass("btn-visited");
        $("#passwordSetting_btn").removeClass("btn-visited");
        $("#privacy_btn").removeClass("btn-visited");
        $("#removeAccount_btn").removeClass("btn-visited");
        $(this).addClass("btn-visited");
        $("#container_settings").load("accountSettings.php");
    });
    $("#personalset_btn").click(function(){
        $("#accountset_btn").removeClass("btn-visited");
        $("#passwordSetting_btn").removeClass("btn-visited");
        $("#privacy_btn").removeClass("btn-visited");
        $("#removeAccount_btn").removeClass("btn-visited");
        $(this).addClass("btn-visited");
        $("#container_settings").load("personalSettings.php");
    });
    $("#passwordSetting_btn").click(function(){
        $("#accountset_btn").removeClass("btn-visited");
        $("#personalset_btn").removeClass("btn-visited");
        $("#privacy_btn").removeClass("btn-visited");
        $("#removeAccount_btn").removeClass("btn-visited");
        $(this).addClass("btn-visited");
        $("#container_settings").load("passwordSettings.php");
    });
    $("#privacy_btn").click(function(){
        $("#accountset_btn").removeClass("btn-visited");
        $("#personalset_btn").removeClass("btn-visited");
        $("#passwordSetting_btn").removeClass("btn-visited");
        $("#removeAccount_btn").removeClass("btn-visited");
        $(this).addClass("btn-visited");
        $("#container_settings").load("pageLayoutSettings.php");
    });
    $("#removeAccount_btn").click(function(){
        $("#accountset_btn").removeClass("btn-visited");
        $("#personalset_btn").removeClass("btn-visited");
        $("#passwordSetting_btn").removeClass("btn-visited");
        $("#privacy_btn").removeClass("btn-visited");
        $(this).addClass("btn-visited");
        $("#container_settings").load("removeAccountSettings.php");
    });
    
    
    $(document).ready(function(){
        $("#container_settings").load("accountSettings.php");
    }); 
        
</script>
<!--<div class="col-lg-2"> </div>-->
    <?php
                                 
        }else{
        echo 'ERROR';
        }
}else{
    header('Location: ../index.php');
    exit();
}
?>

<?php include $tpl."footer.php"?>