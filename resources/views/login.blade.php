<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Socket client</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <form id="form-chat" action="{{ route('auth.socket') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-10">
                    <input type="text" class="form-control" name="account">
                    <input type="text" class="form-control" name="password">
                </div>
                <button class="btn btn-default" type="submit">Gửi</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-defaul">
                    <div id="messages"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        // var reconnection = true;
        // var reconnectionDelay = 5000;
        // var reconnectionTry = 0;

        // function initClient() {
        //     var socket = "";
        //     connectClient();
        // }

        // function connectClient(token) {
        //     var socket = "";
        //     socket = io.connect('http://localhost:9000', { query: "token=" + token });

        //     socket.on('connect', function (e) {
        //         routesClient(socket);
        //     });

        //     socket.on('connect_error', function (e) {
        //         reconnectionTry++;
        //         console.log("Reconnection attempt #" + reconnectionTry);
        //     });
        //     return false;
        // }

        // function routesClient(socket) {
        //     console.log('connected');

        //     socket.on('test', function (e) {
        //         console.log(e);
        //         socket.emit("test", "pong");
        //     });

        //     socket.on('disconnect', function () {
        //         socket.disconnect();
        //         console.log('client disconnected');

        //         if (reconnection === true) {
        //             setTimeout(function () {
        //                 console.log('client trying reconnect');
        //                 connectClient();
        //             }, reconnectionDelay);
        //         }
        //     });

        //     return false;
        // }

        // window.onload = function () {
        //     initClient();
        // }

        // var socket = io('http://localhost:9000');
        $("#form-chat").submit(function(event) {
            var form = $(this);
            var url = form.attr('action');
            $.post(url, $("#form-chat").serialize()).done(function (response) {
                // var socket = io('http://localhost:9000', { query: "token=" + response.token });
                localStorage.setItem('token_auth', response.token);
                window.location.replace(response.redirect);

                // socket.on('connect_error', function () {
                //     console.log('connect failed');
                //     socket.disconnect();
                // });
            }).fail(function (response) {
                console.log(response)
            });
            event.preventDefault();
        });
    </script>
</body>
</html>