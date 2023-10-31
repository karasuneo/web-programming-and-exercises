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

$str  = "
2023/10/21	アシアル全体のミーティング\n
2023/10/22	海原・森川とミーティング\n
2023/11/1	日経ソフトウエア原稿締め切り\n
2023/11/1	PHPカンファレンス\n
2023/10/30	アシアル全体のミーティング\n
2023/11/1	駅伝大会\n
2023/11/10	書類の提出期限\n
2024/3/1	求人票解禁\n
";

// $file_contents = preg_split("\n", $str);
// echo($file_contents);

foreach ($file_contents as $line) {
    $line = mb_convert_encoding($line, "UTF-8", "utf-8,sjis"); // UTF-8に変換
    list($todo_date_str, $todo_title) = explode(" ", $line); // タブで区切る

    $todo_date = date("Y/m/d", strtotime($todo_date_str));
    // echo ($todo_date_str);

    if ($todo_date < $today_date) {
        $todo_over_list[] = array("title" => $todo_title, "date" => $todo_date);
    } else {
        $todo_upcoming_list[] = array("title" => $todo_title, "date" => $todo_date);
    }
}

// foreach ($todo_over_list as $task) {
//     echo "Title: " . $task['title'] . "\n";
//     echo "Date: " . $task['date'] . "\n";
//     echo "\n"; // タスク間を区切るための改行
// }

require_once("smarty/Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir = "templates"; // テンプレートディレクトリの指定
$smarty->compile_dir = "templates_c"; // コンパイルディレクトリの指定
$smarty->assign("todo_over_list", $todo_over_list);
$smarty->assign("todo_upcoming_list", $todo_upcoming_list);
$smarty->display("todo.html"); // テンプレートを表示
