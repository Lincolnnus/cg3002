<?php
include_once("../includes/connection.php");
$p_id=$_REQUEST['p_id'];
$password=$_REQUEST['password'];
$result=mysql_query("select * from personnel where p_id=".$p_id." and password=".$password)or($err=mysql_error());
if(isset($err)||(!$result))
echo "fail";
else
{
	$res= mysql_fetch_array($result);
	if (isset($res['name'])&&($res['role']=="Store Manager"))
	echo $res['s_id'];
	else echo "fail";
}
?>