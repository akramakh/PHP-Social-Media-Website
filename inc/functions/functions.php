<?php

/*
** Title Function That Echo The Title In The Page
** Has The Variable $pageTitle and Echo Defualt Title
*/

function getTitle(){
    global $pageTitle;
    
    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo 'Default';
    }
}

/*
** Home Redirect Function v1.0  
** [this function Accept Parameters]
** $errorMsg = Echo the ERROR Message
** $seconds = Secounds before redirect
*/

function redirectHome($errorMsg, $seconds = 3){
    echo "<div class='alert alert-danger'>$errorMsg</div>";
    echo "<div class='alert alert-info'>You Will be Redirecter To Home Page After $seconds Seconds</div>";
    header("refresh:$seconds; url=index.php");
    exit();
}

/*
** Chick If Item is Already in The Database
** [this function Accept Parameters]
** $select = The Item to Select
** $from = From the Table to Select From it
** $value = The Value of Select
*/

function checkItem ($select, $from, $value){
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}

/********************************************
*******  Get User Info By Uder ID************
*********************************************/

function getUserInfo($type,$val){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ? ");
    
        $stmt->execute(array($val));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
      return $row[$type];  
    }else{
    return null; 
    }
}

/********************************************
*******  Get post Info By Uder ID************
*********************************************/

function getPostInfo($type,$val){
    global $con;
    $stmt = $con->prepare("SELECT * FROM posts WHERE post_id = ? ");
    
        $stmt->execute(array($val));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if($count > 0){
      return $row[$type];  
    }else{
    return null; 
    }
}

/*********************************************************************
********** Check if The Recieved ID is in Friend Tble in Database*****
**********************************************************************/
   
function isFriend($id){
    global $con;
    global $userid;
    $stmt = $con->prepare("SELECT DISTINCT * FROM friends WHERE (user_id = ? AND friend_id = ?) || (user_id = ? AND friend_id = ?)");
    $stmt->execute(array( $userid, $id, $id, $userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if($count > 0){
        return true;
    }else{
        return false;
    }         
}

/********************************
******** Return My Friend *******
********************************/