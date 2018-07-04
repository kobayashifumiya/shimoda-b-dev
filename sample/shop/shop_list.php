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
<title>勉強会</title>
</head>
<body>

<?php
require_once('../common/common.php');
?>

商品一覧<br />
<br />
<form method="post" action="shop_list.php">
食材
<?php pulldown_syokuzai(); ?>&nbsp;
産地
<?php pulldown_santi(); ?>&nbsp;
価格帯
<?php pulldown_kakaku(); ?>
<br /> 
<input type="hidden" name="search" value="search"/><br />
<input type="text" name="keyword" style="width:300px">
<input type="submit"  value="検索" >
</form>

<?php

try
{
//検索したことがない場合
	if(isset($_POST['search'])==false)
	{


$dsn='mysql:dbname=ensyu;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_gazou_name=$rec['gazou'];

$dbh=null;


if($pro_gazou_name=='')
{
 $disp_gazou='';
}
else
{
 $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}


while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $disp_gazou.'<br />'; 
	print $rec['name'].'─';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
}


print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';
}
else{
//検索したことがある場合
$syokuzai=$_POST['syokuzai'];
$santi=$_POST['santi'];
$kakaku=$_POST['kakaku'];
$keyword=$_POST['keyword'];


//$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
/*$dsn='mysql:dbname=shop;host=localhost;charset=utf8';*/
$dsn='mysql:dbname=ensyu;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,gazou,syokuzai,santi,kakaku
FROM mst_product WHERE 1';


$stmt=$dbh->prepare($sql);
$stmt->execute();

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_gazou_name=$rec['gazou'];

$dbh=null;

$_x=0;

if($pro_gazou_name=='')
{
 $disp_gazou='';
}
else
{
 $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}



if($keyword==''){

	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			if($_x==0){
				print '該当の商品はありません';	
			}
			break;
		}
		if((strpos($rec['syokuzai'],$syokuzai)!==false)
		&&(strpos($rec['santi'],$santi)!==false)
		&&(strpos($rec['kakaku'],$kakaku)!==false))
		{
		print '<a href="shop_product.php?procode='.$rec['code'].'">';
		print $disp_gazou.'<br />'; 
		print $rec['name'].'─';
		print $rec['price'].'円';
		print '</a>';
		print '<br />';
		$_x=1;
		}
	}
}

else{
	
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		if($_x==0){
			print '該当の商品はありません';			
		}
		break;
	}
	if((strpos($rec['syokuzai'],$syokuzai)!==false)
	&&(strpos($rec['santi'],$santi)!==false)
	&&(strpos($rec['kakaku'],$kakaku)!==false)
	&&(strpos($rec['name'],$keyword)!==false))
	{
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $disp_gazou.'<br />'; 
	print $rec['name'].'─';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
	$_x=1;
	}
}
}

print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';

}
}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>

</body>
</html>