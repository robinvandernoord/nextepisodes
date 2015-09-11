<?php
mysql_connect("db.WEBSI.TE", "USER1", "PASS1") or die(mysql_error());
mysql_select_db("NAME1") or die(mysql_error());
$id = $_POST["id"];
$show1 = $_POST["show1"];
$show2 = $_POST["show2"];
$show3 = $_POST["show3"];
$show4 = $_POST["show4"];
$show5 = $_POST["show5"];
$show6 = $_POST["show6"];
$show7 = $_POST["show7"];
$show8 = $_POST["show8"];
$show9 = $_POST["show9"];
$show10 = $_POST["show10"];
$query = "UPDATE reg_users
SET show1 = '{$show1}',
show2 = '{$show2}',
 show3 = '{$show3}',
 show4 = '{$show4}',
 show5 = '{$show5}',
 show6 = '{$show6}',
 show7 = '{$show7}',
 show8 = '{$show8}',
 show9 = '{$show9}',
 show10 = '{$show10}'
WHERE id = '{$id}'";

mysql_query($query);
print $id . $show1 . $show2;
mysql_close();
header('Location:  index.php');
exit();
?>
