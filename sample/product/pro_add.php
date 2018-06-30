<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php require_once('../common/common.php'); ?>

商品追加<br />
<br />
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br />
<input type="text" name="name" style="width:200px" value=" "><br />
価格を入力してください。<br />
<input type="text" name="price" style="width:50px" value=" "><br />
画像を入力してください。<br />
<input type="file" name="gazou" style="width:400px"><br />
食材を選んでください。<br />
<?php pulldown_syokuzai(); ?><br />
産地を選んでください。<br />
<?php pulldown_santi(); ?><br />
価格を選んでください<br />
<?php pulldown_kakaku(); ?><br />
<br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>