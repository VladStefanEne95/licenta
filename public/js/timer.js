let timer_seconds;
let timer;

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
    if ($('#taskTimeBtn').text === "Stop time tracking")
        $.get(window.location.href + "/update-task-time", {time: task_timer_seconds, pause : 0});
    if(timer_seconds != 0)
        $.get("/add-pause", {time: timer_seconds, pause: 0});
   return null;
}


//task timer
let task_timer = 0;
let task_timer_seconds = 0;
let timer_arr = [];
function myTaskTimer() {
    task_timer_seconds++; 
    document.getElementById("taskTimeSpent").innerHTML ="Time spent on this task " + new Date(task_timer_seconds * 1000).toISOString().substr(11, 8);
}

$( document ).ready(function() {
    if($('#taskTimeSpent').text() !== "Time spent on this task: 0;"){
        task_timer_seconds = Number($('#taskTimeSpent').text().replace(/\D/g,''));
        if($('#taskPause').text() == "0") {
            continueTaskTime();
        }
        if($('#taskPause').text() == "1") {
            pauseTaskTime();
        }
    }
});

function startTaskTime() {
    task_timer = setInterval(myTaskTimer, 1000);
    let aux = window.location.href + "/start-task-time";
    $('#taskTimeBtn').text("Stop time tracking");
    $.get( aux );
    $("#taskTimeBtn").attr("onclick","pauseTaskTime()");
    timer_arr[window.location.href] = 1;
    return null;
}


function pauseTaskTime() {
    clearTimeout(task_timer);
    $('#taskTimeBtn').text("Continue time tracking");
    $("#taskTimeBtn").attr("onclick","continueTaskTime()");
    $.get(window.location.href + "/update-task-time", {time: task_timer_seconds, pause : 1});
    timer_arr[window.location.href] = 0;
}

function continueTaskTime() {
    task_timer = setInterval(myTaskTimer, 1000);
    $('#taskTimeBtn').text("Stop time tracking");
    $("#taskTimeBtn").attr("onclick","pauseTaskTime()");
    timer_arr[window.location.href] = 1;
    $.get(window.location.href + "/update-task-time", {time: task_timer_seconds, pause : 0});
}



function finishTask() {
    let aux = window.location.href + "/finish-task";
    $.get( aux );
    toastr.success('Task status has been updated', 'Succes!');
}