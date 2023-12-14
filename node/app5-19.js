
router.post('/add', [
    check('name','NAME は必ず入力して下さい。').notEmpty(),
    check('mail','MAIL はメールアドレスを記入して下さい。').isEmail(),
    check('age', 'AGE は年齢（整数）を入力下さい。').isInt(),
    check('age', 'AGE はゼロ以上120以下で入力下さい。').custom(value =>{
      return value >= 0 && value <= 120;
    })
  ], (req, res, next) => {
  ……以下略……





