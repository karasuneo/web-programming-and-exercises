
router.get('/edit/:id', (req, res, next)=>{
  const id = req.params.id;
  prisma.user.findUnique(
    { where:{ id:+id }}
  ).then(usr=>{
    const data = {
      title:'Users/Edit',
      user:usr
    };
    res.render('users/edit', data) ;   
  });
});

router.post('/edit', (req, res, next)=>{
  const {id, name, pass, mail, age} = req.body;
  prisma.user.update({
    where:{ id: +id },
    data:{
      name:name,
      mail:mail,
      pass:pass,
      age:+age
    }
  }).then(()=>{
    res.redirect('/users');
  });
});





