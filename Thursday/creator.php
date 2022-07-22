<?php
$db_server = Connect();
try {
$query = "SELECT users FROM users";
$result = mysqli_query($db_server, $query);
if (!$result){ Create(); Create_Files();}   
else{
$query = "SELECT * FROM Log;";
$result = mysqli_query($db_server, $query);
if(!$result)Create_Log();
}

}
catch(Exception $e){
 Create();
 Create_Files();
}
function Connect(){
$db_hostname = 'localhost'; 
$db_database = 'macd'; 
$db_username = 'root'; 
$db_password = ''; 
$db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
if (!$db_server) die("Unable to connect to MySQL: " . mysqli_error()); 
mysqli_select_db($db_server,$db_database) or die("Unable to select database: " . mysqli_error($db_server));
return $db_server;
}
function Create(){
$db_server = Connect();
$query = "CREATE TABLE IF NOT EXISTS Users (users VARCHAR(128), password VARCHAR(128), type VARCHAR(16));";
$result = mysqli_query($db_server,$query); 
if (!$result) die ("Database access failed: " . mysqli_error($db_server));
$salt1 = "M4p@!";        
$salt2 = "Tu35";
$user= "Mac";
$pass= "M4c_H4wk";
$type= "admin";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "T4";
$pass= "T3@4";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "Hitrik";
$pass= "H!Tr!k";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "Charlie";
$pass= "@K!nG";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "Bana";
$pass= "@Bana*/28";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "Mute";
$pass= "M!k3";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
$user= "PK";
$pass= "Ph3l0";
$type= "normal";
$token =  md5("$salt1$pass$salt2"); 
add($user, $token, $type);
}
function add($un, $pw, $ty){
 $db_hostname = 'localhost'; 
 $db_database = 'macd'; 
 $db_username = 'root'; 
 $db_password = ''; 
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 mysqli_select_db($db_server,$db_database) or die("Unable to select database: " . mysqli_error($db_server)); 
 $query = "INSERT INTO users VALUES('$un', '$pw','$ty')";    
 $result = mysqli_query($db_server,$query);    
 if (!$result) die ("Database access failed: " . mysqli_error($db_server)); 
}
function Create_Log(){
 $db_server = Connect();
 $query = "SELECT users FROM users";
 $result = mysqli_query($db_server, $query);
 $rows = mysqli_num_rows($result);
 for($i = 0; $i < $rows;++$i)
 { $x = mysqli_fetch_row($result); $List_Users[] = $x[0];  } 
 $query = "CREATE TABLE IF NOT EXISTS Log (users VARCHAR(128),status VARCHAR(128));";
 $result = mysqli_query($db_server,$query); 
 for ($i = 0; $i < $rows;++$i){
 $mdate = (string)date("d/m/Y");
 $mtime= (string)date("h:i a");
 $query = "INSERT INTO Log VALUES('$List_Users[$i]','$mdate $mtime');";    
 $result = mysqli_query($db_server,$query);   
 }
    
}
function Create_Files(){
 $db_server = Connect();
 $query = "SELECT users FROM users";
 $result = mysqli_query($db_server, $query);
 $rows = mysqli_num_rows($result);
 for($i = 0; $i < $rows;++$i)
 { $x = mysqli_fetch_row($result); $List_Users[] = $x[0];  } 
 $List_Users[] = "Public";
 for($i = 0; $i < $rows+1;++$i){
 $query = "CREATE TABLE IF NOT EXISTS $List_Users[$i]Files (filename VARCHAR(128));";
 $result = mysqli_query($db_server,$query);   
 mkdir("$List_Users[$i]");
 }       
}

?>


