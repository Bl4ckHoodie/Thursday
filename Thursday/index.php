<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head> 
       <?php 
        require_once 'login.php';
        ?>
        <title>Paul Assistance</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon"href="img/logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="index.css"> 
        <script src="js/jquery.js"></script>
        <script src="js/speech.js"></script>
    </head>
    <body>
        <header><a id="logoIcon" href =  "index.php"><img src="img/logo.png" href="index.html" /></a>
            <a id="DropboxIcon"><img src="img/dropbox.png" /></a> <a id="PlateformIcon" href = "Plateform.php"><img src="img/Plateform.png" /></a>   <a id="ChatIcon" href="messanger.php"><img src="img/Messanger.png" /></a> 
        </header> 
            <div id="User">
            <img src="img/users/<?php $name = $_SESSION['username'];echo $name
          ?>.jpg" />
                
            <a id = "myuser"><?php $name = $_SESSION['username'];echo $name
          ?></a>
        </div>
        <a id="results"></a>
        <div id="Paul"><a><img src="img/Paul.png" onclick="dictate();"/></a></div>
        <nav id="inboxs">
            <script type="text/javascript" src="js/dict.js">
            </script>
            <div id="textbx" ><input id="input" type="text" placeholder="Enter command" />
                <input id="sumbit" type="image" name="submit" onclick="Resp();" src="img/btn.gif" />
                
              <script>
                
                var inp = document.getElementById("input");
                inp.addEventListener("keyup", function(event){if (event.keyCode === 13){event.preventDefault();
                    document.getElementById("submit").click();}});
                </script>
            </div>
        </nav>
       </body>
    <footer>
<div class = "foot">
    <a href ="index.php"><img src= "img/logo.png" ></a>
<p class="copyright" style= "font-family:arial;color: white;">© 2019 Designed
                        <i class="fa fa-heart" aria-hidden="true"></i> By <br>
                        <a href="index.php" target="_blank" >M.H.I</a>
</p>

</div>
    
</footer>
</html>
