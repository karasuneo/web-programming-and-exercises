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
// セッション変数を破棄
unset($_SESSION['sesdata1']);
unset($_SESSION['sesdata2']);


// セッション変数のデータを読み込み（前もって破棄しているのでエラーになります）
    echo $_SESSION['sesdata1'] . "<br>";
    echo $_SESSION['sesdata2'] . "<br>";
    echo $_SESSION['sesdata3'] . "<br>";
    echo $_SESSION['sesdata4'] . "<br>";
    echo $_SESSION['sesdata5'] . "<br>";

?>
</body>
</html>
