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

    // 全部で10個のパスワードを生成するループ
    for ($passcnt = 1; $passcnt <= 10; $passcnt++) {
        $password = "";

        // 1から9までの数字を5回生成してパスワードに追加
        for ($ent = 1; $ent <= 5; $ent++) {
            $password = $password . mt_rand(1, 9);
        }

        // 'A' から 'Z' までのアルファベットを5回生成してパスワードに追加
        for ($ent = 1; $ent <= 5; $ent++) {
            $password = $password . chr(mt_rand(65, 90));
        }

        echo $password;
        echo "<br>";
    }
    ?>
</body>

</html>