<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

if (isset($_POST['btnExec'])) {
    // 送信ボタンがクリックされたとき

    // 受け取ったデータをそのまま表示
    print $_POST['inputdata'] . "<br><br>";

    // 「\」を取り除いて表示
    print stripslashes($_POST['inputdata']) . "<br><br>";

}

?>
テキストボックスに値を入力して「送信」ボタンをクリックしてください。
<form action="<?php $_SERVER['SCRIPT_NAME']; ?>" method="POST">
    <input size="40" type="text" name="inputdata">
    <input type="submit" name="btnExec" value="送信">
</form>
</body>
</html>
