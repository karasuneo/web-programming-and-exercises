<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $data = 1254.56789;

    // 小数点以下を四捨五入して整数化された値を出力
    echo round($data);
    echo "<br>";

    // 小数第2位を四捨五入
    echo round($data * 100) / 100;
    echo "<br>";

    // 小数第4位を四捨五入
    echo round($data * 10000) / 10000;
    echo "<br>";

    // 百の位を四捨五入
    echo round($data / 100) * 100;
    echo "<br>";
    ?>
</body>

</html>