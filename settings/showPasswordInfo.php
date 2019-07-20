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

    
    
    <!-- Start Date of Birth Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-3 control-label">Old Password</label>
        <div class="col-sm-9 col-md-9">
            <input type="hidden" id="hidoldpassword" value="<?php echo $row['pass'] ?>"/>
            <input type="password" id="oldpassword" class="form-control password" placeholder="Be carefull"/>
        </div>
    </div>
    
    <div class="form-group form-group-lg">
        <label class="col-sm-3 control-label">New Password</label>
        <div class="col-sm-9 col-md-9">
            <input type="password" id="newpassword" class="form-control password" placeholder="Make it Strong"/>
        </div>
    </div>
    
    <div class="form-group form-group-lg">
        <label class="col-sm-3 control-label">Confirm New Password</label>
        <div class="col-sm-9 col-md-9">
            <input type="password" id="confpassword" class="form-control password" placeholder="Make it Correct"/>
        </div>
        <div id="pass-alert" style="display:none; color:#F00;">Please Fill All Fields</div>
         <div id="err-pass-alert" style="display:none; color:#F00;">ERROR password</div>
         <div id="match-pass-alert" style="display:none; color:#F00;">The Two Passwords are not Matches</div>
    </div>
    <!-- End password Field -->

    <!-- Start Submit Field -->
    <div class="form-group">
        <div class="col-sm-offset-3  col-sm-10 col-md-8">
        <input type="button" id="updateBtn" value="Change Password" class="btn btn-primary btn-lg "/>
        </div>
    </div>
    <!-- End Submit Field -->
</form>
<script>
    $("#updateBtn").click(function(){
        var hidoldpassword = $("#hidoldpassword").val();
        var oldpassword = $("#oldpassword").val();
        var newpassword = $("#newpassword").val();
        var confpassword = $("#confpassword").val();
        
        if(oldpassword != "" && newpassword != "" && confpassword != ""){
            $("#pass-alert").hide("fast");
            if(hidoldpassword == oldpassword){
                $("#err-pass-alert").hide("fast");
                if(newpassword == confpassword){
                    $("#match-pass-alert").hide("fast");
                    $.ajax({
                        type:'POST',
                        url:'setPassword.php',
                        data:{
                            newpassword : newpassword
                             },
                        success:function(){
                            alert("Your Update is Done Successfully");
                            $("#containerPasswordSettings").load("showPasswordInfo.php");
                        }
                    });
                }else{
                    $("#match-pass-alert").show("fast");
                }
               }else{
               $("#err-pass-alert").show("fast");
               }    
        }else{
            $("#pass-alert").show("fast");
        }
        
                
    });

        
</script>

            
    <?php
                                 
        }else{
        echo 'ERROR';
        }