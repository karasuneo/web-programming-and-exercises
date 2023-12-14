
router.get('/',(req, res, next)=> {
  const id = +req.query.id;
  if (!id) {
    prisma.user.findMany().then(users=> {
      const data = {
        title:'Users/Index',
        content:users
      }
      res.render('users/index', data);
    });
  } else {
    prisma.user.findMany({
      where: {id: {lte: id} }
    }).then(usrs => {
      var data = {
        title: 'Users/Index',
        content: usrs
      }
      res.render('users/index', data);
    });    
  }
});





