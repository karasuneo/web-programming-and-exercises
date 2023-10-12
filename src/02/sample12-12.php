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
    if (isset($_POST['seldata'])) {
        echo "選択された項目は「" . $_POST['seldata'] . "」です！";
    } else {
        echo "いずれの項目も選択されていません！";
    }
    echo "<br><br><br>";
}
?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
    <select size="6" name="seldata">
        <option value="ブラジル">ブラジル</option>
        <option value="イタリア">イタリア</option>
        <option value="アルゼンチン">アルゼンチン</option>
        <option value="フランス">フランス</option>
        <option value="イングランド">イングランド</option>
        <option value="オランダ">オランダ</option>
    </select>
    <input type="submit" name="btnExec" value="送信">
</form>
</body>
</html>
ï