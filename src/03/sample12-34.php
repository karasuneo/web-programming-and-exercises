<?php
// 閲覧しているブラウザの情報を取得
$useragent = $_SERVER['HTTP_USER_AGENT'];

// ブラウザの種類によってリダイレクト先を切り替え
if (strpos($useragent, "Chrome") !== false) {
    // Chromeの場合
    header("Location: sample12-34_Cr.htm");
} elseif (strpos($useragent, "Safari") !== false) {
    // Safariの場合
    header("Location: sample12-34_Sf.htm");
} elseif (strpos($useragent, "Mozilla") !== false) {
    // FirefoxやMozilla互換ブラウザの場合
    header("Location: sample12-34_Fr.htm");
} else {
    // その他の環境の場合
    header("Location: index.htm");
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