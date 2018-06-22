<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>勉強会</title>
</head>
<body>

<?php require_once('../common/common.php'); ?>
<form method="post" action="shop_search.php"> 
食材
<?php pulldown_syokuzai(); ?>
産地
<?php pulldown_santi(); ?>
価格
<?php pulldown_kakaku(); ?>
<br />
<input type="search" name="keyword" value=" "></p> 
<p><input type="submit" value="検索"></p> 
</form> 

<?php

try{


require_once('../common/common.php');

$dsn='mysql:dbname=ensyu;host=localhost;charset=utf8';;
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,syokuzai,santi,kakaku FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();


$dbh=null;

print '検索結果<br /><br />'; 

if($sql!==0){ 
	while(true) 
	{ 
	 $rec=$stmt->fetch(PDO::FETCH_ASSOC); 
	 if($rec==false) 
	 { 
	  break; 
	 }  
	 if(isset($_POST['keyword']) && $_POST['keyword'] != '')
{
	$keyword = $_POST['keyword'];
	$syokuzai=$_POST['syokuzai'];
	$santi=$_POST['santi'];
	$kakaku=$_POST['kakaku'];

	  if((strpos($rec['syokuzai'],$syokuzai)!==false) 
	  &&(strpos($rec['santi'],$santi)!==false) 
	  &&(strpos($rec['kakaku'],$kakaku)!==false)
	  &&(strpos($rec['name'],$keyword)!==false) ) 
	  { 
	 print '<a href="shop_product.php?procode='.$rec['code'].'">'; 
	 print $rec['name'].'---'; 
	 print $rec['price'].'円'; 
	 print '</a>'; 
	 print '<br />'; 
	 }
	 } else { 
	 print '<a href="shop_product.php?procode='.$rec['code'].'">'; 
	 print $rec['name'].'---'; 
	 print $rec['price'].'円'; 
	 print '</a>'; 
	 print '<br />'; 
	 } 
	} 
	}

print '<br />'; 
print '<a href="shop_cartlook.php">カートを見る</a><br />'; 

} 
catch (Exception $e) 
{ 
  print 'ただいま障害により大変ご迷惑をお掛けしております。'; 
  exit(); 
} 

?>


</body>
</html>
