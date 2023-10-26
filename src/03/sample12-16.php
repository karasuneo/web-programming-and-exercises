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
        print $_POST['inputdata'] . "<br><br>\n\n";

        // HTMLの特殊文字を置換して表示
        print htmlspecialchars($_POST['inputdata']) . "<br><br>\n\n";
    }
    ?>
    テキストボックスに値を入力して【送信］ボタンをクリックしてください.
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <input size="90" type="text" name="inputdata">
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>
</html>
