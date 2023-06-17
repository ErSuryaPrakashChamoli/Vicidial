// Set the countdown date and time
var countdownDate = new Date("2023-06-09T23:59:59").getTime();

// Update the countdown every second
var countdownInterval = setInterval(function() {
  // Get the current date and time
  var now = new Date().getTime();

  // Calculate the remaining time in milliseconds
  var timeRemaining = countdownDate - now;

  // Check if the countdown has ended
  if (timeRemaining <= 0) {
    clearInterval(countdownInterval);
    document.getElementById("countdown").innerHTML = "Countdown has ended!";
    return;
  }

  // Convert milliseconds to days, hours, minutes, and seconds
  var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
  var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

  // Format the time as a string
  var time = days + " days, " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds";

  // Display the countdown in the "countdown" element
  document.getElementById("countdown").innerHTML = "Countdown: " + time;
}, 1000);