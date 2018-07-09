<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
        </head>
    <body>
    メール送信結果画面<br /><br />
    管理者専用ページ<br /><br />
<?php
$family=$_POST['family'];
if (
    mb_send_mail($family, '配達完了のお知らせ', '配達が完了しました。')
    )
 {
echo '送信完了';
} else {
echo '送信失敗';
}

?>
   
    <?php
    print $family;
    ?>
    にメールが送信されました。<br /><br />
    <a href="order_input.php">注文番号入力画面へ</a><br />

  </body>  
</html>

