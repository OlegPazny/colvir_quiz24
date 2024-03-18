window.onload = function () {
	
	var seconds = 00; 
	var tens = 00; 
	var appendTens = document.getElementById("tens")
	var appendSeconds = document.getElementById("seconds")
	var buttonStart = document.getElementById('button-start');
	var buttonStop = document.getElementById('button-stop');
	var buttonReset = document.getElementById('button-reset');
	var buttonNxt = document.getElementById('nxt');
	
	var Interval ;
	msoundPlay();
	
	
	buttonNxt.onclick = function() {
		
		msoundStop();
		qsoundStop();
		rsoundPlay();
	}
	
	buttonStart.onclick = function() {
		
		clearInterval(Interval);
		Interval = setInterval(startTimer, 10);
		msoundStop();
		rsoundStop();
		qsoundPlay();
	}
	
    buttonStop.onclick = function() {
		clearInterval(Interval);
		qsoundStop();
		msoundPlay();
	}
	
	
	buttonReset.onclick = function() {
		clearInterval(Interval);
		tens = "00";
		seconds = "00";
		appendTens.innerHTML = tens;
		appendSeconds.innerHTML = seconds;
		qsoundReset();
	}
	
	
	function rsoundPlay(){
		var rsound = document.getElementById("rsound");
		rsound.volume = 0.08;
		rsound.play();
	}  
	
	function rsoundStop(){
		rsound.pause();
		rsound.currentTime = 0;
	}  
	
	
	function msoundPlay(){
		var msound = document.getElementById("msound");
		msound.volume = 0.04;
		msound.play();
	}  
	
	function msoundStop(){
		msound.pause();
		msound.currentTime = 0;
		
	}  
	
	
	function qsoundPlay(){
		var qsound = document.getElementById("qsound");
		qsound.volume = 0.1;
		qsound.play();
	}  
	
	function qsoundStop(){
		qsound.pause();
		rsound.pause();
		rsound.currentTime = 0;
	}  
	
	function qsoundReset(){
		qsound.pause();
		qsound.currentTime = 0;
	}  
	
	function startTimer () {
		tens++; 
		
		if(tens < 9){
			appendTens.innerHTML = "0" + tens;
		}
		
		if (tens > 9){
			appendTens.innerHTML = tens;
			
		} 
		
		if (tens > 99) {
			console.log("seconds");
			seconds++;
			appendSeconds.innerHTML = "0" + seconds;
			tens = 0;
			appendTens.innerHTML = "0" + 0;
		}
		
		if (seconds > 9){
			appendSeconds.innerHTML = seconds;
		}
		
	}
	
	
}