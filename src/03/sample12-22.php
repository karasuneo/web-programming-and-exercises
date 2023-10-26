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
        echo "入力データ（そのまま表示）: " . $_POST['inputdata'] . "<br><br>";

        // 受け取ったデータを半角数字に変換して表示
        $receivedData = mb_convert_kana($_POST['inputdata'], "n", "UTF-8");
        echo "入力データ（半角数字に変換）: " . $receivedData . "<br><br>";
    }
    ?>
    テキストボックスに全角数字を入力して［送信］ボタンをクリックしてください.
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <input size="40" type="text" name="inputdata">
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>