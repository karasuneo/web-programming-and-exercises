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
        // 受け取ったデータを $rcv で始まる変数名に展開
        extract($_REQUEST, EXTR_SKIP | EXTR_PREFIX_ALL, "rcv");

        // 4つのテキストボックスのループ
        $num = 1;
        foreach ($rcv_inputdata as $data) {
            print $num . "番目のテキストボックス→";
            print $data . "<br>";
            $num++;
        }
        print "<br><br>";
    }
    ?>
    テキストボックスに値を入力して&#8203;``oaicite:{"number":1,"invalid_reason":"Malformed citation 【送信】"}``&#8203;ボタンをクリックしてください（複数入力可）。
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <p><input size="40" type="text" name="inputdata[]"></p>
        <p><input size="40" type="text" name="inputdata[]"></p>
        <p><input size="40" type="text" name="inputdata[]"></p>
        <p><input size="40" type="text" name="inputdata[]"></p>
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>