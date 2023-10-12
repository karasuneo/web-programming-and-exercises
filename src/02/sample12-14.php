<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charaset="UTF-8">
    <title></title>
</head>
<bodv> <?php
        if (isset($_POST['btnExec'])) {
            //送信ボタンがクリックされたとき
            print "送信ボタンがクリックされました！<br><br>";
        } elseif (isset($_POST['btnCanel'])) {
            //キャンセルボタンがクリックされたとき
            print "キャンセルボタンがクリックされました！<br><br>";
        }
        ?>
    いずれかのボタンをクリックしてください。
    <form action="<?php $_SERVER['SCRIPT NAME'] ?>" method="POST">
        <input type="submit" name="btnExec" value="">
        <input type="'submit" name="btnCanel" value="キャンセル">
    </form>
    </body>

</html>