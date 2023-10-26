<?php
error_reporting(E_ALL);
ini_set("display_errors", "Off");

$error_message = array();

// Establish a connection to the MySQL database
$mysqli = new mysqli("localhost", "root", "root", "bbs");
$mysqli->set_charset("utf8");

// Check if the "save" button was pressed
if (isset($_POST["save"])) {
    $error_message = array();

    if (!strlen($_POST["body"])) {
        $error_message[] = "本文を入力してください。";
    }

    if (count($error_message) == 0) {
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

// Load the Smarty library and create a Smarty instance
require_once("smarty/Smarty.class.php");
$smarty = new Smarty();

// Set Smarty properties
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";

// Assign template variables and display the template
$smarty->assign("error_message", $error_message);
$smarty->assign("bbs_list", $bbs_list);
$smarty->display("bbs.html");
