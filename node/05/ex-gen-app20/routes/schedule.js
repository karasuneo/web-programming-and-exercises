var express = require('express');
var router = express.Router();
const db = require('../models/index');
const {Op} = require('sequelize');
const MarkdownIt = require('markdown-it');
const markdown = new MarkdownIt();

const pnum = 10;

function check(req,res){
   if(req.session.login == null){
      req.session.back = '/sche';
      res.redirect('/users/login');
      return true;
   }else{
      return false;
   }
}

router.get('/',(req,res,next)=>{
   if(check(req,res))return;
   db.Schedule.findAll({
      where: {userId: req.session.login.id},
      order:[['begin','ASC']]
   }).then(mds=>{
      var data = {
         title: "Schedule Search",
         login: req.session.login,
         message: "※最近の投稿データ",
         form:{find:''},
         content:mds
      };
      res.render('sche/index',data);
   });
});

router.post('/',(req,res,next)=>{
   if(check(req,res))return;
   db.Markdata.findAll({
      where: {
         userId: req.session.login.id,
         content: {[Op.like]:'%'+req.body.find+'%'}
      },
      order:[['id','ASC']]
   }).then(mds=>{
      var data = {
         title: "Schedule Search",
         login: req.session.login,
         message: "※"+req.body.find+"で検索された最近の投稿データ",
         form:req.body,
         content:mds
      };
      res.render('md/index',data);
   });
});

router.get('/add',(req,res,next)=>{
   if(check(req,res))return;
   var data = {
     title: "Schedule/add",
     form: new db.Schedule(),
     err: null
   };
   res.render('sche/add',data);
});

router.post('/add',(req,res,next)=>{
   if(check(req,res))return;
   const form = {
     userId: req.session.login.id,
     begin: req.body.begin,
     end: req.body.end,
     place: req.body.place,
     content: req.body.content
   }
   db.sequelize.sync()
     .then(()=> db.Schedule.create(form)
     .then(usr=>{res.redirect('/sche')})
     .catch(err=>{
       var data = {
         title: "Schedule/add",
         form: form,
         err: err
       };
       res.render('sche/add',data);
     }));
});

router.get('/edit',(req,res,next)=>{
   if(check(req,res))return;
   db.Schedule.findByPk(req.query.id)
   .then(usr=>{
      var data = {
         title: "Schedule/edit",
         form: usr
      };
      res.render('sche/edit',data);
   });
});

router.post('/edit',(req,res,next)=>{
   if(check(req,res))return;
   db.Schedule.findByPk(req.body.id)
     .then(usr=> {
       usr.begin = req.body.begin;
       usr.end = req.body.end;
       usr.place = req.body.place;
       usr.content = req.body.content;
       usr.save().then(()=>res.redirect('/sche'));
     });
});

router.get('/delete',(req,res,next)=>{
   if(check(req,res))return;
   db.Schedule.findByPk(req.query.id)
   .then(usr=>{
      var data = {
         title: "Schedule/Delete",
         form: usr
      };
     res.render('sche/delete',data);
   });
});

router.post('/delete',(req,res,next)=>{
   if(check(req,res))return;
   db.Schedule.findByPk(req.body.id)
     .then(usr=> {
       usr.destroy().then(()=>res.redirect('/sche'));
     });
});

module.exports = router;
