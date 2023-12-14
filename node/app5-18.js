
router.post('/add', [
    check('name','NAME は必ず入力して下さい。').notEmpty().escape(),
    check('mail','MAIL はメールアドレスを記入して下さい。').isEmail().escape(),
    check('age', 'AGE は年齢（整数）を入力下さい。').isInt()
  ], (req, res, next) => {
  ……以下略……





