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
    setInterval(function() {
        $.ajax({
            url: '/query-results2',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("enter here");
                // Update the view with the new query results
                $('#query-results').html(response);
                  
                     var agent_status =    response.result;

                     

                    //  console.log(agent_status[0]);
                    console.log(response[0].status);

                    var element = document.getElementById("query-results");
                    element.append(response[0].status);



                    // element.innerHTML(agent_status);

                    // var textNode = document.createTextNode(myVariable);
                    // element.appendChild(textNode);
                    //  console.log(response.result);







                // var jsonObj = JSON.parse($result);
                // console.log("enter here"+jsonObj);
            }
        });
    }, 1000); // Refresh every 1 second (1000 milliseconds)
});
</script>
</body>
</html>