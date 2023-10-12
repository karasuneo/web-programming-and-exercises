<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    // 乱数ジェネレータを初期化
    mt_srand();

    // 5つの画像ファイルを表示するループ
    for ($ent = 1; $ent <= 5; $ent++) {
        // 1〜9の乱数を生成
        $imagefile = mt_rand(1, 9);
        // 生成された乱数から画像ファイル名を組み立て
        $imagefile = "image" . $imagefile . ".gif";
        // HTMLのIMGタグで画像ファイルを出力
        echo "<img src='images/$imagefile' hspace='2'>";
    }
    ?>
</body>

</html>