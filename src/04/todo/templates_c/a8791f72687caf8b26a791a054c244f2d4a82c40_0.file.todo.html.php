<?php
/* Smarty version 4.3.4, created on 2023-10-26 02:24:36
  from '/var/www/html/04/todo/templates/todo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6539cde45a5233_71603467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8791f72687caf8b26a791a054c244f2d4a82c40' => 
    array (
      0 => '/var/www/html/04/todo/templates/todo.html',
      1 => 1698280239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6539cde45a5233_71603467 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>サクッとTODO管理</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>サクッとTODO管理</h1>
    <h2>締め切りオーバー</h2>
    <ul class="todo-list">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['todo_over_list']->value, 'todo');
$_smarty_tpl->tpl_vars['todo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['todo']->value) {
$_smarty_tpl->tpl_vars['todo']->do_else = false;
?>
        <li class="over"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['todo']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
 (~<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['todo']->value['date'], ENT_QUOTES, 'UTF-8', true);?>
)</li>
        <?php
}
if ($_smarty_tpl->tpl_vars['todo']->do_else) {
?>
        <li>締め切りを過ぎたTODOはありません</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <h2>今日以降の締め切り</h2>
    <ul class="todo-list">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['todo_upcoming_list']->value, 'todo');
$_smarty_tpl->tpl_vars['todo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['todo']->value) {
$_smarty_tpl->tpl_vars['todo']->do_else = false;
?>
        <li class="upcoming"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['todo']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
 (~<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['todo']->value['date'], ENT_QUOTES, 'UTF-8', true);?>
)</li>
        <?php
}
if ($_smarty_tpl->tpl_vars['todo']->do_else) {
?>
        <li>今後予定されているTODOはありません</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
</body>

</html><?php }
}
