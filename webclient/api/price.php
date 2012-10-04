<?php
 include_once("../includes/connection.php"); 
 $s_id=$_REQUEST['s_id'];
 $res=mysql_query("select i.i_id,i.name,i.price,s.stock_ceiling, s.quantity, s.stock_floor,s.ceiling_var,s.floor_var from item i, stock s where i.i_id=s.i_id and s.s_id=".$s_id);
 $numrow=mysql_num_rows($res);
 for($i=0;$i<$numrow;$i++)
 {
    $row=mysql_fetch_array($res);
	$ceilingv=$row['ceiling_var'];
	$ceiling=$row['stock_ceiling'];
	$floorv=$row['floor_var'];
	$floor=$row['stock_floor'];
	$quantity=$row['quantity'];
	$price=$row['price'];
	$localprice=$price;
	if ($quantity<$floor)
	{
		$adjustment=($floor-$quantity)/$floor*$floorv;
		$localprice=$price+ $price*$adjustment;
	}
	else if($quantity>$ceiling)
	{
		$adjustment=1-($quantity-$ceiling)/$ceiling*$ceilingv;
		$localprice=$price+ $price*$adjustment;
	}
	$localprice=number_format($localprice, 2, '.', '');
	if($i!=$numrow)
	$array=$row['i_id']." ".$row['name']." ".$localprice."\r\n";
	else $array=$row['i_id']." ".$row['name']." ".$localprice;
	echo $array;
 }
 ?>