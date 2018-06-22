
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
    ⑤注文番号入力画面<br /><br />
    管理者専用ページ<br /><br />


<?php

try
{

require_once('../common/common.php');

 $code=$_POST['code'];
 //$code=1;
 $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
 $user='root';
 $password='';
 
    // try
     //{
 $dbh=new PDO($dsn,$user,$password);
 $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

 $sql='SELECT order_number,order_date_and_time,id,item_number,purchase_number FROM order_pm WHERE 1';
 $stmt=$dbh->prepare($sql);
 $stmt->execute();
// $data[]=$pro_code;
// $stmt->execute($data);
 $dbh=null;

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
    if($code==$rec['order_number']){
        print $rec['order_number'];
        print '<br/>';
        print $rec['order_date_and_time'];
        print '<br/>';
        print $rec['id'];
        print '<br/>';
        print $rec['item_number'];
        print '<br/>';
        print $rec['purchase_number'];
        print '<br/>';
    }
}

//  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
// //  $pro_oder_number=$rec['order_number'];
// //  $pro_order_date_and_time=$rec['order_date_and_time'];
// //  $pro_ID=$rec['ID'];
// //  $pro_Item_Number=$rec['Item_Number'];
//  $pro_purchase_number=$rec['purchase_number'];
      



 //print '注文データ<br/><br/>';

}
 catch(Exception $e)
 {
     print'ただいま障害により大変ご迷惑をお掛けしております。';
     exit();
 }


?>

<table border="1" table cellpadding="10" table cellspacing>
<caption>発注商品情報</caption>
<tr>
<th>注文番号</th> <th>注文日</th> <th>ユーザーID</th> <th>商品名</th> <th>合計金額</th> <th>購入個数</th>
</tr>
<tr>
<td>00000001</td> <td>2018/5/20</td> <td>1</td> <td>桃太郎(トマト,北海道)</td> <td>300円</td> <td>3個</td>
</tr>
</td>
</table>
<?php
 
//      try
//     {
  
    
//      /*$sql='SELECT code,date,name FROM dat_sales WHERE code_member=?';
//      $stmt1=$dbh->prepare($sql);
//      $data1[]=$_SESSION['member_code'];
//      $stmt1->execute($data1);

//      $rec=$stmt1->fetch(PDO::FETCH_ASSOC);
//      $order_code=$rec['code'];

//      $sql='SELECT code_product,price,quantity FROM dat_sales_product WHERE code_sales=?';
//      $stmt2=$dbh->prepare($sql);
//      $data2[]=$order_code;
//      $stmt2->execute($data2);

//      $rec=$stmt2->fetch(PDO::FETCH_ASSOC);
//      $pro_code=$rec['code_product'];

//      $sql='SELECT name FROM mst_product WHERE code=?';
//      $stmt3=$dbh->prepare($sql);
//      $data3[]=$pro_code;
//      $stmt3->execute($data3);*/
     
//      $dbh=null;


// while(true)
// {
// 	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
// 	if($rec==false)
// 	{
// 		break;
// 	}
// 	//print '<a href="shop_product.php?procode='.$rec['code'].'">';
// 	print $rec['order_number'].'---';
//     print $rec['order_data_and_time'].'---';
//     print $rec['ID'].'---';
//     print $rec['Item_Number'].'---';
//     print $rec['order_number'].'---';
// 	//print '</a>';
// 	print '<br />';
// }
//     }
//      catch(Exception $e)
//      {
//          print'ただいま障害により大変ご迷惑をお掛けしております。';
//          exit();
//      }

    // ?>

<form method="POST"
      action="mailsend.php">
      
    <input type="submit" name="submit" value="メールを送信">
</form>
  <br />
 
  </body>  
</html>