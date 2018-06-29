
<!DOCTYPE html>
<?php
$name = '';
session_start();
$name = $_SESSION['name'];


//セッション関係の終了
$_SESSION=array();
unset($_SESSION['name']);
if(isset($_COOKIE[ "PHPSESSID"] )) {
  setcookie( session_name(),'',time()-42000,'/');  
}
session_destroy();

//メール送信の準備
$mail_to = 'メールアドレス';
$mail_subject = 'お問い合わせメール';
//ヒアドキュメントでメール本文を作る
$mail_body = <<< EOF
------------------------------------
お名前：{$name}
------------------------------------
EOF;

mb_language('Japanese');
mb_internal_encoding('utf-8');
//メール送信の関数
//第一引数：送信先　第二引数：表題　第三引数：本文
$result = mb_send_mail($mail_to, $mail_subject, $mail_body);
//$result = false;
if(!$result){
  echo "メール送信に失敗しました。しばらく時間を空けてから送信してください。\n";
  exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>メール送信終了画面</title>
</head>
<body>
<h1>メール送信終了画面</h1>
<p>以下の内容でメールが送信されました</p>
<table>
<tr>
<th>お名前:</th><td><?php echo $name;?></td>
</tr>
</table>
<p><a href="index.php">フォームにもどる</a></p>
</body>
</html>
