<?php
session_start();
require 'inc/db.php';
require 'inc/functions/functions.php';
$userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;
    //isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $stmt = $con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($stmt->rowCount() > 0){?>
<form class="form-horizontal" action="?do=Update" method="post">
    
    
    
    <input type="hidden" name="userid" value="<?php echo $userid ?>" />
    <!-- Start Full Name Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-2 col-lg-2 control-label">Full Name</label>
        <div class="col-sm-6 col-md-4 col-lg-4">
        <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $row['first_name'] ?>" autocomplete="off" required="required"/>
        </div>

        <!--label class="col-sm-2 col-lg-2 control-label">Last Name</label-->
        <div class="col-sm-6 col-md-4  col-lg-5">
        <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $row['last_name'] ?>" autocomplete="off" required="required"/>
        </div>
    </div>
    <!-- End Full Name Field -->
    <!-- Start Site Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label">Site</label>
        <div class="col-sm-10 col-md-9">
        <input type="text" id="site" name="site" class="form-control" value="<?php echo $row['site'] ?>" placeholder="www.example.com"/>
        </div>
    </div>
    <!-- End Date of Birth Field -->
    <!-- Start Bio Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label">Bio</label>
        <div class="col-sm-10 col-md-9">
            <textarea id="bio" name="bio" class="form-control" style="resize:vertical; max-height:100px; height:100px;" placeholder="some information about you ... "><?php echo $row['bio'] ?></textarea>
        </div>
    </div>
    <!-- Start Date of Birth Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label">Date of Birth</label>
        <div class="col-sm-10 col-md-9">
        <input type="date" id="dob" name="dob" class="form-control" value="<?php echo $row['DOB'] ?>" autocomplete="off" required="required"/>
        </div>
    </div>
    <!-- End Date of Birth Field -->
    <!-- Start Place of Birth Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label">Place of Birth</label>
        <div class="col-sm-10 col-md-9">
            <?php include "inc/templates/countries.php"?>
        </div>
    </div>
    <!-- End Place of Birth Field -->
    
    <!-- Start Submit Field -->
    <div class="form-group">
        <div class="col-sm-offset-2  col-sm-10 col-md-8">
        <input type="button" id="updateBtn" value="Update" class="btn btn-primary btn-lg "/>
        </div>
    </div>
    <!-- End Submit Field -->
</form>
<script>
    $("#updateBtn").click(function(){
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var site = $("#site").val();
        var bio = $("#bio").val();
        var dob = $("#dob").val();
        var pob = $("#pob").val();
        
                
        $.ajax({
            type:'POST',
            url:'setPersonalInfo.php',
            data:{
                firstname : firstname,
                lastname : lastname,
                site : site,
                bio : bio,
                dob : dob,
                pob : pob
                
                 },
            success:function(){
                $("#containerPersonalSettings").load("showPersonalInfo.php");
            }
        });
    });

        
</script>

            
    <?php
                                 
        }else{
        echo 'ERROR';
        }