<?php
// 閲覧しているブラウザの情報を取得
$useragent = $_SERVER['HTTP_USER_AGENT'];

// ブラウザの種類によってリダイレクト先を切り替え
if (strlen(strpos($useragent, "Chrome")) > 0) {
    // Chrome
    header("Location: sample12-34_Cr.html");
} 
elseif (strlen(strpos($useragent, "Safari")) > 0) {
    // Safari
    header("Location: sample12-34_Sf.html");
} 
elseif (strlen(strpos($useragent, "Mozilla")) > 0) {
    // FirefoxやMozilla互換ブラウザ
    header("Location: sample12-34_Fr.html");
} else {
    // その他の環境
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
