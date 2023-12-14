
router.get('/add', (req, res, next) => {
  var data = {
      title: 'Hello/Add',
      content: '新しいレコードを入力：'
  }
  res.render('hello/add', data);
});

router.post('/add', (req, res, next) => {
  const nm = req.body.name;
  const ml = req.body.mail;
  const ag = req.body.age;
  db.serialize(() => {
    db.run('insert into mydata (name, mail, age) values (?, ?, ?)',
      nm, ml, ag);
  });
  res.redirect('/hello');
});





