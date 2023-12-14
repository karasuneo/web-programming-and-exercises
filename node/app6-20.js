
router.get('/delete/:id',(req, res, next)=> {
  const id = req.params.id;
  prisma.user.findUnique(
    { where:{ id:+id }}
  ).then(usr=>{
    const data = {
      title:'Users/Delete',
      user:usr
    };
    res.render('users/delete', data) ;   
  });
});

router.post('/delete',(req, res, next)=> {
  prisma.User.delete({
    where:{id:+req.body.id}
  }).then(()=> {
    res.redirect('/users');
  });
});





