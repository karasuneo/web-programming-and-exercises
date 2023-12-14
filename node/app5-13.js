
router.get('/delete', (req, res, next) => {
  const id = req.query.id;
  db.serialize(() => {
    const q = "select * from mydata where id = ?";
    db.get(q, [id], (err, row) => {
      if (!err) {
        var data = {
          title: 'Hello/Delete',
          content: 'id = ' + id + ' のレコードを削除：',
          mydata: row
        }
        res.render('hello/delete', data);
      }   
    }); 
  }); 
});

router.post('/delete', (req, res, next) => {
  const id = req.body.id;
  db.serialize(() => {
    const q = "delete from mydata where id = ?";
    db.run(q, id);
  });
  res.redirect('/hello');
});





