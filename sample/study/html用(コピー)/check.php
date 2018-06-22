<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

require_once('common/common.php');

$post=sanitize($_POST);
$pro_name=$post['name'];
$pro_score=$post['score'];
$pro_comment=$post['comment'];

if($pro_name=='')
{
	print '名前が入力されていません。<br />';
}
else
{
	print '名前:';
	print $pro_name;
	print '<br />';
}

if(preg_match('/^[0-9]+$/',$pro_score)==0)
{
	print '評価点を入力してください。<br />';
}
else
{
	print '評価点:';
	print $pro_score;
	print '点<br />';
}

if($pro_comment=='')
{
	print 'コメントが入力されていません。<br />';
}
else
{
	print 'コメント:';
	print $pro_comment;
	print '<br />';
}

if($pro_name=='' || preg_match('/^[1-5]+$/',$pro_score)==0 || $pro_comment=='')
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記のレビューを追加します。<br />';
	print '<form method="post" action="done.php">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="score" value="'.$pro_score.'">';
	print '<input type="hidden" name="comment" value="'.$pro_comment.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>