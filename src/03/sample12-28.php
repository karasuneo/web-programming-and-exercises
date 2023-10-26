<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php

    if (isset($_POST['btnExec'])) {

        header("Location: $jumpto");
        exit();
    }

    ?>
    <!-- 以下のHTMLコード -->

    検索キーワードを入力して[送信]ボタンをクリックしてください.
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input size="40" type="text" name="keyword">
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>