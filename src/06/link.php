<?php
// オンラインリンク ユーザ向け検索スクリプト
// 設定ファイルインクルード
require "config.php";

// パラメータの取得
$prmarray = cv_formstr($_POST);

// 処理開始
?>

<?php $conn = db_conn(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?= APPNAME ?></title>
</head>

<body>
    <div align="center">
        <h3><?= APPNAME ?></h3>

        <?php
        // 検索キーワードを取得する
        $key = (isset($prmarray["key"])) ? $prmarray["key"] : "";

        // 表示するページ番号を取得する
        $p = (isset($prmarray["p"])) ? intval($prmarray["p"]) : 1;
        $p = ($p < 1) ? 1 : $p;
        ?>

        <!-- 検索フォーム -->
        <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
            <table border="0">
                <tr>
                    <td><input type="text" name="key" value="<?= $key ?>"></td>
                    <td><input type="submit" value="検索" name="sub1"></td>
                </tr>
            </table>
            <input type="hidden" name="act" value="src">
        </form>

        <!-- 検索結果 -->
        <?php disp_listdata($key, $p); ?>
    </div>
</body>

</html>

<?php db_close($conn); ?>

<?php
// 配列データを一括エスケープ
function cv_formstr($array)
{
    foreach ($array as $k => $v) {
        // 「magic_quotes_gpc = On」 のときはエスケープ解除
        // if (get_magic_quotes_gpc()) {
        //     $v = stripslashes($v);
        // }
        $v = htmlspecialchars($v);
        $array[$k] = $v;
    }
    return $array;
}

// データをSQL用に変換
function cnv_sqlstr($string)
{
    // 文字コードを変換する
    $det_enc = mb_detect_encoding($string, "UTF-8, EUC-JP, SJIS");
    if ($det_enc && $det_enc != ENCODE) {
        $string = mb_convert_encoding($string, ENCODE, $det_enc);
        // バックスラッシュを付加する
        $string = addslashes($string);
    }
    return $string;
}

// 表示する文字コードに変換
function cnv_dispstr($string)
{
    // 文字コードを変換する
    $det_enc = mb_detect_encoding($string, "UTF-8, EUC-JP, SJIS");
    if ($det_enc && $det_enc != ENCODE) {
        return mb_convert_encoding($string, ENCODE, $det_enc);
    } else {
        return $string;
    }
}

// リンク先のURLとタイトルをリンクに変換
function cv_link($url, $title)
{
    $string = "<a href='$url'>$title</a>";
    return $string;
}

// データ一覧表示
function disp_listdata($key, $p)
{
    global $conn;
    // 表示するデータの位置
    $st = ($p - 1) * intval(PAGESIZE);
    // データ抽出SQL作成
    $sql = "SELECT * FROM linkdata";
    if (strlen($key) > 0) {
        $sql .= " WHERE (l_url LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (l_title LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (l_comment LIKE '%" . cnv_sqlstr($key) . "%')";
    }
    $sql .= " ORDER BY l_date DESC LIMIT $st, " . intval(PAGESIZE);

    // データ抽出
    $res = db_query($sql, $conn);
    if ($res->num_rows <= 0) {
        echo "<p>データは登録されていません。</p>";
        return;
    }
?>

    <table border="0" width="600" style="line-height: 150%">
        <tr>
            <td>
                <ul>
                    <?php while ($row = $res->fetch_array(MYSQLI_ASSOC)) { ?>
                        <li><?= cv_link($row["l_url"], cnv_dispstr($row["l_title"])) ?> - <?= cnv_dispstr($row["l_comment"]) ?> (<?= date("Y/m/d", strtotime($row["l_date"])) ?>)
                        <?php } ?>
                </ul>
            </td>
        </tr>
    </table>

    <!-- 前後ページへのリンク -->
    <?php disp_pagenav($key, $p); ?>
<?php
}

// 前後ページへのリンク表示
function disp_pagenav($key, $p = 1)
{
    global $conn;
    // 前後のページ番号を取得
    $prev = $p - 1;
    $prev = ($prev < 1) ? 1 : $prev;
    $next = $p + 1;

    // 全データ数を取得する
    $sql = "SELECT COUNT(*) AS cnt FROM linkdata";
    if (isset($key)) {
        if (strlen($key) > 0) {
            $sql .= " WHERE (l_url LIKE '%" . cnv_sqlstr($key) . "%')";
            $sql .= " OR (l_title LIKE '%" . cnv_sqlstr($key) . "%')";
            $sql .= " OR (l_comment LIKE '%" . cnv_sqlstr($key) . "%')";
        }
    }
    $res = db_query($sql, $conn);
    $row = $res->fetch_array(MYSQLI_ASSOC);
    $recordcount = $row["cnt"];
?>

    <table>
        <tr>
            <?php if ($p > 1) { ?>
                <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                    <td><input type="submit" value="« Previous"></td>
                    <input type="hidden" name="act" value="src">
                    <input type="hidden" name="p" value="<?= $prev ?>">
                    <input type="hidden" name="key" value="<?= $key ?>">
                </form>
            <?php } ?>
            <?php if ($recordcount > ($next - 1) * intval(PAGESIZE)) { ?>
                <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                    <td width="50%"><input type="submit" value="Next »"></td>
                    <input type="hidden" name="act" value="src">
                    <input type="hidden" name="p" value="<?= $next ?>">
                    <input type="hidden" name="key" value="<?= $key ?>">
                </form>
            <?php } ?>
        </tr>
    </table>
<?php
}

// db接続
function db_conn()
{
    $conn = new mysqli(DBSV, DBUSER, DBPASS, DBNAME);
    if ($conn->connect_error) {
        error_log($conn->connect_error);
        exit;
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

// SQL実行
function db_query($sql, $conn)
{
    $res = $conn->query($sql);
    return $res;
}

// db接続解除
function db_close($conn)
{
    // 接続を解除する
    $conn->close();
}

// 登録ユーザ用スケジュール表示
function screen_schedule($array)
{
    // ログイン認証
    if (!chk_auth($array)) {
        echo "ログインしていません。";
        return;
    }

    // スケジュールデータ取得
    $schedules = get_schedules();

    // メニュー
    disp_menu();

    // スケジュールリスト表示
    echo "<h3>スケジュールリスト</h3>";
    echo "<ul>";
    foreach ($schedules as $schedule) {
        echo "<li>" . format_schedule($schedule) . "</li>";
    }
    echo "</ul>";
}

// ユーザ権限チェック
function chk_auth($array)
{
    // 既存のユーザ権限チェックを使用
    return chk_auth_admin($array);
}

// スケジュールデータ取得
function get_schedules()
{
    global $conn;
    $sql = "SELECT * FROM schedules";
    $res = db_query($sql, $conn);

    $schedules = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $schedules[] = $row;
    }

    return $schedules;
}

// スケジュール表示フォーマット
function format_schedule($schedule)
{
    return "開始: " . $schedule['start_datetime'] . ", 終了: " . $schedule['end_datetime'] .
        ", 場所: " . $schedule['location'] . ", 内容: " . $schedule['content'];
}
?>