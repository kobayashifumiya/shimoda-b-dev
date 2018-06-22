<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

try
{

//$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
/*$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
*/
$dsn='mysql:dbname=order_pm;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT order_number,oder_date_and_time,ID,Item_Number,purchase_number FROM oder_pm WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print 'レビュー一覧<br /><br />';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print $rec['order_number'].'番';
	print $rec['oder_date_and_time'].'---';
	print $rec['ID'].'点<br/>';
	print $rec['Item_Number'].'<br/>';
	print $rec['purchase_number'].'点<br/>';

	print '<br />';
}

print '<br />';
print '<a href="add.php">レビューをする</a><br />';

}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>

</body>
</html>