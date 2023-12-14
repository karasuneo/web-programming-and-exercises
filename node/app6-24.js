
var lastCursor = 0;
var cursor = 1;

prisma.$use(async (params, next) => {
  const result = await next(params);
  cursor = result[result.length - 1].id;
  if (cursor == lastCursor) {
    cursor = 1;
  }
  lastCursor = cursor;
  return result;
});

router.get('/', (req, res, next)=>{
  prisma.user.findMany({
    orderBy: [{id:'asc'}],
    cursor: {id:cursor},
    take:3,
  }).then(users=> {
    const data = {
      title:'Users/Index',
      content:users
    }
    res.render('users/index', data);
  });
});





