<?php
$expAfter = 10;
if(isset($_SESSION['last_seen'])){
    $secondint = time() - $_SESSION['last_seen'];
    $expAfter = $expAfter *60;
    if($secondint >= $expAfter){
        if(isset($_SESSION['User'])){
        $tempuser = $_SESSION['User'];
        $db_server = db_connect();
        $mdate = (string)date("d/m/Y");
        $mtime= (string)date("h:i a");
        $query = "UPDATE Log SET status='$mdate $mtime' WHERE users='$tempuser';";   
        $result = mysqli_query($db_server,$query);     
        }
        session_unset();
        session_destroy();
    }else{
        if(isset($_SESSION['User'])){
        $tempuser = $_SESSION['User'];
        $db_server = db_connect();
        $query = "UPDATE Log SET status='Online' WHERE users='$tempuser';";   
        $result = mysqli_query($db_server,$query);     
        }
    }
    
    
    
}
$_SESSION['last_seen'] = time();

?>