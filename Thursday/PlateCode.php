<?php
try{
    session_start();
if ( $_SESSION['username'] != null){
$_SESSION['User'] = $_SESSION['username'];}} 
 catch (Exception $e){ 
}
if (isset($_POST['loadprivfile'])){
$_POST = remove_magic_qoutes($_POST);
$file = mysqli_fix_string(mysqli_entities_fix_string($_POST['loadprivfile']));
echo LoadPrivFiles($file);
unset($_POST['loadprivfile']);
}else
if (isset($_POST['loadpubfile'])){
$_POST = remove_magic_qoutes($_POST);
$file = mysqli_fix_string(mysqli_entities_fix_string($_POST['loadpubfile']));
echo LoadPubFiles($file);
unset($_POST['loadpubfile']);
}else
if (isset($_POST['filename']) && isset($_POST['filecont']) && isset($_POST['dir'])){
    Check();
 $filecont  = mysqli_fix_string(mysqli_entities_fix_string($_POST['filecont']));
 $filename = mysqli_fix_string(mysqli_entities_fix_string($_POST['filename']));
 $dir = mysqli_fix_string(mysqli_entities_fix_string($_POST['dir']));
 if (!Exist($filename, $dir))
 echo WriteFile($filename, $dir);
 else
 echo "There already exists a file named $filename";
unset($_POST['filename']);
unset($_POST['filecont']);
unset($_POST['dir']);
}else
if (isset($_POST['deletefile']) && isset($_POST['dir'])){
    Check();
 $filename = mysqli_fix_string(mysqli_entities_fix_string($_POST['deletefile']));
 $dir = mysqli_fix_string(mysqli_entities_fix_string($_POST['dir']));  
 return deleteFile($dir, $filename);
 unset($_POST['deletefile']);
}
//=======================================================================//
function remove_magic_qoutes($arr){
    foreach ($arr as $k => $v){
        if(is_array($v)){
          $arr[$k] = remove_magic_qoutes($v);  
        } else
            {$arr[$k] = stripslashes($v);}
        
        }
        return $arr;
          
}
//============================================================================//
function Check(){
if (get_magic_quotes_gpc()){
 $_GET= remove_magic_qoutes($_GET);
 $_POST = remove_magic_qoutes($_POST);
 $_COOKIE = remove_magic_qoutes($_COOKIE);   
}
}
//========================================================================//
function DownloadFile($filename,$dir){
    header("Content-Type:application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition:attachment; filename=\"".$filename."\"");
    echo readfile("$dir/$filename.txt");
    
}
function WriteFile($filename,$dir){
    if (!Exist($filename, $dir)) {
        file_put_contents("$dir/$filename.txt",$_POST['filecont']);
        $db_server = db_connect();
        $dir = $dir."Files";
        $query = "INSERT INTO $dir VALUES('$filename');";
        $result = mysqli_query($db_server, $query);
        if($result){return "$filename suceessfully added";}
    } else {
        return "Fail $filename, could not be added";
    }
}
//========================================================================//
function LoadPubFiles($file){
if (Exist($file,"Public")){
return file_get_contents("Public/$file.txt");
}
}
//======================================================================//
function showpubFile(){
 $db_server = db_connect();
 $query = "SELECT * FROM PublicFiles";
 $result = mysqli_query($db_server, $query);
 $rows = mysqli_num_rows($result);
 $line = "";
 for ($i = 0; $i < $rows; ++$i){
 $x = mysqli_fetch_row($result);
 $line = "<option value='$x[0]'>$x[0]</option>";
 echo $line;     
 }
}
//======================================================================//
function showprivFile(){
 $usr =$_SESSION['User'] ;
 $db_server = db_connect();
 $usr = $usr."Files";
 $query = "SELECT * FROM $usr";
 $result = mysqli_query($db_server, $query);
 $rows = mysqli_num_rows($result);
 $line = "";
 for ($i = 0; $i < $rows; ++$i){
 $x = mysqli_fetch_row($result);
 $line = "<option value='$x[0]'>$x[0]</option>";
 echo $line;     
 }
}
//=====================================================================//
function LoadPrivFiles($file){
$usr =$_SESSION['User'] ;
if (Exist($file, $usr)){
return file_get_contents("$usr/$file.txt");
}
}
//=====================================================================//
function db_connect(){
$db_hostname = 'localhost'; 
$db_database = 'macd'; 
$db_username = 'root'; 
$db_password = '';    
$db_server = mysqli_connect($db_hostname, $db_username, $db_password); 
mysqli_select_db($db_server,$db_database)or die("Unable to select database: " . mysqli_error($db_server));
return $db_server;  
}
//=========================================================================//
function Exist ($file,$usr){ 
    if (file_exists("$usr/$file.txt")){ return true;}
    else {return false;}
}
//=========================================================================//
function mysqli_entities_fix_string($string) {    
            return htmlentities(mysqli_fix_string($string)); }
//======================================================================//
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
//===================================================================//
function deleteFile($dir,$fname){
    unlink("$dir/$fname.txt"); 
    if (Exist($fname, $dir)) {
        echo "Error $fname Could not be Deleted";
    } else {
        $dir = $dir."Files";
        $db_server = db_connect();
        $query = "DELETE FROM $dir WHERE filename='$fname'";
        $result = mysqli_query($db_server, $query);
        if ($result) {
            echo "$fname successfully deleted";      
        }
    }
}
//===================================================================//
if ($_FILES){
    $usr = $_SESSION['User'] ;
    $dir = "$usr/";
    move_uploaded_file($_FILES['filename']['name'],$dir);
}
    ?>