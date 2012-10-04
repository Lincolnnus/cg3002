<?php

include_once("../includes/connection.php"); 

switch ($_SERVER['REQUEST_METHOD']) 
{
  case 'GET' :
         $id=$_GET['i_id'];
		 $res=mysql_query("SELECT * from item where i_id=".$id);
		 $res=mysql_fetch_assoc($res);
		 echo json_encode($res);
         break;
  case 'POST':
         $i_id=$_POST['i_id'];
		 $name=$_POST['name'];
		 $price=$_POST['price'];
		 $productionDate=$_POST['productionDate'];
		 $expiryDate=$_POST['expiryDate'];
		 $producer=$_POST['producer'];
		 $supplier=$_POST['supplier'];
		 $imgPath=$_POST['imgPath'];
		 $imgId=$_POST['imgId'];
         $query = mysql_query("INSERT INTO item values
		                           ( 
								    '$i_id',
									'$name',
								    '$price',
									'$productionDate',
									'$expiryDate',
									'$producer',
									'$supplier',
									'$imgPath',
						            '$imgId')");
          if(!$query) echo "Insertion Fail";
		  else
		  {
		     echo json_encode("One Item is successfully Added to the Database");
		  }
        break;
   case 'PUT':
   case 'DELETE' :
	      $result=mysql_query("DELETE from item where i_id=".$_REQUEST['i_id'])or die(mysql_error());
		  if(!$result) echo "Deletion Fail";
		  else
		  {
		     echo json_encode("Item Deletion Successful");
		  }
        break;
}
?>