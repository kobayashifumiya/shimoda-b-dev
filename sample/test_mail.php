<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
<?php
if (
    mb_send_mail('0114natume@gmail.com', 'TEST SUBJECT', 'ぽよん')
    )
 {
echo '送信完了';
} else {
echo '送信失敗';
}
?>
    </head>
    <body>
    メール送信結果画面<br /><br />
    管理者専用ページ<br /><br />
    ユーザーが登録したメールアドレスにメールが送信されました。<br /><br />
    <a href="http://localhost/shimoda-b-dev/sample/staff_login/staff_top.php">トップメニューへ</a><br />

  </body>  
</html>

