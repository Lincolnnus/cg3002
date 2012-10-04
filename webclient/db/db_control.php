<?php
session_start();
require_once 'db_constant.php';
db_init();
$d = &$_REQUEST;
if (isset ( $d ['func'] )) 
{
    $func = $d ['func'];
    switch ($func) 
	{
      case "add_item" :
         $i_id=$_REQUEST['i_id'];
		 $name=$_REQUEST['name'];
		 $price=$_REQUEST['price'];
		 $productionDate=$_REQUEST['productionDate'];
		 $expiryDate=$_REQUEST['expiryDate'];
		 $producer=$_REQUEST['producer'];
		 $supplier=$_REQUEST['supplier'];
		 $category=$_REQUEST['category'];
         $query = mysql_query("INSERT INTO item values
		                           ( 
								    '$i_id',
									'$name',
								    '$price',
									'$productionDate',
									'$expiryDate',
									'$producer',
									'$supplier',
									'$category')");
          if(!$query) echo "Insertion Fail,the Barcode Already Exists";
		  else
		  {
		     echo json_encode("One Item is successfully Added to the Database");
		  }
        break;
	   case "update_item" :
         $i_id=$_REQUEST['i_id'];
		 $name=$_REQUEST['name'];
		 $price=$_REQUEST['price'];
		 $productionDate=$_REQUEST['productionDate'];
		 $expiryDate=$_REQUEST['expiryDate'];
		 $producer=$_REQUEST['producer'];
		 $supplier=$_REQUEST['supplier'];
		 $category=$_REQUEST['category'];
         $query = mysql_query("Update item SET name='$name',price='$price',productionDate='$productionDate',expiryDate='$expiryDate',
		 producer='$producer', supplier='$supplier',c_id='$category'
         where i_id='$i_id'");		
          if(!$query) echo "Insertion Fail,the Barcode Already Exists";
		  else
		  {
		     echo json_encode("The item is successfully updated");
		  }
        break;
      case 'delete_item' :
	      $result=mysql_query("DELETE from item where i_id=".$_REQUEST['i_id'])or die(mysql_error());
		  if(!$result) echo "Deletion Fail";
		  else
		  {
		     echo json_encode("Item Deletion Successful");
		  }
        break;
      case 'search_item' :
	      $criteria=$_REQUEST['criteria'];
	      $c_value=$_REQUEST['c_value'];
	      $result=mysql_query("SELECT * from item where $criteria like '%$c_value%'")or die(mysql_error());
		  $num=0;
		  while($row = mysql_fetch_array($result))
		  {
		    $object[$num]=$row;
			$num++;
          }
		  echo json_encode($object);
        break;
	  case 'search_item_local' :
	      $criteria=$_REQUEST['criteria'];
	      $c_value=$_REQUEST['c_value'];
		  $s_id=$_REQUEST['s_id'];
	      $result=mysql_query("SELECT * from item i, stock s where i.i_id=s.i_id and i.".$criteria." like '%$c_value%'")or die(mysql_error());
		  $num=0;
		  while($row = mysql_fetch_array($result))
		  {
		    $object[$num]=$row;
			$num++;
          }
		  echo json_encode($object);
        break;
	  case 'login':
	      $result=mysql_query("SELECT * from personnel where p_id=".$_REQUEST['p_id'])or die(mysql_error());
		  if(!$result)
		  echo "No Such Employee";
		  else 
		  {
		    $res= mysql_fetch_array($result);
			if ($res['password']==$_REQUEST['password'])
			{ 
			  $_SESSION['role']=$res['role'];
	          $_SESSION['name']=$res['name'];
			  $_SESSION['s_id']=$res['s_id'];
			  echo json_encode("Welcome ".$res['name']);
			}
			else echo "No Such Employee";
		  }
		break;
      case 'search_transaction' :
        break;
      case 'send_stock' :
	   // $result=mysql_query("INSERT INTO stock values(".$_REQUEST['s_id'].",".$_REQUEST['i_id'].",".$_REQUEST['quantity'].",".$_REQUEST['temp_quantity'],.",");
	   // echo json_encode($result);
        break;
      case 'confirm_receive_stock' :
        break;
      case 'add_store' :
	      $s_id=$_REQUEST['s_id'];
		  $address=$_REQUEST['address'];
	      $result=mysql_query("INSERT INTO store values('$s_id','$address')")or die(mysql_error());
		  if($result)
		  echo json_encode("Add Store Successful");
		  else echo "fail";
        break;
	  case 'add_stock' :
	      $s_id=$_REQUEST['s_id'];$i_id=$_REQUEST['i_id'];$quantity=$_REQUEST['quantity'];  
		  $ceiling_var=$_REQUEST['ceiling_var'];
		  $floor_var=$_REQUEST['floor_var'];
		  $stock_floor=$_REQUEST['stock_floor'];
		  $stock_ceiling=$_REQUEST['stock_ceiling'];
	      $result=mysql_query("SELECT * FROM stock where s_id='$s_id' and i_id='$i_id'") or die(mysql_error());
		  $res=mysql_fetch_assoc($result);
		  if (isset($res['s_id']))
		  {
		      $result=mysql_query("UPDATE `stock` SET quantity=quantity+$quantity,ceiling_var=$ceiling_var, floor_var=$floor_var, stock_floor=$stock_floor, stock_ceiling=$stock_ceiling
			WHERE s_id='$s_id' and i_id='$i_id'") or die(mysql_error());
			  if($result)
			  echo json_encode("Update Stock Successful");
			  else echo "fail";
		  }
		  else
		  {
			  $result=mysql_query("INSERT INTO stock(s_id,i_id,quantity,stock_ceiling,stock_floor,ceiling_var,floor_var) 
									values('$s_id',
									'$i_id',
									'$quantity',
									'$stock_ceiling',
									'$stock_floor',
									'$ceiling_var',
									'$floor_var')")or die(mysql_error());
			  if($result)
			  echo json_encode("Add Stock Successful");
			  else echo "fail";
		  }
        break;
	  case 'add_cate':
	     $c_name=$_REQUEST['name'];
	     $result=mysql_query("INSERT INTO `category`(c_name) 
									values('$c_name')")or die(mysql_error());
			  if($result)
			  echo json_encode("Add Stock Successful");
			  else echo "fail";
		break;
      case 'delete_store' :
	      $result=mysql_query("DELETE from store where s_id=".$_REQUEST['s_id'])or die(mysql_error());
		  if($result)
		  echo json_encode("Delete Store Successful");
		  else echo "fail";
	    break;
	  case 'add_employee':
	     $query=sprintf("INSERT INTO personnel values('%s','%s','%s','%s','%s')",$_REQUEST['p_id'],$_REQUEST['name'],$_REQUEST['password'],$_REQUEST['role'],$_REQUEST['s_id']);
         $result=mysql_query($query); 	   
		 if(!$result) echo "employee add failed";
		 else echo json_encode("Employee add successful");
	    break;
	  case 'remove_employee':
	      $result=mysql_query("DELETE from personnel where p_id=".$_REQUEST['p_id'])or die(mysql_error());
		  if(!$result) echo "employee deletion failed";
		  else echo json_encode("Employee deletion successful");
		break;
	  case 'logout':
	     unset($_SESSION['role']);
		 unset($_SESSION['name']);
		 unset($_SESSION['s_id']);
         session_destroy();
		 header('Location: ../index.php');
	    break;
	  case 'advanced_search':
	     $where="";
	     $from1=$_REQUEST['from1'];
		 $from2=$_REQUEST['from2'];
		 $till1=$_REQUEST['till1'];
		 $till2=$_REQUEST['till2'];
		 $category=$_REQUEST['category'];
		 $producer=$_REQUEST['producer'];
		 $supplier=$_REQUEST['supplier'];
		 $criteria=$_REQUEST['criteria'];
		 if($from1!="")
		 {
		    $where="productionDate>='$from1'";
		 }
		 else if($from2!="")
		 {
		    $where="expiryDate>='$from2'";
		 }
		 else if($till1!="")
		 {
		    $where="productionDate<='$till1'";
		 }
		 else if($till2!="")
		 {
		    $where="expiryDate<='$till2'";
		 }
		 else if($category!="any")
		 {
		    $where="c_id='$category'";
		 }
		 else if($producer!="")
		 {
		    $where="producer='$producer'";
		 }
		 else if($supplier!="")
		 {
		   $where="supplier='$supplier'";
		 }
		 else if ($criteria!="")
		 {
		    $where="(i_id='$criteria') or (name like '%$criteria%')";
		 }
		  if($from1!="")
		 {
		    $where.=" and productionDate>='$from1'";
		 }
		 if($from2!="")
		 {
		    $where.=" and expiryDate>='$from2'";
		 }
		 if($till1!="")
		 {
		    $where.=" and productionDate<='$till1'";
		 }
		 if($till2!="")
		 {
		    $where.=" and expiryDate<='$till2'";
		 }
		 if($category!="any")
		 {
		    $where.=" and c_id= '$category'";
		 }
		 if($producer!="")
		 {
		    $where.=" and producer='$producer'";
		 }
		 if($supplier!="")
		 {
		   $where.=" and supplier='$supplier'";
		 }
		 if ($criteria!="")
		 {
		    $where.=" and ((i_id='$criteria') or (name like '%$criteria%'))";
		 }
		 if ($where=="")
		 {
			$result=mysql_query("SELECT * from item")or die(mysql_error());
		 }
		 else
		 $result=mysql_query("SELECT * from item where ".$where)or die(mysql_error());
		 $num=0;
		 while($row = mysql_fetch_array($result))
		 {
		    $object[$num]=$row;
			$num++;
         }
		 if ($num==0)
		 echo "No such item!";
		 else 
		 echo json_encode($object);
		 break;
   }
}
else
{
   echo "No function called";
}
function db_init() {
    global $config;
    $conn = mysql_connect($config['db']['hostname'], $config['db']['username'], $config['db']['password']);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($config['db']['db_name'], $conn);
}
?>