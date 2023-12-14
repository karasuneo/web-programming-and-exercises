
const pagesize = 3; // ☆１ページ当たりのレコード数

router.get('/', (req, res, next)=>{
  const page = req.query.page ? +req.query.page : 0;
  prisma.user.findMany({
    orderBy: [{id:'asc'}],
    skip: page * pagesize,
    take: pagesize,
  }).then(users=> {
    const data = {
      title:'Users/Index',
      content:users
    }
    res.render('users/index', data);
  });
});





