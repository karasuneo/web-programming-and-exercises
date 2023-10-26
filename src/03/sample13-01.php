<?php
$data1 = 10;
$data2 = "PHP: Hypertext Preprocessor";

// データをクッキーに保存
if (setcookie("mycookiedata", "k_data1=$data1&k_data2=$data2", time() + (3600 * 24 * 7))) {
    echo "データをクッキーに保存しました！";
} else {
    echo "クッキーの保存に失敗しました！";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
</body>

</html>