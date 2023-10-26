<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
    <?php
    $fontsize = "14pt"; // デフォルトのフォントサイズ
    if (isset($_POST['btnExec'])) {
        // 送信ボタンがクリックされたとき
        // ラジオボタンに応じてフォントサイズを設定
        switch ($_POST['fontsize']) {
            case 1:
                $fontsize = "10pt";
                break;
            case 2:
                $fontsize = "14pt"; // 中（既定値）
                break;
            case 3:
                $fontsize = "18pt"; // 大
                break;
        }
    }
    ?>
    <style>
        td {
            font-size: <?php echo $fontsize; ?>;
        }
    </style>
</head>

<body>
    <table border="1">
        <tr>
            <td width="500">インターネットの普及に伴い、その開発環境として、Webサーバー側で動的にコンテンツを生成するサーバーサイドプログラムも一般的なものになりました。Perl、C、Java、ASP、ASP.NETなど、それによって構築されたサイトも相当な数に上っています。</td>
        </tr>
    </table>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        フォントサイズ：
        <input type="radio" name="fontsize" value="1" <?php if ($fontsize === "10pt") echo 'checked'; ?>>小
        <input type="radio" name="fontsize" value="2" <?php if ($fontsize === "14pt") echo 'checked'; ?>>中
        <input type="radio" name="fontsize" value="3" <?php if ($fontsize === "18pt") echo 'checked'; ?>>大
        <input type="submit" name="btnExec" value="変更">
    </form>
</body>

</html>