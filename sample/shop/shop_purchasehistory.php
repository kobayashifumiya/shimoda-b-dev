<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ようこそゲスト様　';
	print '<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print ' 様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
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

<?php

try
{

//$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
/*$dsn='mysql:dbname=shop;host=localhost;charset=utf8';*/

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,date,name FROM dat_sales WHERE code_member=?';
$stmt1=$dbh->prepare($sql);
$data1[]=$_SESSION['member_code'];
$stmt1->execute($data1);

$rec1=$stmt1->fetch(PDO::FETCH_ASSOC);
$order_code=$rec1['code'];

$sql='SELECT code_product,price,quantity FROM dat_sales_product WHERE code_sales=?';
$stmt2=$dbh->prepare($sql);
$data2[]=$order_code;
$stmt2->execute($data2);

$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
$pro_code=$rec2['code_product'];

$sql='SELECT name FROM mst_product WHERE code=?';
$stmt3=$dbh->prepare($sql);
$data3[]=$pro_code;
$stmt3->execute($data3);

$rec3=$stmt3->fetch(PDO::FETCH_ASSOC);

$dbh=null;

print '-----購入履歴一覧-----<br /><br />';
//配列定義
$a_date=array();
$a_code_product=array();
$a_name=array();
$a_price=array();
$a_quantity=array();

//配列代入
while(true)
{
	$rec1=$stmt1->fetch(PDO::FETCH_ASSOC);
	$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
	$rec3=$stmt3->fetch(PDO::FETCH_ASSOC);
	if($rec1==false&&$rec2==false&&$rec3==false)
	{
		break;
	}

$a_date[]=$rec1['date'];
$a_code_product[]=$rec2['code_product'];
$a_name[]=$rec3['name'];
$a_price[]=$rec2['price'];
$a_quantity[]=$rec2['quantity'];
}

//ソート
arsort($a_date);
//データ数取得
$rev_num=count($a_date);
for ($i = 0; $i < $rev_num; $i++){
	//ポインタ取得
	$key=key($a_date);
	//ポインタを進める（次のデータ表示のための準備）
	next($a_date);
	$j=$i+1;
	
	print $j.' ';
	print '注文日時<br />';
	print $a_date[$key].'<br />';
	print '商品番号<br />';
	print $a_code_product[$key].'<br />';
	print '商品名<br />';
	print $a_name[$key].'<br />';
	print '価格<br />';
	print $a_price[$key].'<br />';
	print '購入個数<br />';
	print $a_quantity[$key].'<br />';
	next ($a_date);
	print '-----------------------------------------------------------------------------------------------';
	print '<br />';
}
}

catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>
<a href="shop_list.php">完了</a>

</body>
</html>
