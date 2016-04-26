function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
//		window.print(timer);
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
//		window.print(minutes);
//		window.print(seconds);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
//		window.print(minutes);
//		window.print(seconds);

        display.textContent = minutes + ":" + seconds;
//		document.getElementById('progress').setAttribute("value", seconds/timer*100);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
	
}

//window.onload = function () {
//    var fiveMinutes = 60 * 5,
//        display = document.querySelector('#countdown');
//    startTimer(fiveMinutes, display);
//};

 
