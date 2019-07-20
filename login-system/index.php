<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
        
        .form{
            border-radius: 4px 0 0 4px;
        }
     </style>
</head>


<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
<body>

   
        <div class="form">

          <ul class="tab-group">
            <li class="tab"><a href="#signup">Sign Up</a></li>
            <li class="tab active"><a href="#login">Log In</a></li>
          </ul>

          <div class="tab-content">

             <div id="login">   
              <h1>Welcome Back!</h1>

              <form action="index.php" method="post" >

                <div class="field-wrap">
                <label>
                  Email Address<span class="req">*</span>
                </label>
                <input type="email" required autocomplete="on" name="email"/>
              </div>

              <div class="field-wrap">
                <label>
                  Password<span class="req">*</span>
                </label>
                <input class="password" type="password" required autocomplete="off" name="password"/>
                <i class="fa fa-eye show-pass"></i>
              </div>

              <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>

              <button class="button button-block" name="login" >Log In</button>

              </form>

            </div>

            <div id="signup">   
              <h1>Sign Up for Free</h1>

              <form action="index.php" method="post" autocomplete="off">

              <div class="top-row">
                <div class="field-wrap">
                  <label>
                    First Name<span class="req">*</span>
                  </label>
                  <input type="text" required autocomplete="off" name='firstname' />
                </div>

                <div class="field-wrap">
                  <label>
                    Last Name<span class="req">*</span>
                  </label>
                  <input type="text"required autocomplete="off" name='lastname' />
                </div>
              </div>

              <div class="field-wrap">
                <label>
                  Email Address<span class="req">*</span>
                </label>
                <input type="email"required autocomplete="off" name='email' />
              </div>

              <div class="field-wrap">
                <label>
                  Set A Password<span class="req">*</span>
                </label>
                <input type="password"required autocomplete="off" name='password'/>
              </div>

              <div class="field-wrap">
                <lable id="gen">
                  Gender : 
                </lable>
                  <input class="gen" type="radio" name="gender" value="m" checked="checked" id="gen-m"/> <lable for="gen-m"> Male</lable>  
                  <input class="gen" type="radio" name="gender" value="f" id="gen-f"/> <lable for="gen-f"> Female</lable>
              </div>

              <div class="top-row">
              <div class="field-wrap">
                <label>
                  Date of Birth<span class="req">*</span>
                </label>
                <input type="text"required id="dob" autocomplete="off" name='dob'/>
              </div>

              <div class="field-wrap">
                <?php include 'countries.php'; ?>
              </div>
              </div>          
              <div class="field-wrap">
                <?php include 'nationality.php'; ?>
              </div>

              <button type="submit" class="button button-block" name="register" >Register</button>

              </form>

            </div>  

          </div><!-- tab-content -->

    </div> <!-- /form -->

  <script src='js/jquery-3.3.1.min.js'></script>

    <script src="js/index.js"></script>


</body>    
</html>