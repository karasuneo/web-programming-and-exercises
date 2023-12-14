
router.get('/', (req, res, next)=>{
  prisma.user.findMany().then(users=> {
    const data = {
      title:'Users/Index',
      content:users
    }
    res.render('users/index', data);
  });
});





