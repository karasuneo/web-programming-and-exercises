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
        // チェックボックス1〜4のループ
        for ($num = 1; $num <= 4; $num++) {
            if (isset($_POST["inputdata$num"])) {
                print $num . "番目のチェックボックスはON<br>";
            } else {
                print $num . "番目のチェックボックスはOFF<br>";
            }
        }
        print "<br><br>";
    }
    ?>
    開発経験のある言語にチェックを付けて&#8203;``oaicite:{"number":1,"invalid_reason":"Malformed citation 【送信】"}``&#8203;ボタンをクリックしてください（複数選択可）。
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <p><input type="checkbox" name="inputdata1">PHP</p>
        <p><input type="checkbox" name="inputdata2">Java</p>
        <p><input type="checkbox" name="inputdata3">CGI</p>
        <p><input type="checkbox" name="inputdata4">C++</p>
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>