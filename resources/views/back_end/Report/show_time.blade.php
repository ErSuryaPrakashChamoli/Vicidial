<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<hi>file</hi>
<div id="query-results"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    console.log("enter ");
    setInterval(function() {
        console.log("enter ");
        $.ajax({
            url: '/query-results',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update the view with the new query results

                 console.log("enter here");
                var jsonObj = JSON.parse(response);

                console.log("status is :"+jsonObj.status);
                
                
                $('#query-results').html(response);
            }
        });
    }, 1000); // Refresh every 1 second (1000 milliseconds)
});
</script>
</body>
</html>