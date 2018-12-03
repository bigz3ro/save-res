var express = require("express");
var path = require('path');
var Redis = require('redis');
var jwt = require('jsonwebtoken');
var ENV = require(path.resolve(__dirname, "./config.js" ));
var redisKey = require(path.resolve(__dirname, "./redisKey.js" ));
var serverSocket = require('socket.io')(ENV.port);

serverSocket.on('connection', function (socket, next) {
    console.log("Có người kết nối: "+ socket.id);

    const users = [];
    var token = socket.handshake.query['token'];
    console.log(token);
    var decodedToken = jwt.verify(token, ENV.JWT_SECRET);

    users[socket.id] = socket;
    console.log('test', "ping");

    var redis = Redis.createClient();

    if (decodedToken) {
        var userId = decodedToken.sub;
        var socketId = socket.id;

        var userInfo = {
            userId: userId,
            socketId: socketId
        };
        redis.hset(redisKey.listUser, "sid_" + socket.id + "_uid_" + userId, JSON.stringify(userInfo));
    }

    redis.subscribe('message');
    redis.on('message', function (channel, message) {
        socket.emit(channel , message);
    });
    socket.on('disconnect', function() {
        delete users[socket.id];
        redis.quit();
    });
});
