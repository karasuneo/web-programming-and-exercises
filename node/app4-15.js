
const session = require('express-session'); //☆

var session_opt = {
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: false, 
  cookie: { maxAge: 60 * 60 * 1000 }
};
app.use(session(session_opt));





