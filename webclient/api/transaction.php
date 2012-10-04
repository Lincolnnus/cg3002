<?php
include_once("../includes/connection.php"); 
$i_id= $_REQUEST['i_id'];
$quantity= $_REQUEST['quantity'];
$trans_time= $_REQUEST['trans_time'];
$s_id=$_REQUEST['s_id'];
$profit=$_REQUEST['profit'];
$trans_id=$_REQUEST['trans_id'];
//insert transaction
$res = mysql_query(sprintf("INSERT INTO `transaction`(s_id,i_id,trans_time,quantity,trans_id,profit) VALUES  ('%s','%s','%s','%s','%s','%s')",$s_id,$i_id,$trans_time,$quantity,$trans_id,$profit)) or($res=mysql_error());
if ($res==true)
{
	$res = mysql_query(sprintf("UPDATE `stock` SET quantity=quantity-$quantity where s_id=$s_id and i_id=$i_id"))or($res=mysql_error());
	if ($res==true)
	echo "success";
	else echo "fail";
}
else echo "fail";
?>