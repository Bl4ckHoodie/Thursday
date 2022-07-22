<?php
$db_hostname = 'localhost'; 
$db_database = 'macd'; 
$db_username = 'root'; 
$db_password = ''; 
$users = "";
include_once 'creator.php';
$db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
        if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
        mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {    
        $un_temp = mysqli_entities_fix_string($_SERVER['PHP_AUTH_USER']);  
        $pw_temp = mysqli_entities_fix_string($_SERVER['PHP_AUTH_PW']);
        $query = "SELECT * FROM users WHERE users='$un_temp'";   
        $result = mysqli_query($db_server,$query);    
        if (!$result) die("Database access failed: " . mysqli_error($db_server));    
        elseif (mysqli_num_rows($result))    
        {$row = mysqli_fetch_row($result);        
         $salt1 = "M4p@!";        
         $salt2 = "Tu35";        
         $token = md5("$salt1$pw_temp$salt2");
        if ($token == $row[1]){
          session_start();
          $_SESSION['username'] = $row[0];
          $_SESSION['type'] = $row[2];
          $users=$row[0];
        }     
        else die("Invalid username/password combination");    }    
        else die("Invalid username/password combination"); } 
        else {    header('WWW-Authenticate: Basic realm="Restricted Section"');    
        header('HTTP/1.0 401 Unauthorized');    die ("Please enter your username and password"); }
        function mysqli_entities_fix_string($string) {    
            return htmlentities(mysqli_fix_string($string)); }
        function mysqli_fix_string($string) {
            $db_hostname = 'localhost'; 
            $db_database = 'macd'; 
            $db_username = 'root'; 
            $db_password = ''; 
            $db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
        if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
        mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));
            if (get_magic_quotes_gpc()) $string = stripslashes($string);    
            return mysqli_real_escape_string($db_server,$string); }
?>

