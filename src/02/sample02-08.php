<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $data = 1254.56789;

    // 小数点以下を切り上げ
    echo ceil($data);
    echo "<br>";

    // 小数第2位で切り上げ
    echo ceil($data * 100) / 100;
    echo "<br>";

    // 百の位で切り上げ
    echo ceil($data / 100) * 100;
    echo "<br>";
    ?>
</body>

</html>