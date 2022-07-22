<?php
session_start();
if (isset($_POST['loadmessage'])) 
{Load_Message($_SESSION['User'], $_POST['loadmessage']); }
function Load_Message($user,$user2){
 $user1 = mysqli_fix_string($user);$db_name = get_db_name($user1, $user2);
 $Ddb_name = mysqli_fix_string($db_name); $db_server = db_connect();
 $query = "SELECT * FROM $Ddb_name";
 $result = mysqli_query($db_server,$query);
 if (!$result) { echo "<div class= 'container lighter'><img src = 'img/users/$user.jpg' id = 'sender1'/>
<p>There was an error loading your messages</p>
<span class='time-right'>11:00</span>
</div>";} 
 else { $rows = mysqli_num_rows($result);$mess  = "";
for ($i = 0; $i < $rows;++$i){$cur = mysqli_fetch_row($result);
if($cur[1] === $user1){
$mess = "<div class= 'container lighter'><img src = 'img/users/$cur[1].jpg' id = 'sender1'/>
<p>$cur[2]</p>
<span class='time-right'>$cur[4] $cur[5]</span></div>\n";echo $mess; 
}else{
$mess = "<div class= 'container darker'>
<img src = 'img/users/$cur[1].jpg' class='right'/>
<p>$cur[2]</p><span class='time-left'>$cur[4] $cur[5]</span></div>\n"; echo $mess;}
       
} 
    }
}
if (isset($_POST['mess']) && isset($_POST['usr'])){
    $user1 = mysqli_fix_string(mysqli_entities_fix_string($_SESSION['User'])); 
    $mes = mysqli_fix_string(mysqli_entities_fix_string($_POST['mess']));
    $user2 = mysqli_fix_string(mysqli_entities_fix_string($_POST['usr']));
    Add_Message($user1, $mes, $user2);
    Load_Message($user1, $user2);
    Make_Seen($user1, $user2);
}
function mysqli_entities_fix_string($string) {    
            return htmlentities(mysqli_fix_string($string)); }
function mysqli_fix_string($string) {
            $db_hostname = 'localhost'; 
            $db_database = 'macd'; 
            $db_username = 'root'; 
            $db_password = ''; 
            $db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
            if (!$db_server) {
        die("Unable to connect to MySQL: " . mysql_error());
    }
    mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));
        if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }
    return mysqli_real_escape_string($db_server,$string); }
function get_db_name($user,$tuser2){$user1 = mysqli_fix_string($user);
$user2 = mysqli_fix_string($tuser2);
$nam = "$user1$user2";
$db_server = db_connect();
$query = "SELECT * FROM $nam";
$result = mysqli_query($db_server,$query);
if (!$result) { $nam = "$user2$user1"; return $nam;} else { return $nam; }

 
 }
function db_connect(){
$db_hostname = 'localhost'; 
$db_database = 'macd'; 
$db_username = 'root'; 
$db_password = '';    
$db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));
return $db_server;  
}
function Load_Contacts($user){
$db_server = db_connect();
$query = "SELECT users FROM users";$result = mysqli_query($db_server, $query);
if (!$result) {die("Database access failed: " . mysqli_error($db_server));}
 $rows = mysqli_num_rows($result);
for($i = 0; $i < $rows;++$i){$x = mysqli_fetch_row($result);
if ($user != $x[0]) {$List_Users[] = $x[0]; } } 
$Mess = "";
for ($i = 0; $i < $rows-1;++$i){
$db_name = get_db_name($user, $List_Users[$i]);
$query = "SELECT TOP 1 * FROM '$db_name' ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($db_server, $query);
if (!$result){ $Mess ="<div id='Contacts' title='$List_Users[$i]' onclick='ShowMess()'>
<img src='img/users/$List_Users[$i].jpg' title='$List_Users[$i]' alt=''/><h2 id = 'name' title='$List_Users[$i]' >$List_Users[$i]</h2>
<label id='mess' title='$List_Users[$i]' style = 'left:-0.5;'>No Message</label><label id='m_time' title='$List_Users[$i]'></label></div>\n";echo $Mess; 
}else{ $cur = mysqli_fetch_row($result);
$Mess ="<div id='Contacts' title='$cur[1]' onclick='ShowMess()'>
<img src='img/users/$cur[1].jpg' title='$cur[1]' alt='' /><h2 id = 'name' title='$cur[1]' >$cur[1]</h2>
<label id='mess' title='$cur[1]'>$cur[2]</label><label id='m_time' title='$cur[1]'>$cur[5] $cur[4]</label>
</div>"; echo $Mess;}
}
}
function Make_Seen($user,$user2){
 $user1 = mysqli_fix_string($user);
 $tdb_name = get_db_name($user1, $user2);
 $db_name = mysqli_fix_string($tdb_name);
 $db_server = db_connect();
 $query = "UPDATE $db_name SET status='seen' WHERE user='$user1';";
 $result = mysqli_query($db_server,$query); 
 if (!$result) {
        die("Database access failed: " . mysqli_error($db_server));
    }
}
function Add_Message($user,$db_mess, $user2){
  $user1 = mysqli_fix_string($user);
  $db_name = get_db_name($user1, $user2);
 
  $tuser = mysqli_fix_string($user1);
  $tdb_mess = mysqli_fix_string($db_mess);
  $mdb_mess = mysqli_entities_fix_string($tdb_mess);
  $tdb_name = mysqli_fix_string($db_name);
  $mdate = (string)date("d/m/Y");
  $mtime= (string)date("h:i a");
  $db_server = db_connect();
  $query = "INSERT INTO $tdb_name VALUES(NULL,'$tuser','$mdb_mess','sent','$mdate','$mtime');";
  $result = mysqli_query($db_server,$query);  
  if (!$result) {
        die("Database access failed: " . mysqli_error($db_server));
    }
}

?>

