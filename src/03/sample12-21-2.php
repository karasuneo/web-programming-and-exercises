<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    if (isset($_POST['inputdata'])) {
        echo "入力データは「" . $_POST['inputdata'] . "」に確定されました！";
    }
    ?>
</body>

</html>