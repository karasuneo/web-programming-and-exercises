<?php
error_reporting(E_ALL);
ini_set("display_errors", "Off");

$error_message = array();

// Establish a connection to the MySQL database
$mysqli = new mysqli("Database_And_Exercises_DB:3306", "root", "admin", "bbs");
$mysqli->set_charset("utf8");

// Check if the "save" button was pressed
if (isset($_POST["save"])) {
    $error_message = array();

    if (!strlen($_POST["body"])) {
        $error_message[] = "本文を入力してください。";
    }

    if (!count($error_message)) {
        $stmt = $mysqli->prepare("INSERT INTO post (date, title, name, body) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", date("Y-m-d H:i:s"), $_POST["title"], $_POST["name"], $_POST["body"]);
        $stmt->execute();
    }
}

// Retrieve data from the database and store it in the $bbs_list array
$result = $mysqli->query("SELECT * FROM post ORDER BY date DESC");
$bbs_list = array();

while ($bbs = $result->fetch_array()) {
    $bbs_list[] = $bbs;
}

// ⑤のブロック 開始
require_once("smarty/Smarty.class.php");
$smarty = new Smarty(); // Smartyインスタンス($smartyオブジェクト）を作成

$smarty->template_dir = "templates"; // テンプレートディレクトリの指定
$smarty->compile_dir = "templates_c"; // コンパイルディレクトリの指定

// 同のブロック 開始
$smarty->assign("error_message", $error_message);
$smarty->assign("bbs_list", $bbs_list);
$smarty->display("bbs.html"); // テンプレートを表示
