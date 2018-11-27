var serverSocket = require('socket.io')(9000);
var Redis = require('redis');

serverSocket.on('connection', function (socket, next) {
    console.log("Có người kết nối: "+ socket.id);
    console.log("middleware:", socket.handshake.query['userId']);
    var redis = Redis.createClient();
    redis.subscribe('message');
    redis.on('message', function (channel, message) {
        socket.emit(channel , message);
    });
    socket.on('disconnect', function() {
        redis.quit();
    });
});
