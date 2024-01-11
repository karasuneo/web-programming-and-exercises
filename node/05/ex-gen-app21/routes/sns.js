var express = require('express');
var router = express.Router();
const db = require('../models/index');
const {Op} = require('sequelize');
const MarkdownIt = require('markdown-it');
const markdown = new MarkdownIt();

function check(req,res){
   if(req.session.login == null){
      req.session.back = '/';
      res.redirect('/users/login');
      return true;
   }else{
      return false;
   }
}

router.get('/',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findAll({}).then(mds=>{
      var data = {
         title: "Schedule Search",
         login: req.session.login,
         message: "※最近の投稿データ",
         form:{find:''},
         content:mds
      };
      res.render('sns/index',data);
   });
});

router.post('/',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findAll({
      where: {
         content: {[Op.like]:'%'+req.body.find+'%'}
      }
   }).then(mds=>{
      var data = {
         title: "Schedule Search",
         login: req.session.login,
         message: "※"+req.body.find+"で検索された最近の投稿データ",
         form:req.body,
         content:mds
      };
      res.render('sns/index',data);
   });
});

router.get('/add',(req,res,next)=>{
   if(check(req,res))return;
   var data = {
     title: "add",
     form: new db.Sns(),
     err: null
   };
   res.render('sns/add',data);
});

router.post('/add',(req,res,next)=>{
   if(check(req,res))return;
   const form = {
         userName: req.session.login.name,
         message: req.body.message
      }
   db.sequelize.sync()
     .then(()=> db.Sns.create(form)
     .then(usr=>{res.redirect('/')})
     .catch(err=>{
       var data = {
         title: "add",
         form: form,
         err: err
       };
       res.render('sns/add',data);
     }));
});

router.get('/edit',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findByPk(req.query.id)
   .then(usr=>{
      var data = {
         title: "edit",
         form: usr
      };
      res.render('sns/edit',data);
   });
});

router.post('/edit',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findByPk(req.body.id)
     .then(usr=> {
       usr.begin = req.body.message;
       usr.save().then(()=>res.redirect('/'));
     });
});

router.get('/delete',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findByPk(req.query.id)
   .then(usr=>{
      var data = {
         title: "Delete",
         form: usr
      };
     res.render('Sns/delete',data);
   });
});

router.post('/delete',(req,res,next)=>{
   if(check(req,res))return;
   db.Sns.findByPk(req.body.id)
     .then(usr=> {
       usr.destroy().then(()=>res.redirect('/'));
     });
});

module.exports = router;