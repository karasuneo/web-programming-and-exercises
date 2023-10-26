<?php
if (!isset($_POST['btnExec'])) {
    // はじめて呼び出されたとき
    // フォームの HTML を組み立て
    $html = "テキストボックスに値を入力して［送信］ボタンをクリックしてください.
        <form action='sample12-21.php' method='POST'>
        <input size='40' type='text' name='inputdata'>
        <input type='submit' name='btnExec' value=''>
        </form>";
} else {
    // 送信ボタンがクリックされたとき
    if (strlen($_POST['inputdata']) > 0) {
        print "テキストボックスに入力されたデータは「" . $_POST['inputdata'] . "」です！<br><br>
        確定してよろしければ[OK]ボタンをクリックしてください.";
        // 確認用フォームの HTML を組み立て
        $html = "<form action='sample12-21-2.php' method='POST'>
        <input type='hidden' name='inputdata' value='" . htmlspecialchars($_POST['inputdata']) . "'>
        <input type='submit' name='btnExec' value='OK'>
        </form>";
    } else {
        print "テキストボックスは空欄です！再入力してください。<br><br>";
        // 再入力用フォームの HTML を組み立て
        $html = "テキストボックスに値を入力して［送信］ボタンをクリックしてください.
        <form action='sample12-21.php' method='POST'>
        <input size='40' type='text' name='inputdata'>
        <input type='submit' name='btnExec' value=''>
        </form>";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php echo $html; ?>
</body>

</html>