<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    if(isset($_COOKIE['mycookiedata'])) {
        // クッキーにデータが保存されているとき
        // クッキーデータを取得（データ名=mycookiedata)
        $data = $_COOKIE['mycookiedata'];
        // クッキーの生データを出力
        echo $data . "<br><br>";
        
        // データを分解して保存時のデータを復元
        parse_str($data, $output);
        // 分解後のデータを出力
        echo "クッキーに保存されていたデータは：<br>";
        echo "ck_data1: " . $output['ck_data1'] . "<br>";
        echo "ck_data2: " . $output['ck_data2'] . "<br>";
    } else {
        // クッキーにデータがないとき
        echo "データはクッキーに保存されていません！";
    }
?>
</body>
</html>
