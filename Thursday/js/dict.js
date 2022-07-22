            function Resp(){
             var usr = document.getElementById('input').value.toLowerCase(); 
             document.getElementById('input').value = "";
            Checker(usr);
         };
         function Checker(usr){  
           var out;
                if (usr === 'news' || usr === 'news update'){
                    out = Getnews();
                speak(out);}
            else{ if (usr === 'weather' || usr === 'weather update'){out = GetWeather();
                speak(out);}
                else {out = usr;
                vResp(out);}}  
         }
             // Set the text and voice attributes. 
             function vResp(usr){
             $.post("commands.php",{command:usr},function(data){ $('#results').html(data); speak(data);});
            
              }
              function Comm(input){
              var check = input;
              var out;
                  switch(check)
              {
                  case 'news': out = Getnews();
                  break;
                  case 'weather':out  = GetWeather();
                  break;
                  case 'location': out = Findme(); 
                  default: out = check;
                  break;
                  } 
              return out;
              }
              function Getnews(){return "where can i get the news";}
              function GetWeather(){
                  
                  return "it seems very cold this winter";}
              function Findme(){return "i found you";}
              function speak(data){
                var speech = new SpeechSynthesisUtterance();
                var mess1 = data;
             speech.text = mess1;
             speech.volume = 1;
             speech.rate = 1;
             speech.pitch = 1;
             speech.voice = speechSynthesis.getVoices()[0];
             speechSynthesis.speak(speech);  
              }
try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recogn = new SpeechRecognition();
}
catch(e) {
  console.error(e);
} 
function dictate(){
//const recogn = SpeechRecognition();
var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
var recogn = new SpeechRecognition();
var recogn = new webkitSpeechRecognition();
recogn.continous = false;
recogn.intermResults= false;
recogn.lan = 'en-ZA';
recogn.start();}
recogn.onresult = function(e){
    console.log(e.result[e.resultIndex][0].transcript);
    recogn.stop();
    recogn.onspeechend = function() {
  console.log('You were quiet for a while so voice recognition turned itself off.');
};
    };
recogn.onerror = function(e){recogn.stop();};
recogn.onstart = function() { 
  console.log('Voice recognition activated. Try speaking into the microphone.');
};