
router.get('/add',(req, res, next)=> {
  const data = {
    title:'Users/Add'
  }
  res.render('users/Add', data);
});

router.post('/add',(req, res, next)=> {
  prisma.User.create({
    data:{
      name: req.body.name,
      pass: req.body.pass,
      mail: req.body.mail,
      age: +req.body.age
    }
  })
  .then(()=> {
    res.redirect('/users');
  });
});





