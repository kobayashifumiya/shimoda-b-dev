
<!DOCTYPE html>
<!--<div style="text-align:center">-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="sen.css" rel="stylesheet" type="text/css">
        <title>ろくまる農園</title>
    </head>
    <body>
    注文番号入力画面<br /><br />
    管理者専用ページ<br /><br />
<?php

$code=$_POST['code'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,date,ID,product_name,price,quantity,email,family_email,total_fee FROM dat_sales_product WHERE 1';
 $stmt=$dbh->prepare($sql);
 $stmt->execute();

 $dbh=null;
while(true)
{
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
if($rec==false)
{
break;
}
    if($code==$rec['code']){
        ?>

        <div id="king">
        注文番号<br/>
        注文日時<br/>
        会員ID<br/>
        商品名<br/>
        単価<br/>
        購入個数<br/>       
        合計金額<br/>
        </div>
        <div id="queen">
        <?php
        print '&nbsp;:&nbsp;';
        print $rec['code'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['date'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['ID'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['product_name'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['price'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['quantity'];
        print '<br/>';
        print '&nbsp;:&nbsp;';
        print $rec['total_fee'];
        print '<br/>';
 ?>
 </div>
 <?php
  $family=$rec['family_email'];

    }
}

print '<form method="post" action="test_mail.php">';
print '<input type="hidden" name="family" value="'.$family.'">';
print '<input type="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="ＯＫ">';
print '</form>';
?>

</form>
  <br />
 <!-- </div>-->
 
  </body>  
</html>