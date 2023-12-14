
router.get('/', (req, res, next)=>{
  prisma.user.findMany({
    orderBy: [{name:'asc'}]
  }).then(users=> {
    const data = {
      title:'Users/Index',
      content:users
    }
    res.render('users/index', data);
  });
});





