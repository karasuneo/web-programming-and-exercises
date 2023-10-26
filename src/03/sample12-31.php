<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    if (isset($_POST['team'])) {
        // チームが選択された場合
        print "選択されたチームの番号は " . $_POST['team'] . "<br><br>";
    }

    // 送信されたエリアの番号を取得
    if (isset($_POST['area'])) {
        $areanum = $_POST['area'];
    } else {
        $areanum = null;
    }

    // エリアの番号に応じてチームのリストボックスのHTMLを組み立て
    switch ($areanum) {
        case 1:
            // 南米
            $strlistbox = "<select size='3' name='team' onclick='document.myform.submit();'>
            <option value='11'>ブラジル</option>
            <option value='12'>アルゼンチン</option>
            <option value='13'>ウルグアイ</option>
        </select>";
            break;
        case 2:
            // ヨーロッパ
            $strlistbox = "<select size='4' name='team' onclick='document.myform.submit();'>
            <option value='21'>イタリア</option>
            <option value='22'>フランス</option>
            <option value='23'>イングランド</option>
            <option value='24'>オランダ</option>
        </select>";
            break;
        case 3:
            // アフリカ
            $strlistbox = "<select size='2' name='team' onclick='document.myform.submit();'>
            <option value='31'>ナイジェリア</option>
            <option value='32'>カメルーン</option>
        </select>";
            break;
        default:
            // 未指定時
            $strlistbox = null;
            break;
    }
    ?>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST" name="myform">
        <select size="3" name="area" onclick="document.myform.submit();">
            <option value="1" <?php echo ($areanum == 1 ? 'selected' : ''); ?>>南米</option>
            <option value="2" <?php echo ($areanum == 2 ? 'selected' : ''); ?>>ヨーロッパ</option>
            <option value="3" <?php echo ($areanum == 3 ? 'selected' : ''); ?>>アフリカ</option>
        </select>
        <?php if ($strlistbox != null) echo $strlistbox; ?>
    </form>
</body>

</html>