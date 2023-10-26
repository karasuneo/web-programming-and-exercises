<?php
// セッションを開始
session_start();

// 現在のセッションIDを取得
$oldSesId = session_id();

// 新しいセッションIDを生成
session_regenerate_id();

// 新しいセッションIDを取得
$newSesId = session_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php
print "【現在のセッションID】<br>";
print $oldSesId . "<br><br>";
print "【新しいセッションID】<br>";
print $newSesId . "<br><br>";
?>
</body>
</html>
