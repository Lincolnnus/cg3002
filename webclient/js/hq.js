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
			  quantity:quantity
		},
 		type		: 'post',
		success: function (out)
		{
			 a.innerHTML=out;
			 a.style.visibility="visible";
		},
		error: function() //failure: retrieve from local storage.
		{
		     a.innerHTML="Add Stock failed";
			 a.style.visibility="visible";
			// Do nothing?
			// Don't Touch existing posts
		}
	}); 
}