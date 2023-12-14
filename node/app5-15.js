
router.get('/find',(req, res, next) => {
  db.serialize(() => {
    db.all("select * from mydata",(err, rows) => {
      if (!err) {
        var data = {
          title: 'Hello/find',
          find:'',
          content:'検索条件を入力して下さい。',
          mydata: rows
        };
        res.render('hello/find', data);
      }   
    }); 
  }); 
});

router.post('/find', (req, res, next) => {
  var find = req.body.find;
  db.serialize(() => {
    var q = "select * from mydata where ";
    db.all(q + find, [], (err, rows) => {
      if (!err) {
        var data = {
          title: 'Hello/find',
          find:find,
          content: '検索条件 ' + find,
          mydata: rows
        }
        res.render('hello/find', data);
      } 
    }); 
  }); 
});





