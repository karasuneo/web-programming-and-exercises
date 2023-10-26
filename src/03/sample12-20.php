<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $errflg = false;
    if (isset($_POST['btnExec'])) {
        // 送信ボタンがクリックされたとき
        // 名前の未入力をチェック
        if (strlen($_POST['inputdata']) == 0) {
            print "名前が入力されていません！<br>";
            // エラーフラグをON
            $errflg = true;
        }
        // 好きなチームの未入力をチェック
        if (!isset($_POST['seldata'])) {
            print "好きなチームが選択されていません！<br>";
            // エラーフラグをON
            $errflg = true;
        }
        // 入力エラーがあった場合
        if ($errflg) {
            print "<br><b>データを再入力してください！</b><br>";
            print "<br><br>";
        } else {
            print "名前：" . $_POST['inputdata'] . "<br>";
            print "好きなチーム：" . $_POST['seldata'] . "<br><br>";
        }
    }
    ?>
    あなたの名前と好きなチームを選択して［送信］ボタンをクリックしてください.
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
        <p>名前 : <input size="40" type="text" name="inputdata" value="<?php echo isset($_POST['inputdata']) ? $_POST['inputdata'] : ''; ?>"></p>
        <p>好きなチーム：</p>
        <p>
            <select size="6" name="seldata">
                <option value="ブラジル" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'ブラジル') echo 'selected'; ?>>ブラジル</option>
                <option value="イタリア" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'イタリア') echo 'selected'; ?>>イタリア</option>
                <option value="アルゼンチン" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'アルゼンチン') echo 'selected'; ?>>アルゼンチン</option>
                <option value="フランス" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'フランス') echo 'selected'; ?>>フランス</option>
                <option value="イングランド" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'イングランド') echo 'selected'; ?>>イングランド</option>
                <option value="オランダ" <?php if (isset($_POST['seldata']) && $_POST['seldata'] == 'オランダ') echo 'selected'; ?>>オランダ</option>
            </select>
        </p>
        <input type="submit" name="btnExec" value="送信">
    </form>
</body>

</html>