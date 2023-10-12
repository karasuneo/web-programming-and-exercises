<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $data = 1254.56789;

    // 小数点以下を切り捨て
    echo floor($data);
    echo "<br>";

    // 小数第2位より下を切り捨て
    echo floor($data * 100) / 100;
    echo "<br>";

    // 百の位より下を切り捨て
    echo floor($data / 100) * 100;
    echo "<br>";
    ?>
</body>

</html>