
<?php 
$userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
    
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count >0){
?>
<style type="text/css">
  /*  .container{
        position: fixed; 
        z-index: 10; 
        background-color: #222; 
        width: 100%;
        box-shadow: 0 0 10px 0 #222 .3;
    }
    .navbar-header{
        margin-left: 100px;
    }*/
</style>

<nav class="navbar navbar-inverse" >
 <!-- <div class="container" style="position: fixed; z-index: 10; background-color: #222; width: 100%; padding: 0 150px; box-shadow: 0 0 10px 0 #222 ;">-->
      
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app_nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
      <a class="navbar-brand" href="index.php"><div class="row"><img  src="<?php echo getUserInfo('user_img',$userid); ?>"/><?php echo $row['first_name']?></div></a>
    </div>


    <div class="collapse navbar-collapse" id="app_nav" >
      <ul class="nav navbar-nav">
        <li><a href="index.php"><i class="fa fa-home"></i><span class="alert-span">5</span><?php// echo lang('HOME')?></a></li>
        <li><a href="chat" target="_blank"><i class="fa fa-envelope"></i><span class="alert-span">3</span><?php //echo lang('MESSAGES')?></a></li>
        <li><a href="#"><i class="fa fa-bell"></i><span class="alert-span">9</span><?php //echo lang('NAFICATIONS')?></a></li>
      </ul>
        <form class="navbar-form navbar-left nav-search" role="search" action="search.php" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="q" placeholder="Search"/>
                <a ><button type="submit"><i class="fa fa-search"></i></button></a>
            </div>
        </form>
     <!-- <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>-->
          <ul class="nav navbar-nav right">
            <li><a href="profile.php"><i class="fa fa-user"> </i></a></li>
            <li><a href="settings.php?do=Settings"><i class="fa fa-cog"> </i> </a></li>
            <li><a href="login-system/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
       <!-- </li>
      </ul>-->
    </div>
  
</nav>

<?php
    }

?>
