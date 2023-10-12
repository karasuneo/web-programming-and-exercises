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
        print "送信ボタンがクリックされました！<br>";
    } elseif (isset($_POST['btnCancel'])) {
        // キャンセルボタンがクリックされたとき
        print "キャンセルボタンがクリックされました！<br>";
    }
    ?>
    いずれかのボタンをクリックしてください.
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <input type="submit" name="btnExec" value="送信">
        <input type="submit" name="btnCancel" value="キャンセル">
    </form>
</body>

</html>