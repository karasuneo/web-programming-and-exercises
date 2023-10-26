<?php
// セッションを開始
session_start();

// セッション変数を破棄
unset($_SESSION['sesdata1']);
unset($_SESSION['sesdata2']);
unset($_SESSION['sesdata3']);
unset($_SESSION['sesdata4']);
unset($_SESSION['sesdata5']);

// セッション変数のデータを読み込み（前もって破棄しているのでエラーになります）
if (isset($_SESSION['sesdata1'])) {
    echo $_SESSION['sesdata1'] . "<br>";
}
if (isset($_SESSION['sesdata2'])) {
    echo $_SESSION['sesdata2'] . "<br>";
}
if (isset($_SESSION['sesdata3'])) {
    echo $_SESSION['sesdata3'] . "<br>";
}
if (isset($_SESSION['sesdata4'])) {
    echo $_SESSION['sesdata4'] . "<br>";
}
if (isset($_SESSION['sesdata5'])) {
    echo $_SESSION['sesdata5'] . "<br>";
}
