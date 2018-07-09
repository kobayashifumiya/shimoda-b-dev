
<!DOCTYPE html>
<!--<div style="text-align:center">-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
    注文番号入力画面<br /><br />
    管理者専用ページ<br /><br />
<?php

$code=$_POST['code'];

$dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT order_number,order_date_and_time,id,product_name,total_fee,purchase_number,email_address_1,email_address_2 FROM order_pm WHERE 1';
 $stmt=$dbh->prepare($sql);
 $stmt->execute();

while(true)
{
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
if($rec==false)
{
break;
}
    if($code==$rec['order_number']){
        print "注文番号\t:\t";
        print $rec['order_number'];
        print '<br/>';
        print "注文日時\t:\t";
        print $rec['order_date_and_time'];
        print '<br/>';
        print "会員ID\t \t:\t";
        print $rec['id'];
        print '<br/>';
        print "商品名\t　:\t";
        print $rec['product_name'];
        print '<br/>';
        print "合計金額\t:\t";
        print $rec['total_fee'];
        print '<br/>';
        print "購入個数\t:\t";
        print $rec['purchase_number'];
        print '<br/>';
$email=$rec['email_address_2'];
 print "アドレス\t:\t";
 print $email;
    }
}

print '<form method="post" action="test_mail.php">';
print '<input type=""hidden name="email" value="'.$email.'">';
print '<input type="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="ＯＫ">';
print '</form>';
?>

</form>
  <br />
 <!-- </div>-->
 
  </body>  
</html>