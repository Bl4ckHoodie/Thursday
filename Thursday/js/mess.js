var Reciever = "";
function ShowMess()
{Reciever = event.target.title;
 loadmess(Reciever);
var mess = document.getElementById("Mass");
mess.style.visibility = "visible";
var chat = document.getElementById("Chat");
chat.style.visibility = "visible";
var wsize = screen.width;
var input = document.getElementById("textbx");
input.style.visibility = "visible";
if (wsize < 430){
chat.style.width = "100%";
}           
}
function Send(){
 var mess = document.getElementById('input').value;
 if(mess !== ""){
 document.getElementById('input').value = "";
 $.post("PassMessage.php",{mess:mess,usr:Reciever},function(data){ $('#Mass').html(data); });    
 }
}
function loadmess(m){
 $.post("PassMessage.php",{loadmessage:m},function(data){ $('#Mass').html(data);});
}