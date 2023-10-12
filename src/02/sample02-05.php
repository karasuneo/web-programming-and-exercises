<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $data1 = 128;
    $data2 = -256;

    // data1の絶対値を出力
    echo abs($data1);
    echo "<br>";

    // data2の絶対値を出力
    echo abs($data2);
    echo "<br>";

    // 値を常にマイナス化して出力
    echo abs($data1) * -1;
    echo "<br>";
    echo abs($data2) * -1;
    echo "<br>";
    ?>
</body>

</html>