<?php
session_start();
require 'inc/db.php';
require 'inc/functions/functions.php';
$userid = $_SESSION['logged_in'] ? $_SESSION['userID'] : null;

        $stmt = $con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($stmt->rowCount() > 0){?>
<style>
    .conditions-header{
        color: #d9534f;
        margin-top: 0;
    }
    .conditions-list{
        list-style: circle;
    }
    .conditions-list li{
        margin-left: 30px;
    }
</style>
<form class="form-horizontal" action="?do=Update" method="post">
    <!-- Start Conditions Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-9 col-md-9">
            <h2 class="conditions-header">after removing your account read the following cearfully !!!</h2>
            <ul class="conditions-list">
                <li><h5>You can not retrive your account after this operation.</h5></li>
                <li><h5>You can not chat your friend.</h5></li>
                <li><h5>Your information will removed from our database after 2 weeks.</h5></li>
            </ul>
        </div>
    </div>
    <!-- Start Password Field -->
    <div class="form-group form-group-lg">
        <label class="col-sm-3 control-label">Type Password</label>
        <div class="col-sm-9 col-md-9">
            <input type="hidden" id="hidoldpassword" value="<?php echo $row['pass'] ?>"/>
            <input type="hidden" id="id" value="<?php echo $userid ?>"/>
            <input type="password" id="password" class="form-control password" placeholder="Be carefull"/>
            <div id="pass-alert" style="display:none; color:#F00;">Please Fill All Fields</div>
            <div id="err-pass-alert" style="display:none; color:#F00;">ERROR password</div>
        </div>
    </div>
    <!-- Start Submit Field -->
    <div class="form-group">
        <div class="col-sm-offset-3  col-sm-10 col-md-8">
        <input type="button" id="updateBtn" value="Change Password" class="btn btn-danger btn-lg "/>
        </div>
    </div>
    <!-- End Submit Field -->
</form>
<script>
    $("#updateBtn").click(function(){
        var hidoldpassword = $("#hidoldpassword").val();
        var password = $("#password").val();
        var id = $("#id").val();
       
        if(password != "" ){
            $("#pass-alert").hide("fast");
            if(hidoldpassword == password){
                $("#err-pass-alert").hide("fast");
                    $.ajax({
                        type:'POST',
                        url:'removeAccount.php',
                        data:{
                            id : id
                             },
                        success:function(){
                            $("#containerRemoveAccountSettings").load("successRemoveAccountSettings.php");
                            $(location).attr('href','../login-system/logout.php');
                        }
                    });
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