
#!/usr/bin/env node

var app = require('../app');
var debug = require('debug')('ex-gen-app:server');
var http = require('http');

var port = normalizePort(process.env.PORT || '3000');
app.set('port', port);

var server = http.createServer(app);

server.listen(port);
server.on('error', onError);
server.on('listening', onListening);

……以下略……





