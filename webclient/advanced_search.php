<?php
   session_start();
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
<head>
    <title> Advanced Search</title>
    <script src="js/jquery.min.js" type="text/javascript"></script>
	<script  type="text/javascript" src="js/admin.js"></script>
	<link rel="stylesheet" href="styles/jquery.ui.datepicker.css">
	<link rel="stylesheet" href="styles/jquery.ui.theme.css">
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.tablesorter.js"></script>
	<script src="js/jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
	 jQuery("#from1").datepicker();
	 jQuery( "#from1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	 jQuery( "#till1" ).datepicker();
	 jQuery( "#till1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	 
	 jQuery("#from2").datepicker();
	 jQuery( "#from2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	 jQuery( "#till2" ).datepicker();
	 jQuery( "#till2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	 jQuery("#myTable").tablesorter(); 
	 });
	</script>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="styles/default.css" type="text/css" />
  <script src="js/core.js" type="text/javascript"></script>
  <script src="js/mootools-core.js" type="text/javascript"></script>
  <script src="js/caption.js" type="text/javascript"></script>
  <script src="js/mootools-more.js" type="text/javascript"></script>
  <script src="js/jquery.nivo.slider.min.js" type="text/javascript"></script>
  <script  type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
 function keepAlive() {	var myAjax = new Request({method: "get", url: "index.php"}).send();} window.addEvent("domready", function(){ keepAlive.periodical(840000); });
  </script>

<link rel="stylesheet" href="styles/position.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="styles/general.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="styles/personal.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="styles/jquery.jscrollpane.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="styles/print.css" type="text/css" media="print" />


<script type='text/javascript' src='js/mosaic.1.0.1.min.js'></script> 
<script type='text/javascript' src='js/jquery.easing.js'></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
    	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>

<script type="text/javascript" src="js/proletarsk.cufonfonts.js"></script>

<script type="text/javascript">
					var $j = jQuery.noConflict();
					$j(window).load(function(){
				$j(function()
				{
					$j('.scroll-pane').jScrollPane();
				});
				});
					$j(document).ready(function(){
						$j('.main_menu ul li').hover(
							function() {
								$j(this).find('> ul').stop(false, true).slideDown();
								$j(this).addClass('act_button');
								$j(this).find('>ul ul').stop(false, true).fadeOut('fast');
							},
							function() {
								$j(this).find('ul').stop(false, true).slideUp('fast');
								$j(this).removeClass('act_button');

							}
						);
						$j(function()
						{
						$j("#link").hover(function(event) {
						event.preventDefault();
						$j(this).stop(false, true).toggleClass("link2");
						$j("#top_menu").stop(false, true).slideToggle();
						});
		 			});

						function preloadImages(imgs){
						var picArr = [];
						for (i = 0; i<imgs.length; i++){
							picArr[i]= new Image(100,100); 
							picArr[i].src=imgs[i]; 
						}
					}
					});
					$j(document).ready(function() {				
				$j('.excursions_line li').mosaic({
					animation	:	'slide'
			});
	});			
					
					
	 
</script>
</head>

<body class=" ">
<div id="all">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png"  alt="" /></a>
                </div>
       	 <div href="#" id="link"><?php if (isset($_SESSION['role'])) echo $_SESSION['role']; else echo 'Main Menu';?>
	<div id="top_menu" class="main_menu">
<ul class="menu">
<li class="item-464 current active"><a class=" home_link" href="index.php" >home </a></li>
<?php if (isset($_SESSION['role']))
{
echo '<li class="item-207 deeper parent"><a>Manage</a>';
switch($_SESSION['role'])
{
   case "System Admin":
   echo
   " 
    <ul>
	<li><a>Item</a>
	<ul>
	<li><a href='add_item.php'>Add item </a></li>
    <li><a href='delete_item.php'>Delete item </a></li>
	<li><a href='update_item.php'>Update item </a></li>
	</ul>
	</li>
    <li><a>Employee</a>
	<ul>
    <li><a href='add_employee.php'>Add Employee</a></li>
    <li><a href='delete_employee.php'>Delete Employee</a></li>
	</ul>
	</li>
	<li><a>Store</a>
	<ul>
	<li><a href='add_store.php'>Add Store </a></li>
	<li><a href='delete_store.php'>Delete Store </a></li>
	<li><a href='add_stock.php'>ADD Store Stock </a></li>
	<li><a href='view_store_transaction.php'>View Transaction</a></li>
	<li><a href='view_store_stock.php'>View Store Stock</a></li>
	</ul>
	</li>
    </ul>
	";
	break;
	case "Store Manager":
	echo
	"
    <ul>
    <li><a href='view_transaction.php'>View Transaction</a></li>
	<li><a href='view_stock.php'>View Stock</a></li>
	<li><a href='hyper.exe'>Download Software</a></li>
    </ul>
	";
	break;
	case "HQ Manager":
	echo
	" 
    <ul>
    <li><a href='view_store_transaction.php'>View Transaction </a></li>
	<li><a href='view_store_stock.php'>View Store Stock </a></li>
    <li><a href='add_store_stock.php'>ADD Store Stock </a></li>
    </ul>
	";
	break;
}
}else echo '<li class="item-207 deeper parent"><a>Welcome</a>';
?></li><li class="item-503"><a>Search</a><ul><li> <a href="advanced_search.php">Advanced Search</a></li><li> <a href="basic_search.php">Basic Search</a></li></ul></li><li class="item-513"><a href="news.php" >News</a></li><li class="item-444"><a href="about.php" >About</a><ul><li class="item-486"><a href="howto.php" >How To Use</a></li></ul></li></ul>
</div></div> 
<div class="slider_block">
<!-- BEGIN: Vinaora Nivo Slider >> http://vinaora.com/ -->
<div class="slide_projects">
<div class="slider-wrapper theme-default">
    <div id="vt_nivo_slider140" class="nivoSlider">
		<a target="_self" style="background: none;"><img src="images/slider_pic1.jpg" alt="Vinaora Nivo Slider" title="" /></a>
<a target="_self" style="background: none;"><img src="images/slider_pic2.jpg" alt="Vinaora Nivo Slider" title="" /></a>
<a  target="_self" style="background: none;"><img src="images/slider_pic3.jpg" alt="Vinaora Nivo Slider" title="" /></a>
<a  target="_self" style="background: none;"><img src="images/slider_pic4.jpg" alt="Vinaora Nivo Slider" title="" /></a>
<a  target="_self" style="background: none;"><img src="images/slider_pic5.jpg" alt="Vinaora Nivo Slider" title="" /></a>
    </div>
</div>
</div>
<script type="text/javascript">
	jQuery.noConflict();
	
	jQuery(window).load(function() {
		jQuery('#vt_nivo_slider140').nivoSlider({
			effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
			slices: 15, // For slice animations
			boxCols: 8, // For box animations
			boxRows: 4, // For box animations
			animSpeed: 500, // Slide transition speed
			pauseTime: 3000, // How long each slide will show
			startSlide: 0, // Set starting Slide (0 index)
			directionNav: 0, // Next & Prev navigation
			directionNavHide: 0, // Only show on hover
			controlNav: 1, // 1,2,3... navigation
			controlNavThumbs: 0, // Use thumbnails for Control Nav
			controlNavThumbsFromRel: 0, // Use image rel for thumbs
			controlNavThumbsSearch: '.jpg', // Replace this with...
			controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
			keyboardNav: 0, // Use left & right arrows
			pauseOnHover: 1, // Stop animation while hovering
			manualAdvance: 0, // Force manual transitions
			captionOpacity: 0.8, // Universal caption opacity
			prevText: 'Prev', // Prev directionNav text
			nextText: 'Next', // Next directionNav text
			beforeChange: function(){}, // Triggers before a slide transition
			afterChange: function(){}, // Triggers after a slide transition
			slideshowEnd: function(){}, // Triggers after all slides have been shown
			lastSlide: function(){}, // Triggers when last slide is shown
			afterLoad: function(){} // Triggers when slider has loaded
		});
    });
</script>
<!-- END: Vinaora Nivo Slider >> http://vinaora.com/ -->

</div>
   <div class="search_block">     </div>
   <div class="sub_menu">  		<div class="moduletable">
					
<ul class="menu">
<?php if (isset($_SESSION['role']))echo '<li class="item-449"> Welcome '.$_SESSION['name'].' <a href="db/db_control.php?func=logout" > logout</a></li>';else echo '<li class="item-449"> <form name="loginForm"> Employee ID<input size="10" type="text" name="p_id">Password:<input size="10" type="password" name="password">'.
'<button type="button" class="button" onClick="validateForm();">Login</button><div id="err" style="color:#FF0000;visibility:hidden;" >Show Errors</div></form></li>';
?>
		</div>
	   </div>
        
  <div id="header">
   <div class="head">
		 
    
       
  </div>
  </div>
   
  
  <div id="content"  >
    <div id="content2" class="scroll-pane" >
      <div class="padding_content">
        <div id="system-message-container"></div>
        <div class="wrapper_overflow">
          <div id="sidebar-1" >
            <div class="moduletable">
              <h3></h3>
            </div>
          </div>
          <div id="maincolbck">
            <div id="maincolumn" >
              <div class="item-page">
                <h2>Advanced Search</h2>
                <div class="wrapper_overflow">
                  <form name="advancedForm">
                    <br>
                    <table width="469" height="190" border="0">
                      <tr>
                        <td width="159" height="42">Category:</td>
                        <td width="132"><select name="category">
                          <option value="any">Any Category</option>
                         <?php  
						include_once("includes/connection.php");
						$result=mysql_query("SELECT * from `category`");
						while ($row=mysql_fetch_array($result))
						echo ' <option value="'.$row['c_id'].'">'.$row['c_name'].'</option>';
						?>
                        </select></td>
                        <td width="59">Name:</td>
                        <td width="138" ><input size="10" name="criteria" type="text" value="" placeholder="Item Name"></td>
                      </tr>
                      <tr>
                        <td height="42">Produced between:</td>
                        <td><input size="10" type="text" value="" name="from1" id="from1" placeholder="Any Date"></td>
                        <td>&nbsp;&nbsp;&nbsp;and</td>
                        <td><input size="10" type="text" name="till1" value="" id="till1" placeholder="Any Date"></td>
                      </tr>
                      <tr>
                        <td height="42">Expired between:</td>
                        <td><input size="10" type="text" name="from2" id="from2" value="" placeholder="Any Date"></td>
                        <td>&nbsp;&nbsp;&nbsp;and</td>
                        <td><input size="10" type="text" name="till2" id="till2" value="" placeholder="Any Date"></td>
                      </tr>
                      <tr>
                        <td height="38" colspan="3"><?php include_once("includes/connection.php");  $res=mysql_query("SELECT distinct `producer` FROM `item` "); echo 'Produced By:&nbsp;<select name= "producer"><option value="">Any</option>'; while ($row=mysql_fetch_array($res)) echo '<option value="'.$row["producer"].'">'.$row["producer"].'</option>'; echo'</select>';?>
                        <?php $res=mysql_query("SELECT distinct `supplier` FROM `item` "); echo 'Supplied By:&nbsp;&nbsp; <select name= "supplier"><option value="">Any</option>'; while ($row=mysql_fetch_array($res)) echo '<option value="'.$row["supplier"].'">'.$row["supplier"].'</option>'; echo'</select>';  ?></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" type="button" onClick="advanced_search();">Search</button></td>
                      </tr>
                    </table>
                    <br>
                  </form>
                  <div id="err1" style="color:#FF0000;visibility:hidden;" >Show Errors</div>
				  <table id="myTable" class="tablesorter" class="zebra-striped"> 
				  <thead> 
					<tr> 
						<th>Barcode</th> 
						<th>Name</th> 
						<th>Price</th> 
						<th>Producer</th> 
						<th>Supplier</th> 
						<th>Production Date</th> 
						<th>Expire Date</th> 
					</tr> 
				  </thead> 
				  <tbody id="showitem"> 
				  </tbody> 
				</table> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
  <div class="bottom_row">
<div class="center">
		 		<div class="moduletable">
					

<div class="custom"  >
	<div class="wrapper_overflow">
	<div class="foot_colum1">
    	<div class="foot_title">UHS</div>
        <p class="white"> Universal Hypermarket System
		</div>
    <div class="foot_colum2">
    	<div class="foot_title">Developers</div>
        <div class="testimonials_block">
        	 <div class="bg">Computer Engineering, CG3002 Group 18</div>
        </div>
    </div>
    <div class="foot_colum3">
    	<div class="foot_title">Services</div>
        <ul>
        <li><a href="#">Electrical Components</a></li>
        <li><a href="#">Electrical Devices </a></li>
        </ul>
    </div>
    <div class="foot_colum4">
    	<div class="foot_title">Follow  us</div>
        <ul>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">RSS feed</a></li>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Google plus</a></li>
        </ul>
    </div>
</div></div>		</div>
	
</div>
</div>





<div class="push"></div>
 
 
</div>
<div id="footer-outer">
  <div id="footer-sub">
    <div id="footer">
    			<div class="moduletable">
		</div>
	
        <div class="copy_title">Copyright</div>
      <p class="copy">
	     CEG Group 18
      </p>
    </div>
    <!-- end footer --> 
    
  </div>
</div>

</body>
</html>
