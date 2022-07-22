var Codelang = 1;
var ldedFile = 0;
var fn = "";
var fnum = 0;
var change = 0;
 

function setchange(){
  change = 1; 
}


function showlang(){
var lang = document.getElementById("languages");lang.style.visibility = "visible";
var savedfile = document.getElementById("saved_file");savedfile.style.top = "3.5vw";
var publicfile = document.getElementById("public_file");publicfile.style.top = "10.5vw";
var codefm = document.getElementById("CDForm");
codefm.style.visibility = "hidden";
var Filefm = document.getElementById("FLForm");
Filefm.style.visibility = "hidden";

}

function NewFile(num){
var codefm = document.getElementById("CDForm");
codefm.style.visibility = "visible";
var Filefm = document.getElementById("FLForm");
Filefm.style.visibility = "visible";
Codelang = num;
document.getElementById("lineform").value = "";
document.getElementById("lineform").value = CodeLang(Codelang);
var lang = document.getElementById("languages");lang.style.visibility = "hidden";
ldedFile = 0;
}
//==============================================================================//
function CodeLang(num){
 var author = document.getElementById("myuser").innerHTML;
switch(num){
case 1: return "//Author- "+author+"\tLanguage: C# \nusing System;\nusing System.Collections.Generic;\nusing System.Linq;\nusing System.Text;\nusing System.Threading.Tasks;\n\nnamespace CodePlate\n{\n\t class Program\n\t{\n\t\t static void Main(string[] args)\n\t\t{\n\n\t\t}\n\t}\n}";break;
case 4: return "//Author- "+author+"\tLanguage: Java \npublic class Program\n{\n\tpublic static void main(String[] args)\n\t\t{\n\n\t\t}\n}";break;
case 17: return "//Author- "+author+"\tLanguage: JavaScript \n";break;
case 6: return "//Author- "+author+"\tLanguage: C \n#include <stdio.h>\n\nint main() {\n\treturn 0;\n}";break;
case 7: return "//Author- "+author+"\tLanguage: C++ \n#include <iostream>\nusing namespace std;\n\nint main() {\n\treturn 0;\n}";break;
case 8: return "//Author- "+author+"\tLanguage: PHP \n<?php\n\n?>";break;
case 24: return "#Author- "+author+"\tLanguage: Python\n";break;
case 12: return "#Author- "+author+"\tLanguage: Ruby\n";break;
default: return ""; break;
}
}
//==============================================================================//
function CloseFile(){
if (change === 1)
    if (confirm("Would you like to save changes to file?"))
       Savefile(); 
var codefm = document.getElementById("CDForm");
codefm.style.visibility = "hidden";
var Filefm = document.getElementById("FLForm");
Filefm.style.visibility = "hidden";   
var lang = document.getElementById("languages");
lang.style.visibility = "hidden";  
change = 0;
location.reload();
}
function changfile(){
var lang = document.getElementById("languages");lang.style.visibility = "hidden";
var codefm = document.getElementById("CDForm");
codefm.style.visibility = "hidden";
var Filefm = document.getElementById("FLForm");
Filefm.style.visibility = "hidden";
}
function LoadFile(num){
  if (num === 0){
  var e = document.getElementById("privselect");
  var bx = e.options[e.selectedIndex].text;
  if (bx !== "None" || bx !== ""){
  $.post("PlateCode.php",{loadprivfile:bx},function(data){ $('#lineform').html(data);}) ;   
  var codefm = document.getElementById("CDForm");
  codefm.style.visibility = "visible";
  var Filefm = document.getElementById("FLForm");
  Filefm.style.visibility = "visible";
  fn = bx;
  fnum = 0;
  ldedFile =1;
  }
  }else{
      var e = document.getElementById("pubselect");
      var bx = e.options[e.selectedIndex].text;
      if (bx !== "None" || bx !== "" ){
  $.post("PlateCode.php",{loadpubfile:bx},function(data){ $('#lineform').html(data);}) ;   
  var codefm = document.getElementById("CDForm");
  codefm.style.visibility = "visible";
  var Filefm = document.getElementById("FLForm");
  Filefm.style.visibility = "visible";
  fn = bx;
  fnum = 1;
  ldedFile = 1;     
  }
  }
 
}
function deleteFile(num){
if (num === 0){
  var e = document.getElementById("privselect");
  var bx = e.options[e.selectedIndex].text;
  if (bx !== "None" || bx !== ""){
  var usr = document.getElementById("myuser").innerHTML;
  $.post("PlateCode.php",{deletefile:bx,dir:usr},function(data){ alert(data);location.reload(); }) ;   
  }
  }else{
      var e = document.getElementById("pubselect");
      var bx = e.options[e.selectedIndex].text;
      if (bx !== "None" || bx !== "" ){
   var usr ="Public";
  $.post("PlateCode.php",{deletefile:bx,dir:usr},function(data){ alert(data);location.reload();}) ;        
  }
  } 
    
}
function RunCode(){
var to_compile = {"LanguageChoice":CodeLang.toString(),"Program":$("#lineform").value, "Input":"","CompilerArgs":" "};
$.post("https://rextester.com/rundotnet/api",{data:to_compile},function(data){ $('#outputform').html(data); });  
}

function Savefile(){
 if(ldedFile === 0 ){ 
 var usr = document.getElementById("myuser").innerHTML;
 var code = document.getElementById("lineform").value;
 var flname = prompt("Save as ",'');
 var radio = document.getElementsByName("savetype");
 var dir = "0";
 for (var i = 0;i <radio.length;i++){
     if (radio[i].checked){
      dir = radio[i].value.toString();
      break;
     }}
 if(dir === "0")
     dir = usr;
 else 
     dir = "Public";
 console.log(code);
 $.post("PlateCode.php",{filename:flname,filecont:code,dir:dir},function(data){ alert(data.toString());}) ; 
 }else{
 
 var usr = document.getElementById("myuser").innerHTML;
  var code = document.getElementById("lineform").value;
  var flname = "";
 var radio = document.getElementsByName("savetype");
 var dir = "0";
 for (var i = 0;i <radio.length;i++){
     if (radio[i].checked){
      dir = radio[i].value.toString();
      break;
     }}
 var fndir = fnum.toString();
 if((fndir === dir) &&(ldedFile === 1)){
  flname = fn.toString();
 if(fndir === "0")
     fndir = usr;
 else 
     fndir = "Public"; 
 $.post("PlateCode.php",{deletefile:flname,dir:fndir},function(data){ console.log(data);}) ;
 }
 else {flname = prompt("Save as ",'');}
 if(dir === "0")
     dir = usr;
 else 
     dir = "Public"; 
 if (flname !== ""){
 $.post("PlateCode.php",{filename:flname,filecont:code,dir:dir},function(data){ alert(data.toString());}) ; 
 change = 0;
 }
 }   
}