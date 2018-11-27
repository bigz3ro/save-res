<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Socket client</title>

</head>
<body>

    <div class="container">
        <div class="row">
            <p id="messages"></p>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        socket.on('message', function (data) {
            $("#messages").append( "<p>"+data+"</p>" );
        });
    </script>
</body>
</html>