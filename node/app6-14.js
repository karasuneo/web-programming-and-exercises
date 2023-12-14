
router.get('/find',(req, res, next)=> {
  const name = req.query.name;
  const mail = req.query.mail;
  prisma.user.findMany({
    where: {
      OR: [
        { name: { contains: name }},
        { mail: { contains: mail }}
      ]
    }
  }).then(usrs => {
    var data = {
      title: 'Users/Find',
      content: usrs
    }
    res.render('users/index', data);
  });   
});





