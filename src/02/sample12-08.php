これはファイル 8 です。
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
        if (isset($_POST['inputdata'])) {
            print "選択されたラジオボタンは「" . $_POST['inputdata'] . "」です！";
        } else {
            print "ラジオボタンが選択されていません！";
            print "<br><br><br>";
        }
    }
    ?>
    いずれかの ラジオボタンを選択して[送信]ボタンをクリックしてください。
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <p><input type="radio" name="inputdata" value="101">101</p>
        <p><input type="radio" name="inputdata" value="201">201</p>
        <p><input type="radio" name="inputdata" value="301">301</p>
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>