var isInteger_re     = /^\s*(\+|-)?\d+\s*$/;
function isInteger (s) {
   return String(s).search (isInteger_re) != -1
}
function add_item()
{
var err="";
var Barcode=document.forms["additemForm"]["i_id"].value;
if (Barcode==null || Barcode=="")
  {
  err="Check Barcode";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
if (Barcode.length!=6 || (!isInteger(Barcode)))
  {
  err="Barcode must be a 6 digit number";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var name=document.forms["additemForm"]["name"].value;
if (name==null || name=="")
  {
  err="Check name";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var price=document.forms["additemForm"]["price"].value;
if (price==null || price=="")
  {
  err="Check price";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var category=document.forms["additemForm"]["category"].value;
if (category==null || category=="")
  {
  err="Check category";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var productionDate=document.forms["additemForm"]["productionDate"].value;
if (productionDate==null || productionDate=="")
  {
  err="Check Production Date";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var expiryDate=document.forms["additemForm"]["expiryDate"].value;
if (expiryDate==null || expiryDate=="")
  {
  err="Check expiryDate";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var producer=document.forms["additemForm"]["producer"].value;
if (producer==null || producer=="")
  {
  err="Check producer";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var supplier=document.forms["additemForm"]["supplier"].value;
if (supplier==null || supplier=="")
  {
  err="Check supplier";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var a = document.getElementById('err');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "add_item",
		      i_id :Barcode,
              name :name,
	          price:price,
	          productionDate:productionDate,
	          expiryDate :expiryDate,
	          producer :producer,
	          supplier :supplier,
			  category:category
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Add Item Fail, item id already exists";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function update_item()
{
var err="";
var Barcode=document.forms["updateitemForm"]["i_id"].value;
if (Barcode==null || Barcode=="")
  {
  err="Check Barcode";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
if (Barcode.length!=6 || (!isInteger(Barcode)))
  {
  err="Barcode must be a 6 digit number";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var name=document.forms["updateitemForm"]["name"].value;
if (name==null || name=="")
  {
  err="Check name";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var price=document.forms["updateitemForm"]["price"].value;
if (price==null || price=="")
  {
  err="Check price";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var category=document.forms["updateitemForm"]["category"].value;
if (category==null || category=="")
  {
  err="Check category";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var productionDate=document.forms["updateitemForm"]["productionDate"].value;
if (productionDate==null || productionDate=="")
  {
  err="Check Production Date";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var expiryDate=document.forms["updateitemForm"]["expiryDate"].value;
if (expiryDate==null || expiryDate=="")
  {
  err="Check expiryDate";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var producer=document.forms["updateitemForm"]["producer"].value;
if (producer==null || producer=="")
  {
  err="Check producer";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var supplier=document.forms["updateitemForm"]["supplier"].value;
if (supplier==null || supplier=="")
  {
  err="Check supplier";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
}
  var a = document.getElementById('err');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "update_item",
		      i_id :Barcode,
              name :name,
	          price:price,
	          productionDate:productionDate,
	          expiryDate :expiryDate,
	          producer :producer,
	          supplier :supplier,
	          imgPath : imgPath,
	          imgId :imgId,
			  stock_floor:floor,
			  stock_ceiling:ceiling,
			  ceiling_var:ceilingv,
			  floor_var:floorv,
			  category:category
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="update Item Fail, item id already exists";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function delete_item()
{
    var err="";
    var Barcode=document.forms["deleteitemForm"]["i_id"].value;
    if (Barcode==null || Barcode=="")
    {
        err="Check Barcode";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
    var a = document.getElementById('err');
    jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "delete_item",
		      i_id :Barcode,
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Item Deletion failed,please check the item id";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}

function add_employee()
{
    var err="";
    var p_id=document.forms["addemployeeForm"]["p_id"].value;
    if (p_id==null || p_id=="")
    {
        err="Check Empolyee Id";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var name=document.forms["addemployeeForm"]["name"].value;
    if (name==null || name=="")
    {
        err="Check Empolyee Name";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var password=document.forms["addemployeeForm"]["password"].value;
    if (password==null || password=="")
    {
        err="Check Password";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var role=document.forms["addemployeeForm"]["role"].value;
    if (role==null || role=="")
    {
        err="Check role";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var s_id=document.forms["addemployeeForm"]["s_id"].value;
    if (s_id==null || s_id=="")
    {
        err="Check Empolyee Id";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
    var a = document.getElementById('err');
    jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "add_employee",
		      s_id :s_id,
			  p_id:p_id,
			  name:name,
			  password:password,
			  role:role
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Add Employee failed, the Employee id already exists";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function delete_employee()
{
    var err="";
    var p_id=document.forms["deleteemployeeForm"]["p_id"].value;
    if (p_id==null || p_id=="")
    {
        err="Check Employee id";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
    var a = document.getElementById('err');
    jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "delete_employee",
		      p_id :p_id
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Employee Deletion failed,Please check the employee id is correct";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function add_store()
{
    var err="";
    var s_id=document.forms["addstoreForm"]["s_id"].value;
    if (s_id==null || s_id=="")
    {
        err="Check store id";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	var address=document.forms["addstoreForm"]["address"].value;
    if (address==null ||address=="")
    {
        err="Check address";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
    var a = document.getElementById('err');
    jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "add_store",
		      s_id :s_id,
			  address:address
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Store Addtion Failed, there's already such store exists";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function delete_store()
{
    var err="";
    var s_id=document.forms["deletestoreForm"]["s_id"].value;
    if (s_id==null || s_id=="")
    {
        err="Check store id";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
    var a = document.getElementById('err');
    jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "delete_store",
		      s_id :s_id
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Store Deletion failed, please check the store id";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function add_cate()
{
    var err="";
    var name=document.forms["addcateForm"]["cate"].value;
    if (name==null || name=="")
    {
        err="Check Item ID";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var a = document.getElementById('err');
   jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "add_cate",
		      name :name
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
			 alert(out);
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Add Category failed";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function add_stock()
{
    var err="";
    var i_id=document.forms["addstockForm"]["i_id"].value;
    if (i_id==null || i_id=="")
    {
        err="Check Item ID";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	if (i_id.length!=6 || (!isInteger(i_id)))
    {
        err="Check Item ID";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var s_id=document.forms["addstockForm"]["s_id"].value;
    if (s_id==null || s_id=="")
    {
        err="Check Stock ID";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
	 var quantity=document.forms["addstockForm"]["quantity"].value;
    if (quantity==null || quantity=="")
    {
        err="Check quantity";
        var a = document.getElementById('err');
		a.innerHTML=err;
        a.style.visibility="visible";
        return false;
    }
var ceiling=document.forms["addstockForm"]["ceiling"].value;
if (ceiling==null || ceiling=="")
  {
  err="Check stock ceiling";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var ceilingv=document.forms["addstockForm"]["ceilingv"].value;
if (ceilingv==null || ceilingv=="")
  {
  err="Check ceiling variable";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
var floor=document.forms["addstockForm"]["floor"].value;
if (floor==null || floor=="")
  {
  err="Check stock floor";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
 var floorv=document.forms["addstockForm"]["floorv"].value;
if (floorv==null || floorv=="")
  {
  err="Check floor variable";
  var a = document.getElementById('err');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
  }
    var a = document.getElementById('err');
   jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      func  : "add_stock",
		      s_id :s_id,
			  i_id:i_id,
			  quantity:quantity,
			  stock_floor:floor,
			  stock_ceiling:ceiling,
			  ceiling_var:ceilingv,
			  floor_var:floorv
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
			 alert(out);
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Add Stock failed, please check you entered the correct store id and item id";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}