<?php
function getRes($commnd){
$db_hostname = 'localhost'; 
$db_database = 'macd'; 
$db_username = 'root'; 
$db_password = ''; 
$db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
$com = mysqli_entities_fix_string($commnd, $db_server);
        if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
        mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));  
$query = "SELECT * FROM dictate WHERE user='$com'";   
$result = mysqli_query($db_server,$query);      
  if (!$result) return "Command could not be recognized";    
        elseif (mysqli_num_rows($result))    
        {$row = mysqli_fetch_row($result);  
        if ($commnd == $row[1])
         return $row[0];
        }  else return "Command could not be recognized";
}
function mysqli_entities_fix_string($string,$db_server) {    
            return htmlentities(mysqli_fix_string($string,$db_server)); }
function mysqli_fix_string($string,$db_server) {
            if (get_magic_quotes_gpc()) $string = stripslashes($string);    
            return mysqli_real_escape_string($db_server,$string); }
function destroy_session_and_data() {    
    $_SESSION = array();    
    if (session_id() != "" || isset($_COOKIE[session_name()]))        
    setcookie(session_name(), '', time() - 2592000, '/');    
    session_destroy();
    $time = ini_set('session.gc_maxlifetime', 60 * 60 * 3);
}
if (isset($_POST['command'])) 
             { 
           $comm = getRes($_POST['command']);
           $rep = $comm;
           echo $comm;
           
             }
            else
            {
           echo "command was not recognized"; }
?>



 
