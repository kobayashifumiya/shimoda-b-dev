
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
