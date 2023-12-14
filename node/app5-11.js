
router.get('/edit', (req, res, next) => {
  const id = req.query.id;
  db.serialize(() => {
    const q = "select * from mydata where id = ?";
    db.get(q, [id], (err, row) => {
      if (!err) {
        var data = {
          title: 'hello/edit',
          content: 'id = ' + id + ' のレコードを編集：',
          mydata: row
        }
        res.render('hello/edit', data);
      }   
    }); 
  }); 
});

router.post('/edit', (req, res, next) => {
  const id = req.body.id;
  const nm = req.body.name;
  const ml = req.body.mail;
  const ag = req.body.age;
  const q = "update mydata set name = ?, mail = ?, age = ? where id = ?";
  db.serialize(() => {
    db.run(q, nm, ml, ag, id);
  });
  res.redirect('/hello');
});





