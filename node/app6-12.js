
router.get('/find',(req, res, next)=> {
  const name = req.query.name;
  prisma.user.findMany({
    where: {name: {contains: name} }
  }).then(usrs => {
    var data = {
      title: 'Users/Find',
      content: usrs
    }
    res.render('users/index', data);
  });   
});





