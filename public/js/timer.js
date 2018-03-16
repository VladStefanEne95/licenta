let timer_seconds;
let timer;
let timer_aux = 0;

$( document ).ready(function() {
    timer_seconds = $("#wd-duration").text();

    if(timer_seconds != 0 && document.getElementById("stop-timer2") != null)
        timer = setInterval(myTimer, 1000);
});

function myTimer() {
    timer_seconds++; 
    document.getElementById("wd-duration").innerHTML = new Date(timer_seconds * 1000).toISOString().substr(11, 8);
}

function clock_in() {
    timer = setInterval(myTimer, 1000);
    $.get("/start-work-time", {time: timer_seconds});
    $( "#clock_in" ).replaceWith( "<li id='stop-timer1'><a href='#' onclick='clock_out()'>Clock out</a></li> <li id='stop-timer2'><a href='#' onclick='pause_day()'>Pause</a></li>" );
}
function continue_clock() {
    timer = setInterval(myTimer, 1000);
    $( "#clock_in" ).replaceWith( " <li id='stop-timer2'><a href='#' onclick='pause_day()'>Pause</a></li>" );
}

function clock_out() {
    clearTimeout(timer);
    $.get("/add-new-work-time", {time: timer_seconds});
    timer_seconds = 0;
    $( "#clock_in" ).replaceWith( "<li id='clock_in'><a href='#' onclick='clock_in()'>Start day</a></li>" )
    $( "#stop-timer1" ).replaceWith( "" );
    $( "#stop-timer2" ).replaceWith( "<li id='clock_in'><a href='#' onclick='clock_in()'>Start day</a></li>" );
}

function pause_day () {
    $.get("/add-pause", {time: timer_seconds, pause : 1});
    clearTimeout(timer);
    $( "#stop-timer1" ).replaceWith( "<li id='stop-timer1'><a href='#' onclick='clock_out()'>Clock out</a></li><li id='clock_in'><a href='#' onclick='continue_clock()'>Continue</a></li>" );
    $( "#stop-timer2" ).replaceWith( "" );
}

window.onbeforeunload = closingCode;
function closingCode(){
    $.get("/add-pause", {time: timer_seconds, pause: 0});
   return null;
}