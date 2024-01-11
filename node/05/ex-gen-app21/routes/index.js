var express = require('express');
var router = express.Router();
const db = require('../models/index');
const {Op} = require('sequelize');
const MarkdownIt = require('markdown-it');
const markdown = new MarkdownIt();

const pnum = 10;

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
      res.render('sns/index',data);
   });
});

module.exports = router;
