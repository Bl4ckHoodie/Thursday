<html>
<head>
 <title>Code Plateform</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon"href="img/logo.png"/>
        <?php require'PlateCode.php'; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/PlatStyle.css"> 
        <script src="js/jquery.js"></script><script src="js/plateform.js"></script>
</head>
<body>
<header><a id="logoIcon" href =  "index.php"><img src="img/logo.png" href="index.html" /></a> </header> 
<div id="User"><img src="img/users/<?php echo $_SESSION['User']; ?>.jpg" /> <a id = "myuser"><?php echo $_SESSION['User']; ?></a> </div>
<div class = "Split StartMenu">
<div id="newfile"> <img id ="newfileimg"src="img/newfile.png" onclick="showlang()"/> <div id="languages"> <img src="img/icons/csharp.png" onclick="NewFile(1)"/><img src="img/icons/c.png" onclick="NewFile(6)"/><img src="img/icons/c++.png"onclick="NewFile(7)"/>
<img src="img/icons/java.png"onclick="NewFile(4)"/><img src="img/icons/js.png"onclick="NewFile(17)"/><img src="img/icons/php.png"onclick="NewFile(8)"/><img src="img/icons/python.png"onclick="NewFile(24)"/><img src="img/icons/ruby.png"onclick="NewFile(12)"/>
</div> </div>
<div id="saved_file"><a id="savedfiletitle">SAVED FILES</a><br>
<select style="width:100%" id="privselect" onchange="changfile()">
<?php showprivFile();?>
</select>
    <div id="SavedOption"><img src="img/loadfile.png" onclick="LoadFile(0)"/><img src="img/deletefile.png" onclick="deleteFile(0)"/></div>

</div>
<div id="public_file"><a id="savedfiletitle">PUBLIC FILES</a><br>
<select style="width:100%" id="pubselect" onchange="changfile()">
<?php showpubFile();?>
</select>
    <div id="SavedOption"><img src="img/loadfile.png" onclick="LoadFile(1)"/><img src="img/deletefile.png" onclick="deleteFile(1)"/></div>
</div>
</div>
<div class = "Split CodeForm" id="CDForm">
    <textarea id="lineform" oninput="setchange()"></textarea>
<textarea id="outputform" readonly="readonly"></textarea>
</div>
<div class = "Split FileMenu" id="FLForm">
<img src="img/runfile.png" onclick="RunCode()"/>
<div id="savefile">
    <img src="img/savefile.png" onclick="Savefile()"/>
<div id="savetype"><fieldset name="SaveType">
				<legend>Save As</legend>
				<input name="savetype" value="1" type="radio">
                                Public</input><br>
                                <input name="savetype" value="0" type="radio" checked="checked">
                                Private</input> <br>
			</fieldset></div>
</div>
<img src="img/closefile.png" onclick="CloseFile()"/>
<img src="img/downloadfile.png"/>

</div>
</body>

</html>