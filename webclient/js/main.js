function validateForm()
{
var err="";
var pw=document.forms["loginForm"]["password"].value;
if (pw==null || pw=="")
  {
  err="Check password";
  }
var id=document.forms["loginForm"]["p_id"].value;
if (id==null || id=="")
  {
  err="Check Name";
  }
if (err!="")
{
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
		      func  : "login",
		      p_id  : id,
              password: pw
		},
 		type		: 'post',
		success: function (out)
		{
			 window.location="index.php";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="No Such User";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}

function search_item()
{
var err="";
var c_value=document.forms["searchForm"]["c_value"].value;
if (c_value==null || c_value=="")
  {
  err="Please enter value";
  }
if (err!="")
{
  var a = document.getElementById('err1');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
}
var criteria=document.forms["searchForm"]["criteria"].value;
  var a = document.getElementById('err1');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      criteria: criteria,
		      c_value :c_value,
			  func : "search_item"
		},
 		type		: 'post',
		success: function (out)
		{
		   a.style.visibility="hidden";
		   var b = document.getElementById('showitem');
		   b.innerHTML="";
		   var temp="";
		   for(var i=0;i<out.length;i++)
		   {
            temp+="<li> Barcode:"+out[i]['i_id']
			+" Name: "+out[i]['name']
			+" Price: "+out[i]['price']
			+" Production Date: "+out[i]['productionDate']
			+" Expiry Date: "+out[i]['expiryDate']
            +" Producer: "+out[i]['producer']
			+" Supplier: "+out[i]['supplier'];
		   }
		   b.innerHTML=temp;
		},
		error: function() //failure: retrieve from local storage.
		{
		     var b = document.getElementById('showitem');
			 b.innerHTML="";
		     a.innerHTML="No such item";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}
function search_item_local()
{
var err="";
var c_value=document.forms["searchForm"]["c_value"].value;
if (c_value==null || c_value=="")
  {
  err="Please enter value";
  }
var s_id=document.forms["searchForm"]["s_id"].value;
if (s_id==null || s_id=="")
  {
  err="Please enter value";
  }
if (err!="")
{
  var a = document.getElementById('err1');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
}
var criteria=document.forms["searchForm"]["criteria"].value;
  var a = document.getElementById('err1');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      criteria: criteria,
		      c_value :c_value,
			  s_id:s_id,
			  func : "search_item_local"
		},
 		type		: 'post',
		success: function (out)
		{
		   a.style.visibility="hidden";
		   var b = document.getElementById('showitem');
		   b.innerHTML="";
		   var temp="";
		   for(var i=0;i<out.length;i++)
		   {
		   var localprice=out[i]['price'];
			if (out[i]['quantity']<out[i]['stock_floor'])
			{
				var adjustment=(out[i]['stock_floor']-out[i]['quantity'])/out[i]['stock_floor']*out[i]['floor_var'];
				localprice=parseFloat(out[i]['price'])+ parseFloat(out[i]['price']*adjustment);
			}
			else if(out[i]['quantity']>out[i]['stock_ceiling'])
			{
				var adjustment=(out[i]['quantity']-out[i]['stock_ceiling'])/out[i]['stock_ceiling']*out[i]['ceiling_var'];
				localprice=parseFloat(out[i]['price'])- parseFloat(out[i]['price']*adjustment);
			}
			localprice=Math.round(localprice*100)/100;
            temp+="<li> Barcode:"+out[i]['i_id']
			+" Name: "+out[i]['name']
			+" Price: "+localprice
			+" Production Date: "+out[i]['productionDate']
			+" Expiry Date: "+out[i]['expiryDate']
            +" Producer: "+out[i]['producer']
			+" Supplier: "+out[i]['supplier']
			+" Stock: "+out[i]['quantity']
			+" Stock Ceiling: "+out[i]['stock_ceiling']
			+" Stock Floor: "+out[i]['stock_floor']
			+" Ceiling Variable: "+out[i]['ceiling_var']
			+" Floor Variable: "+out[i]['floor_var'];
		   }
		   b.innerHTML=temp;
		},
		error: function() //failure: retrieve from local storage.
		{
		     var b = document.getElementById('showitem');
			 b.innerHTML="";
		     a.innerHTML="No such item";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}

function search_item_by_name()
{
var err="";
var name=document.forms["searchForm2"]["name"].value;
if (name==null || name=="")
  {
  err="Please enter item name";
  }
if (err!="")
{
  var a = document.getElementById('err1');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
}
  var a = document.getElementById('err1');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      name:name,
			  func : "search_item_by_name"
		},
 		type		: 'post',
		success: function (out)
		{
		    a.style.visibility="hidden";
			var b = document.getElementById('showitem');
		    b.innerHTML="";
			for(var i=0;i<out.length;i++)
		    temp+='<li> <img src="'+out[i]['imgPath']+'" alt="'+out[i]['imgId']+'" /> Barcode: '+out[i]['i_id']+' Name:'+out[i]['name']+' Producer:'+out[i]['producer']+' Supplier:'+out[i]['supplier']+' Production Date:'+out[i]['productionDate']+ 'Expire Date:'+out[i]['expiryDate']+'</li>';
			b.innerHTML=temp;
		},
		error: function() 
		{
		     var b = document.getElementById('showitem');
		     b.innerHTML="";
		     a.innerHTML="No such item";
			 a.style.visibility="visible";
		}
	}); 
}

function advanced_search()
{
var err="";
var from1=document.forms["advancedForm"]["from1"].value;
var from2=document.forms["advancedForm"]["from2"].value;
var till1=document.forms["advancedForm"]["till1"].value;
var till2=document.forms["advancedForm"]["till2"].value;
var category=document.forms["advancedForm"]["category"].value;
var producer=document.forms["advancedForm"]["producer"].value;
var supplier=document.forms["advancedForm"]["supplier"].value;
var criteria=document.forms["advancedForm"]["criteria"].value;
if (err!="")
{
  var a = document.getElementById('err1');
		a.innerHTML=err;
  a.style.visibility="visible";
  return false;
}
  var a = document.getElementById('err1');
  jQuery.ajax(
	{ 
		url			: "db/db_control.php",
 		dataType	: 'json',
		data        :
		{
		      from1:from1,
			  from2:from2,
			  till1:till1,
			  till2:till2,
			  category:category,
			  producer:producer,
			  supplier:supplier,
			  criteria:criteria,
			  func : "advanced_search"
		},
 		type		: 'post',
		success: function (out)
		{
		    a.style.visibility="hidden";
			var b = document.getElementById('showitem');
		    var temp="";
			for(var i=0;i<out.length;i++)
		    temp+='<tr> <td> '+out[i]['i_id']+' </td><td>'+out[i]['name']+' </td><td>'+out[i]['price']+' </td><td>'+out[i]['producer']+'</td><td>'+out[i]['supplier']+' </td><td>'+out[i]['productionDate']+ '</td><td>'+out[i]['expiryDate']+'</td></tr>';
			b.innerHTML=temp;	
            jQuery("#myTable").tablesorter(); 			
			jQuery("#myTable").tablesorter( {sortList: [[0,0], [0,1]]} ); 
		},
		error: function() 
		{
		     var b = document.getElementById('showitem');
		     b.innerHTML="";
		     a.innerHTML="No such item";
			 a.style.visibility="visible";
		}
	}); 
}

