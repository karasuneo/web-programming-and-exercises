<?php
// セッションを開始
session_start();

// ユーザーIDがセッション変数に保存されているかチェック
if (!empty($_SESSION['sesuserid'])) {
    // セッション変数が設定されているとき

    print "<!DOCTYPE html>\n";
    print "<html lang=\"ja\">\n";
    print "<head>\n";
    print "<meta charset=\"UTF-8\">\n";
    print "<title></title>\n";
    print "</head>\n";
    print "<body>\n";
    print "<p>";
    print "あなたのユーザーIDは " . $_SESSION['sesuserid'] . " です。<br><br>";
    print "*****************************************<br>";
    print "*****************************************<br>";
    print "** ここにユーザーのメインコンテンツ **<br>";
    print "*****************************************<br>";
    print "*****************************************<br>";
    print "</p></body></html>";
} else {
    // セッション変数が設定されていないとき
    // sample14-09.php へリダイレクト
    header("location: sample14-09.php");
    exit();
}
?>
