<?php
// セッションを開始
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
    // セッション変数が設定されているか確認
    if(isset($_SESSION['sesdata3'])) {
        // セッション変数が設定されているとき
        echo $_SESSION['sesdata3'] . "<br>";
    } else {
        // セッション変数が設定されていないとき
        echo "セッション変数は使われていません！<br>";
    }

    // セッション変数を破棄
    unset($_SESSION['sesdata3']);

    // 再度確認
    if(isset($_SESSION['sesdata3'])) {
        // セッション変数が設定されているとき
        echo $_SESSION['sesdata3'] . "<br>";
    } else {
        // セッション変数が設定されていないとき
        echo "セッション変数は使われていません！<br>";
    }
?>
</body>
</html>