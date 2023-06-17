<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #countdown {
        font-size: 24px;
        text-align: center;
        }
        #timer {
        font-size: 24px;
        text-align: center;
        }
    </style>
    <script src="script.js"></script>

    <script src="{{ asset('/js/script.js') }}"></script>
</head>

<body>
    
<div id="query-results"></div>
<span id="timerDisplay">00:00:00</span>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: '/query-results',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
             

                var savedValue = sessionStorage.getItem('previousStatus');
                var newStatus =  response[0].status;

                switch(response[0].status) {
                    case 'READY':
                    // code block
                    $("#timerDisplay").css('color','blue');
                    console.log('READY');
                    break;
                    case 'QUEUE':
                    // code block
                    $("#timerDisplay").css('color','blue');
                    break;

                    case 'INCALL':
                        $("#timerDisplay").css('color','green');
            
                    break;
                    
                    case 'PAUSED':
                        $("#timerDisplay").css('color','red');
                        console.log('PAUSED');

                     break;

                    case 'CLOSER':

                        console.log('CLOSER');

                    break;

                    default:
                    // code block
                    }

                if(savedValue != newStatus){
                    updateTimerDisplay();
                    console.log('stop timer');
                }
                updateTimer();
                // Update the view with the new query results
                $('#query-results').html(response);
                // response[0].status = ""; 
                    var agent_status =    response.result;
                 
                    var element = document.getElementById("query-results");
                    //  element.append(agent_status);
                    element.append(response[0].status);

                    sessionStorage.setItem('previousStatus', response[0].status);
                    sessionStorage.setItem('NextStatus', response[0].status);

                   
          
            }
        });
    }, 1000); // Refresh every 1 second (1000 milliseconds)
});
</script>

<script>
let timerInterval;
let seconds = 0;
let minutes = 0;
let hours = 0;

function updateTimer() {
  seconds++;
  if (seconds === 60) {
    seconds = 0;
    minutes++;
    if (minutes === 60) {
      minutes = 0;
      hours++;
    }
  }

  const formattedTime = formatTime(hours, minutes, seconds);
  document.getElementById('timerDisplay').textContent = formattedTime;
}

function formatTime(hours, minutes, seconds) {
  const formattedHours = String(hours).padStart(2, '0');
  const formattedMinutes = String(minutes).padStart(2, '0');
  const formattedSeconds = String(seconds).padStart(2, '0');
  return `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
}

function updateTimerDisplay() {
  seconds = 0;
  minutes = 0;
  hours = 0;
  const formattedTime = formatTime(hours, minutes, seconds);
  document.getElementById('timerDisplay').textContent = formattedTime;
}    


</script>


</body>
</html>