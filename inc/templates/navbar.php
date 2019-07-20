
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
        <li><a href="index.php"><i class="fa fa-home"></i><!--span class="alert-span">5</span--><?php// echo lang('HOME')?></a></li>
        <li id="messages-menu"><a ><i class="fa fa-envelope"></i><span class="alert-span">4</span></a>
            <div class="messages-submenu submenu-hide">
                <div class="messages-submenu-header">
                    <h4>Messages</h4>
                    <a href="chat" target="_blank">view all</a>
                </div>
                <ul>
                    <li><a href="#">
                        <div class="message-item">
                            <div class="message-item-img">
                                <img src="img/user_img6.jpg"/>
                            </div>
                            <div class="message-item-content">
                                <abbr><b>Akram Abu Khousa</b> Sent to you<br/><em> 3-Massages</em> <dd> 5 minutes ago</dd></abbr>

                            </div>
                        </div>
                        </a>
                    </li>
                    <li><a href="#">
                    <div class="message-item">
                        <div class="message-item-img">
                            <img src="img/defualt_user_img.jpg"/>
                        </div>
                        <div class="message-item-content">
                            <abbr><b>Omar Al-Khalili</b> Sent to you<br/><em> 1-Massages</em> <dd> 5 minutes ago</dd></abbr>

                        </div>
                    </div>
                    </a>
                </li>
                </ul>
            </div>
            
        </li>
        <li id="nafications-menu"><a ><i class="fa fa-bell"></i><span id="numOfNafications_cont" ></span></a>
            <ul class="nafications-submenu submenu-hide">
                <div id="nafications_cont_header">
                    <span id="numOfNaficationsAll"></span>
                    <a id="setAllNaficationsViewed">set all as viewed</a>
                </div>
                <div id="nafications_cont">
                </div>
            </ul>
        </li>
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
            <li><a href="settings/index.php"><i class="fa fa-cog"> </i> </a></li>
            <li><a href="login-system/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
       <!-- </li>
      </ul>-->
    </div>
  
</nav>
<script type="text/javascript">
    $(document).ready(function(){
        $("#numOfNafications_cont").load('inc/templates/numOfNafications.php');
    });
    $("#nafications-menu").on('click blur focus',function(e) {
        if(e='click'){
            $(".nafications-submenu").toggleClass('submenu-hide');
            $(".messages-submenu").addClass('submenu-hide'); 
            $("#nafications_cont").load('inc/templates/nafications.php');
            $("#numOfNaficationsAll").load('inc/templates/numOfNaficationsAll.php');
        }
    });
    $("#setAllNaficationsViewed").click(function(){
        $("#numOfNafications_cont").load('inc/templates/setAllNaficationsViewed.php');
    });
    $("#messages-menu").on('click blur focus',function(e) {
        if(e='click'){
            $(".messages-submenu").toggleClass('submenu-hide');
            $(".nafications-submenu").addClass('submenu-hide');
            
        }});
</script>
<?php
    }

?>
