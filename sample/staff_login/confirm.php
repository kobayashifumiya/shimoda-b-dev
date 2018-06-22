<!DOCTYPE html>
<html>
  <body>
    <?php
//文字指定
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//メールの内容
$to = "s1642047ee@s.chibakoudai.jp";
$title = "テスト";
$content = "テスト中";
$from = "From: 0114natume@gmail.com\r\n";
$from .= "Return-Path: 0114natume@gmail.com";

//メールの送信
$send_mail = mb_send_mail($to, $title, $content, $from);

//メールの送信に問題ないかチェック
if ($send_mail) {
  echo "ok";
} else {
  echo "no";
}
?>
  </body>
</html>