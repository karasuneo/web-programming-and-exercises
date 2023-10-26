<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    if (isset($_GET['btnExec'])) {
        // 送信ボタンがクリックされたとき
        // 受け取ったクエリ文字列をそのまま表示
        echo "クエリ文字列（そのまま表示）: " . $_SERVER['QUERY_STRING'] . "<br><br>";

        // クエリ文字列を元に戻して表示
        $decodedQuery = urldecode($_SERVER['QUERY_STRING']);
        echo "クエリ文字列（デコード後）: " . $decodedQuery . "<br><br>";

        // スーパーグローバル変数で表示
        echo "inputdata: " . $_GET['inputdata'] . "<br>";
        echo "btnExec: " . $_GET['btnExec'] . "<br>";
    }
    ?>
    テキストボックスに値を入力して［送信］ボタンをクリックしてください.
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
        <input size="40" type="text" name="inputdata">
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>