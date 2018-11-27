<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Socket client</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <form id="form-chat" action="{{ route('message.postSend') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-10">
                    <input type="text" placeholder="Nội dung" class="form-control" id="message" name="message">
                </div>
                <button class="btn btn-default">Gửi</button>
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
        var socket = io('http://localhost:9000', {query: "userId=3"});
        $("#form-chat").submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var mesdata = $('#messasge').val();
            var url = form.attr('action');
            $.post(url, $("#form-chat").serialize());
        });
        socket.on('message', function (data) {
            $("#messages").append( "<p>"+data+"</p>" );
        })
    </script>
</body>
</html>