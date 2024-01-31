const express = require("express");
var app = express();

var helloRouter = require("./routes/hello");

app.use("/hello", helloRouter);

app.get("/", (req, res) => {
  res.send("Welcome to Express!");
});

app.listen(3000, () => {
  console.log("Start server port:3000");
});
