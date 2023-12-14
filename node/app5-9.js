
router.get('/show', (req, res, next) => {
  const id = req.query.id;
  db.serialize(() => {
    const q = "select * from mydata where id = ?";
    db.get(q, [id], (err, row) => {
      if (!err) {
        var data = {
          title: 'Hello/show',
          content: 'id = ' + id + ' のレコード：',
          mydata: row
        }
        res.render('hello/show', data);
      }   
    }); 
  }); 
});





