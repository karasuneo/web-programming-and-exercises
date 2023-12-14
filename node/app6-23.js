
const pagesize = 3;
var cursor = 1;

router.get('/', (req, res, next)=>{
  prisma.user.findMany({
    orderBy: [{id:'asc'}],
    cursor: { id:cursor },
    take: pagesize,
  }).then(users=> {
    cursor = users[users.length - 1].id;
    const data = {
      title:'Users/Index',
      content:users
    }
    res.render('users/index', data);
  });
});





