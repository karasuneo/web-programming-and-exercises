
router.get('/find',(req, res, next)=> {
  const min = +req.query.min;
  const max = +req.query.max;
  prisma.user.findMany({
    where: {
      AND: [
        { age: { gte: min }},
        { age: { lte: max }}
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





