<html>
<head>
<title>Paul Messanger</title>
  
<meta charset="UTF-8">
<link rel="shortcut icon"href="img/logo.png"/>
<?php session_start(); require_once'MessageLoader.php';?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="mess.css"> 
<script src="js/mess.js"></script>
<script src="js/jquery.js"></script>
</head>
<body>
<header>
<div id="logo"><a href =  "index.php"><img src="img/logo.png" href="index.html" style="border-radius: 50%;"/></a></div>
<div id="settings"><img src="img/mess.png"/> <a id="home" href="index.php"><img src="img/H2.png"/></a><a href="messanger.php" ><img src="img/reload.png"/></a></div>
</header>
<div class = "containers">
<div class = "Split Profile">
<div class = "ID">
<img src = "img/users/<?php echo $_SESSION['User']; ?>.jpg" id ="profile-pic"/></div>
<nav><h2 id = "username"><?php echo $_SESSION['User']; ?></h2><img src = "img/onoff.png" id = "status"/></nav>
<hr style="position:relative;top: 2.5vw;width:100%;"/>
<img src = "img/contacts.png" id ="contact"/>
<!--<div id="Contacts" onclick="ShowMess()">
<img src="img/users/T4.jpg" alt="" /><h2 id = "name">T4</h2>
<label id="mess">Hello there buddy</label><svg id="log_stat" height="2vw"
	width="2vw"><circle style="top:2vw;" cx=" 1vw"cy="1vw"r="0.9vw"stroke="white"stroke-width="0.1vw" fill="green"/>
	</svg><label id="m_time">2:23 PM 27/4/2020</label>
</div>-->
<?php echo Load_Contacts($_SESSION['User']);require_once 'Status.php';?>
</div>
 
<div class = "Split Chat" id="Chat">
<div class="chater"><img src="img/CHATER.png" /></div>
<div id = "Mass">
<!--<div class= "container lighter">
<img src = "img/users/Charlie.jpg" id = "sender1"/>
<p>Hello. How are you today? </p>
<span class="time-right">12:15</span>
</div>
<div class= "container darker">
<img src = "img/users/T4.jpg" class="right"/>
<p>I am good Bra, How are you </p>
<span class="time-left">12:18</span>
</div>-->

</div>
<div id="textbx"> <input id="input" type="text" placeholder="Enter message" height="10%"  />
 <input id="sumbit" type="image" name="submit" onclick="Send();" src="img/btn.gif" /></div>
</div>

<style>
@media (max-width: 425px){
.container p {font-size:3.2vw;}
.container img {max-width: 10vw;top:2vw;}
.time-right {font-size:2.9vw;}
.time-left{font-size:2.9vw;}
.lighter p {top:1.7vw;left:-3.3vw;}
#Mass {width: 100%;}
.lighter img{position:relative;float:left;left: 0vw;}
#input{
height:5vw;	
font-size:2.9vw;}
#sumbit{
width:5vw;
height:5vw;	
left: 16vw;
top: 1.1vw;
}
}

</style>
</div>
</body>


</html>