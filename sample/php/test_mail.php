<!DOCTYPE html>
<html>
<body>
<?php
if (
    mb_send_mail('0114natume@gamil.com', 'TEST SUBJECT', 'TEST BODY')
    )
 {
echo '送信完了';
} else {
echo '送信失敗';
}
?>
<action="mailsend.php">
          <input type="submit" name="submit" value="メールを送信">
</body>
</html>