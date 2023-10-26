<?php
error_reporting(E_ALL);
ini_set("display_errors", "Off");

$file_contents = @file("data/todo.txt");

if ($file_contents === false) {
    echo "data/todo.txtを読み込めませんでした";
    exit();
}

$todo_over_list = array();
$todo_upcoming_list = array();
$today_date = date("Y/m/d");

foreach ($file_contents as $line) {
    $line = mb_convert_encoding($line, "UTF-8", "sjis"); // UTF-8に変換
    list($todo_date_str, $today_title) = explode("\t", $line); // タブで区切る
    $todo_date = date("Y/m/d", strtotime($todo_date_str));

    if ($todo_date < $today_date) {
        $todo_over_list[] = array("title" => $todo_title, "date" => $todo_date);
    } else {
        $todo_upcoming_list[] = array("title" => $todo_title, "date" => $todo_date);
    }
}

require_once("smarty/Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir = "templates"; // テンプレートディレクトリの指定
$smarty->compile_dir = "templates_c"; // コンパイルディレクトリの指定
$smarty->assign("todo_over_list", $todo_over_list);
$smarty->assign("todo_upcoming_list", $todo_upcoming_list);
$smarty->display("todo.html"); // テンプレートを表示
