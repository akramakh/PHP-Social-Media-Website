<?php
//require '../inc/db.php';
session_start();
//$pageTitle = $_SESSION['first_name'];
include '../init.php';
//include 'inc/navbar.php';
$id= isset($_GET['friendID']) ? $_GET['friendID'] : $_SESSION['userID'] ;
?>

<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>jQuery Filter</title>
        
    </head>
    <body>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/filter.js"></script>
       
     <div class="container-floud">
        <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
       <!-- <div class="row">
            <div class="col-lg-12">
                <div class="profile-img">
                    <img src="<?php echo '../'.getUserInfo('user_prof_img',$id) ?>" height="200px" title="Profile Image" alt="Profile Image">
                </div>
            </div>
        </div>-->
            <h1>My Portfolio</h1>
            <div class="main-menu">
                <ul>
                    <li class="button" data-filter="all">All</li>
                    <li class="button" data-filter="website">Website</li>
                    <li class="button" data-filter="graphics">Graphics</li>
                    <li class="button" data-filter="psd">PSD</li>
                    <li class="button" data-filter="logo">Logo</li>
                    <li class="button" data-filter="applications">Applications</li>
                    <li class="button" data-filter="ux">UX</li>
                </ul>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="box filter website">
                <img src="img/2.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter graphics">
                <img src="img/4.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter psd">
                <img src="img/3.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter logo">
                <img src="img/1.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter applications">
                <img src="img/5.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter ux">
                <img src="img/6.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
             
            <div class="box filter website">
                <img src="img/2.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter graphics">
                <img src="img/4.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter psd">
                <img src="img/3.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter logo">
                <img src="img/1.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter applications">
                <img src="img/5.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter ux">
                <img src="img/6.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
             
            <div class="box filter website">
                <img src="img/2.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter graphics">
                <img src="img/4.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter psd">
                <img src="img/3.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter logo">
                <img src="img/1.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter applications">
                <img src="img/5.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter ux">
                <img src="img/6.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            
            <div class="box filter website">
                <img src="img/2.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter graphics">
                <img src="img/4.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter psd">
                <img src="img/3.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter logo">
                <img src="img/1.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter applications">
                <img src="img/5.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            <div class="box filter ux">
                <img src="img/6.jpg" />
                <div class="overlay">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-bookmark"></i>
                </div>
            </div>
            
            
            
        </div>
        <div class="col-lg-1"></div>
    </div>        
    </div>
    </body>
    
</html>