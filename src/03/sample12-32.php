<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    // リファラーを取得してチェック
    if (isset($_SERVER['HTTP_REFERER'])) {
        print "このPHPファイルは、次のURLから呼び出されました。<br>";
        print $_SERVER['HTTP_REFERER'] . "<br><br>";
        if ($_SERVER['HTTP_REFERER'] == "http://localhost/03/sample12-32.php") {
            print "自分自身のファイルから呼ばれました！<br>";
        }
    }
    ?>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <input type="submit" name="btnExec" value="実行">
    </form>
</body>

</html>