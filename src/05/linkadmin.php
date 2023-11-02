<?php
// オンラインリンク 管理者向けスクリプト
// セッションの開始
session_cache_limiter("public");
session_start();

// 設定ファイルインクルード
require "config.php";

// パラメータの取得
// フォームデータ変換
$prmarray = cv_formstr($_POST);

// 表示ページ
if (!chk_auth($prmarray)) {
    $act = DEFSCR;
} elseif (isset($prmarray["act"])) {
    $act = $prmarray["act"];
} else {
    $act = DEFSCR;
}

// 処理日時
$dt = date("Y-m-d H:i:s");

// 処理処理
// =====================

?>

<?php $conn = db_conn(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?= ADMINAPPNAME ?></title>
</head>

<body>
    <div align="center">
        <?php
        // 画面表示ルーチンの呼び出し
        call_user_func('screen_' . $act, $prmarray);
        ?>
    </div>
</body>

</html>

<?php db_close($conn); ?>

<?php
// ログイン画面
function screen_log($array)
{
?>
    <h3>ログイン画面</h3>
    <!-- ログインフォーム -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>ログインID</td>
                <td><input type="text" name="1_id"></td>
            </tr>
            <tr>
                <td>パスワード</td>
                <td><input type="password" name="1_pass"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="ログイン" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="act" value="src">
    </form>
<?php
}

// 検索画面
function screen_src($array)
{
    // 検索キーワード
    $key = (isset($array["key"])) ? $array["key"] : "";
    // 表示するページ
    $p = (isset($array['p'])) ? intval($array["p"]) : 1;
    $p = ($p < 1) ? 1 : $p;
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
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
<?php
}

// 登録画面
function screen_ent()
{
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>登録画面</h3>
    <!-- 登録フォーム -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>URL</td>
                <td><input type="text" name="1_url" size="100"></td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td><input type="text" name="1_title" size="50"></td>
            </tr>
            <tr>
                <td>コメント</td>
                <td><input type="text" name="1_comment" size="100"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="登録" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="act" value="entconf">
    </form>
<?php
}

// 登録確認画面
function screen_entconf($array)
{
    if (!chk_data($array)) {
        return;
    }
    extract($array);
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>登録確認画面</h3>
    <!-- 登録データ確認表示 -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>URL</td>
                <td><?= $l_url ?></td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td><?= $l_title ?></td>
            </tr>
            <tr>
                <td>コメント</td>
                <td><?= $l_comment ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="登録" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="l_url" value="<?= $l_url ?>">
        <input type="hidden" name="1_title" value="<?= $l_title ?>">
        <input type="hidden" name="1_comment" value="<?= $l_comment ?>">
        <input type="hidden" name="act" value="dojob">
        <input type="hidden" name="kbn" value="ent">
    </form>
<?php
}

// 更新画面
function screen_upd($array)
{
    if (!isset($array["id"])) {
        return;
    }
    $row = get_data($array["id"]);
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>更新画面</h3>
    <!-- 更新フォーム -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>id</td>
                <td><?= $row["id"] ?></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><input type="text" name="1_url" value="<?= $row["1_url"] ?>" size="100"></td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td> </td>
            </tr>
            <tr>
                <td>コメント</td>
                <td><input type="text" name="1_comment" value="<?= cnv_dispstr($row["1_comment"]) ?>" size="100"></td>
            </tr>
            <tr>
                <td>登録日時</td>
                <td><?= $row["1_date"] ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="更新" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <input type="hidden" name="1_date" value="<?= $row["1_date"] ?>">
        <input type="hidden" name="act" value="updconf">
    </form>
<?php
}

// 更新確認画面
function screen_updconf($row)
{
    if (!chk_data($row)) {
        return;
    }
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>更新確認画面</h3>
    <!-- 更新データ確認表示 -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>id</td>
                <td><?= $row["id"] ?></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><?= $row["1_url"] ?></td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td><?= $row["1_title"] ?></td>
            </tr>
            <tr>
                <td>コメント</td>
                <td><?= $row["1_comment"] ?></td>
            </tr>
            <tr>
                <td>登録日時</td>
                <td><?= $row["1_date"] ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="更新する" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <input type="hidden" name="1_url" value="<?= $row["1_url"] ?>">
        <input type="hidden" name="1_title" value="<?= $row["1_title"] ?>">
        <input type="hidden" name="1_comment" value="<?= $row["1_comment"] ?>">
        <input type="hidden" name="act" value="dojob">
        <input type="hidden" name="kbn" value="upd">
    </form>
<?php
}

// 削除確認画面
function screen_delconf($array)
{
    if (!isset($array["id"])) {
        return;
    }
    $row = get_data($array["id"]);
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>削除確認画面</h3>
    <!-- 削除データ確認表示 -->
    <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
        <table border="1">
            <tr>
                <td>id</td>
                <td><?= $row["id"] ?></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><?= $row["1_url"] ?></td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td><?= cnv_dispstr($row["1_title"]) ?></td>
            </tr>
            <tr>
                <td>コメント</td>
                <td><?= cnv_dispstr($row["1_comment"]) ?></td>
            </tr>
            <tr>
                <td>登録日時</td>
                <td><?= $row["1_date"] ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="削除する" name="sub1"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <input type="hidden" name="act" value="dojob">
        <input type="hidden" name="kbn" value="del">
    </form>
<?php
}

// 処理完了画面
function screen_dojob($array)
{
    $res_mes = db_update($array);
?>
    <!-- メニュー -->
    <?php disp_menu(); ?>
    <h3>処理完了画面</h3>
    <!-- 処理結果表示 -->
    <table border="0" bgcolor="pink">
        <tr>
            <td>処理結果</td>
            <td><?= $res_mes; ?></td>
        </tr>
    </table>
<?php
}

// ユーザ権限チェック
function chk_auth($array)
{
    if (isset($_POST["1_id"]) && isset($_POST["1_pass"])) {
        if ($_POST["1_id"] == LOGINID && $_POST["1_pass"] == LOGINPASS) {
            $_SESSION["auth"] = AUTHADMIN;
            return true;
        } else {
            return false;
        }
    } else {
        if (!isset($_SESSION["auth"])) {
            return false;
        } else {
            if ($_SESSION["auth"] == AUTHADMIN) {
                return true;
            } else {
                return false;
            }
        }
    }
}

// 登録データチェック
function chk_data($array)
{
    $strerr = "";
    if ($array["1_url"] == "") {
        echo "<p>URLが入力されていません";
        $strerr = "1";
    }
    if ($array["1_title"] == "") {
        echo "<p>タイトルが入力されていません";
        $strerr = "1";
    }
    if ($array["1_comment"] == "") {
        echo "<p>コメントが入力されていません";
        $strerr = "1";
    }
    if ($strerr == "1") {
        return false;
    } else {
        return true;
    }
}

// 配列データを一括変換
function cv_formstr($array)
{
    foreach ($array as $k => $v) {
        // 「magic_quotes_gpc = On」 のときはエスケープ解除
        if (get_magic_quotes_gpc()) {
            $v = stripslashes($v);
        }
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
    }
    $string = addslashes($string);
    return $string;
}

// 表示する文字コードに変換
function cnv_dispstr($string)
{
    // 文字コードを変更する
    $det_enc = mb_detect_encoding($string, "UTF-8, EUC-JP, SJIS");
    if ($det_enc && $det_enc != ENCODE) {
        return mb_convert_encoding($string, ENCODE, $det_enc);
    } else {
        return $string;
    }
}

// リンク先のURLとタイトルをリンクに変換
function cnv_link($url, $title)
{
    $string = "<a href=\"" . $url . "\">" . $title . "</a>";
    return $string;
}

// 指定データ抽出
function get_data($id)
{
    global $conn;
    $sql = "SELECT * FROM linkdata";
    $sql .= " WHERE (id = " . cnv_sqlstr($id) . ")";
    $res = db_query($sql, $conn);
    $row = $res->fetch_array(MYSQLI_ASSOC);
    return $row;
}

// データ一覧表示
function disp_listdata($key, $p)
{
    global $conn;
    $st = ($p - 1) * intval(ADMINPAGESIZE);
    $sql = "SELECT * FROM linkdata";

    if (strlen($key) > 0) {
        $sql .= " WHERE (1_url LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (1_title LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (1_comment LIKE '%" . cnv_sqlstr($key) . "%')";
    }

    $sql .= " ORDER BY 1_date DESC LIMIT " . $st . "," . intval(ADMINPAGESIZE);
    $res = db_query($sql, $conn);

    if ($res->num_rows < 1) {
        echo "<p>データは登録されていません";
        return;
    }
?>
    <table border="1">
        <tr>
            <td></td>
            <td>タイトル</td>
            <td>コメント</td>
            <td>登録日時</td>
        </tr>
        <?php
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        ?>
            <tr>
                <td>
                    <table>
                        <tr>
                            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                                <td><input type="submit" value="編集"></td>
                                <!-- 管理項目 -->
                                <input type="hidden" name="act" value="upd">
                                <!-- -->
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            </form>
                            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                                <td width="50%"><input type="submit" value="削除"></td>
                                <!-- 管理項目 -->
                                <input type="hidden" name="act" value="delconf">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            </form>
                        </tr>
                    </table>
                </td>
                <td><?= cnv_link($row["1_url"], cnv_dispstr($row["1_title"])) ?></td>
                <td><?= cnv_dispstr($row["1_comment"]) ?></td>
                <td><?= date("Y/m/d H:i:s", strtotime($row["1_date"])) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php disp_pagenav($key, $p);
}

// メニュー表示
function disp_menu()
{
?>
    <table>
        <tr>
            <td><b><?= ADMINAPPNAME ?></b></td>
            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                <td><input type="submit" value="登録画面へ"></td>
                <input type="hidden" name="act" value="ent">
            </form>
            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                <td><input type="submit" value="検索画面へ"></td>
                <input type="hidden" name="act" value="src">
            </form>
        </tr>
    </table>
<?php
}

// 前後ページへのリンク表示
function disp_pagenav($key, $p = 1)
{
    global $conn;
    $prev = $p - 1;
    $prev = ($prev < 1) ? 1 : $prev;
    $next = $p + 1;

    $sql = "SELECT COUNT(*) AS cnt FROM linkdata";
    if (isset($key) && strlen($key) > 0) {
        $sql .= " WHERE (1_url LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (1_title LIKE '%" . cnv_sqlstr($key) . "%')";
        $sql .= " OR (1_comment LIKE '%" . cnv_sqlstr($key) . "%')";
    }

    $res = db_query($sql, $conn) or die("データ抽出エラー");
    $row = $res->fetch_array(MYSQLI_ASSOC);
    $recordcount = $row["cnt"];
?>
    <table>
        <?php if ($p > 1) { ?>
            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                <td><input type="submit" value="« 前へ"></td>
                <input type="hidden" name="act" value="src">
                <input type="hidden" name="p" value="<?= $prev ?>">
                <input type="hidden" name="key" value="<?= $key ?>">
            </form>
        <?php } ?>
        <?php if ($recordcount > ($next - 1) * intval(ADMINPAGESIZE)) { ?>
            <form method="POST" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                <td width="50%"><input type="submit" value="次へ »"></td>
                <input type="hidden" name="act" value="src">


                <input type="hidden" name="p" value="<?= $next ?>">
                <input type="hidden" name="key" value="<?= $key ?>">
            </form>
        <?php } ?>
    </table>
<?php
}

// DB接続
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

// データ更新
function db_update($array)
{
    global $conn;
    global $dt;

    if (!isset($array["kbn"])) {
        return "パラメータエラー";
    }

    if ($array["kbn"] != "del") {
        if (!chk_data($array)) {
            return "パラメータエラー";
        }
    }

    if ($array["kbn"] != "ent") {
        if (!isset($array["id"])) {
            return "パラメータエラー";
        }
    }

    extract($array);

    if ($kbn == "ent") {
        $sql = "INSERT INTO linkdata (";
        $sql .= "1_url, ";
        $sql .= "1_title, ";
        $sql .= "1_comment, ";
        $sql .= "1_date ";
        $sql .= ") VALUES (";
        $sql .= "'" . cnv_sqlstr($l_url) . "', ";
        $sql .= "'" . cnv_sqlstr($l_title) . "', ";
        $sql .= "'" . cnv_sqlstr($l_comment) . "', ";
        $sql .= "'" . cnv_sqlstr($dt) . "'";
        $sql .= ")";
        $res = db_query($sql, $conn);

        if ($res) {
            return "登録完了";
        } else {
            return "登録失敗";
        }
    } elseif ($kbn == "upd") {
        $sql = "UPDATE linkdata SET ";
        $sql .= "l_url = '" . cnv_sqlstr($l_url) . "', ";
        $sql .= "l_title = '" . cnv_sqlstr($l_title) . "', ";
        $sql .= "l_comment = '" . cnv_sqlstr($l_comment) . "', ";
        $sql .= "l_date = '" . cnv_sqlstr($dt) . "' ";
        $sql .= "WHERE id = " . cnv_sqlstr($id);
        $res = db_query($sql, $conn);

        if ($res) {
            return "更新完了";
        } else {
            return "更新失敗";
        }
    } elseif ($kbn == "del") {
        $sql = "DELETE FROM linkdata ";
        $sql .= "WHERE id = " . cnv_sqlstr($id);
        $res = db_query($sql, $conn);

        if ($res) {
            return "削除完了";
        } else {
            return "削除失敗";
        }
    }
}

// DB接続解除
function db_close($conn)
{
    $conn->close();
}
?>