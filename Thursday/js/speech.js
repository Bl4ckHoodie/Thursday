function dictate(){
try {
  var SpeechRecognition = SpeechRecognition || window.webkitSpeechRecognition;
  var recogn = new SpeechRecognition();
}
catch(e) {
  console.error(e);
} 
//const recogn = SpeechRecognition();
recogn.onstart = function() { 
  console.log('Voice recognition activated. Try speaking into the microphone.');
};

recogn.onspeechend = function() {
  console.log('You were quiet for a while so voice recognition turned itself off.');
};


var recogn = new SpeechRecognition;
recogn.continous = false;
recogn.intermResults= false;
recogn.lan = 'en-ZA';
recogn.start();
recogn.onresult = function(e){
    var res = e.results[e.resultIndex][0].transcript;
    console.log(res);
    vResp(res);
    recogn.stop();
    
    };
recogn.onerror = function(e){recogn.stop();};
     }