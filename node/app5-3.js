
router.get('/',(req, res, next) => {
  db.all("select * from mydata",(err, rows) => {
    if (!err) {
      var data = {
        title: 'Hello!',
        content: rows
      };
      res.render('hello', data);
    }   
  }); 
});





