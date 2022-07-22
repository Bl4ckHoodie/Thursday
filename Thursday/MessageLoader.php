<?php
if ( $_SESSION['username'] != null){
$_SESSION['User'] = $_SESSION['username'];
try {
$db_server = db_connect();
$tquery = "SELECT users FROM users";
$tresult = mysqli_query($db_server, $tquery);
$rows1 = mysqli_fetch_array($tresult);
$rows2 = mysqli_fetch_array($tresult);
$name = "$rows1[0]$rows2[0]";   
$query = "SELECT * FROM $name";  
$result = mysqli_query($db_server, $query);
if (!$result) {
            Create($db_server);
        }
    }catch(Exception $e){ Create($db_server);}

   }
else{header('WWW-Authenticate: Basic realm="Restricted Section"'); header('HTTP/1.0 401 Unauthorized');  } 

function Create(){
$db_server = db_connect();
$query = "SELECT users FROM users";
$result = mysqli_query($db_server, $query);
if (!$result) {die("Database access failed: " . mysqli_error($db_server));}
 $rows = mysqli_num_rows($result);
for($i = 0; $i < $rows;++$i){$x = mysqli_fetch_array($result);$List_Users[] = $x[0];}
for($i = 0; $i < $rows;++$i){
    for($j = $i+1;$j < $rows;++$j){
      $nm = get_db_name($List_Users[$i],$List_Users[$j]);  
      mysqli_close($db_server);
      $db_server = db_connect();
      $query = "CREATE TABLE IF NOT EXISTS $nm (id INT NOT NULL AUTO_INCREMENT, user VARCHAR(16) NOT NULL, message VARCHAR(128), status VARCHAR(8), mdate VARCHAR(16),mtime VARCHAR(16),PRIMARY KEY (id));";
      $result = mysqli_query($db_server,$query); 
      if (!$result) {
                die("Database access failed: " . mysqli_error($db_server));
            }
        }
}
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
function Load_Message($user,$user2){
 $user1 = mysqli_fix_string($user);$db_name = get_db_name($user1, $user2);
 $Ddb_name = mysqli_fix_string($db_name); $db_server = db_connect();
 $query = "SELECT * FROM $Ddb_name";
 $result = mysqli_query($db_server,$query);
 if (!$result) { echo '';} 
 else { $rows = mysqli_num_rows($result);$mess  = "";
for ($i = 0; $i < $rows;++$i){$cur = mysqli_fetch_row($result);
if($cur[1] === $user1){
$mess = "<div class= 'container lighter'><img src = 'img/users/$cur[1].jpg' id = 'sender1'/>
<p>$cur[2]</p>
<span class='time-right'>$cur[5]</span>
</div>";echo $mess;   
}else{
$mess = "<div class= 'container darker'>
<img src = 'img/users/$cur[1].jpg' class='right'/>
<p>$cur[2]</p>
<span class='time-left'>$cur[5]</span>
</div>"; echo $mess;}
       
} 
    }
}
function get_db_name($user,$tuser2){$user1 = mysqli_fix_string($user);
$user2 = mysqli_fix_string($tuser2);
$nam = "$user1$user2";
$db_server = db_connect();
$query = "SELECT * FROM $nam";
$result = mysqli_query($db_server,$query);
if (!$result) { $nam = "$user2$user1"; return $nam;} else { return $nam; }

 
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
function Load_Contacts($user){
$db_server = db_connect();
$query = "SELECT users FROM users";$result = mysqli_query($db_server, $query);
if (!$result) {die("Database access failed: " . mysqli_error($db_server));}
$rows = mysqli_num_rows($result);
for($i = 0; $i < $rows;++$i){$x = mysqli_fetch_array($result);
if ($user != $x[0]) {$List_Users[] = $x[0]; } } $Mess = "";
for ($i = 0; $i < $rows-1;++$i){$db_name = get_db_name($user, $List_Users[$i]);
$query =  "SELECT * FROM $db_name ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($db_server, $query);
if (!$result){ $Mess ="<div id='Contacts' title='$List_Users[$i]' onclick='ShowMess()'>
<img src='img/users/$List_Users[$i].jpg' title='$List_Users[$i]' alt=''/><h2 id = 'name' title='$List_Users[$i]' >$List_Users[$i]</h2>
<label id='mess' title='$List_Users[$i]' style = 'left:-0.5;'>No Message</label><svg id='status'  height='2vw'
	width='2vw'><circle style='top:2vw;' cx='1vw'cy='1vw'r='0.9vw'stroke='white'stroke-width='0.1vw' fill='green'/>
	</svg><label id='m_time' title='$List_Users[$i]'></label></div>\n";echo $Mess; 
}else{ $cur = mysqli_fetch_row($result);
  echo contact_Check($user, $cur,$List_Users,$i);
}
}
}
function contact_Check($user,$cur,$List_Users,$i){
 if($cur[1] == $user){
 return "<div id='Contacts' title='$List_Users[$i]' onclick='ShowMess()'>
<img src='img/users/$List_Users[$i].jpg' title='$List_Users[$i]' alt='' /><h2 id = 'name' title='$List_Users[$i]' >$List_Users[$i]</h2>
<label id='mess' title='$List_Users[$i]'>You: $cur[2]</label><label id='m_time' title='$List_Users[$i]'>$cur[5] $cur[4]</label>
</div>"; 
 }else{
 return "<div id='Contacts' title='$List_Users[$i]' onclick='ShowMess()'>
<img src='img/users/$List_Users[$i].jpg' title='$List_Users[$i]' alt='' /><h2 id = 'name' title='$List_Users[$i]' >$List_Users[$i]</h2>
<label id='mess' title='$List_Users[$i]'>$List_Users[$i]: $cur[2]</label><label id='m_time' title='$List_Users[$i]'>$cur[5] $cur[4]</label>
</div>";}   
    
    
    
}

?>

