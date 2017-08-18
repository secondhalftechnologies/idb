<?php ob_start();
   session_start();  
/*if(isset($_SESSION)){
  }else{

  }
*/
/*
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('memory_limit','-1');
*/
ini_set('session.cookie_domain', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');
date_default_timezone_set('Asia/Kolkata');
$date 				= new DateTime(null, new DateTimeZone('Asia/Kolkata'));
$datetime 			= $date->format('Y-m-d H:i:s');
$error_path 		= "images/no-image.jpg";
if ($_SERVER['HTTP_HOST'] == "localhost" || preg_match("/^192\.168\.0.\d+$/",$_SERVER['HTTP_HOST']) || preg_match("/^prem$/",$_SERVER['HTTP_HOST']))
{
	$server_set = 0;
	$dbname 	= "idb2017";
	$dbuser 	= "root";
	$dbpass 	= "";
	$BaseFolder = "http://localhost/idb";	
}
else
{
	$server_set = 1;
	$dbname = "kumar7_idb2017";
	$dbuser = "kumar7_idb2017";
	$dbpass = "Tech@!2017";	
	$BaseFolder = "http://www.kumar7.com/idbpanel";	
}
$db_con = mysqli_connect("localhost",$dbuser, $dbpass) or die("Can not connect to Database");
$cookie_name		= "planet_educate_cart"; // cookie will be set with this name on planet educate users when not logged in
$min_order_value 	= 500; // this variable to set min order value for shipping charges
$shipping_charge	= 49;
if($db_con)
{
	mysqli_select_db($db_con,$dbname) or die(mysqli_error($db_con));
	//$_SESSION['front_panel'] 	= "";
	$logged_uid 			= 0;
	define('BASE_FOLDER',$BaseFolder);		
}
// For Generating Random Salt Value
function generateRandomString($length) 
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function generateRandomStringMobileVerification($length)
{
	$characters = '0123456789';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function randomString($query,$length)
{
	global $db_con;
	$random_string = generateRandomString($length);
	if($random_string != "")
	{
		$sql_check_string		= $query;
		$result_check_string 	= mysqli_query($db_con,$sql_check_string) or die(mysqli_error($db_con));
		$num_rows_check_string 	= mysqli_num_rows($result_check_string); 
		if($num_rows_check_string == 0)
		{
			return $random_string;
		}
		else
		{
			randomString($query,$length);
		}
	}
	else
	{
		randomString($query,$length);
	}
}

function randomStringMobileVerification($query,$length)
{
	global $db_con;
	$random_string = generateRandomStringMobileVerification($length);
	if($random_string != "")
	{
		$sql_check_string		= $query;
		$result_check_string 	= mysqli_query($db_con,$sql_check_string) or die(mysqli_error($db_con));
		$num_rows_check_string 	= mysqli_num_rows($result_check_string); 
		if($num_rows_check_string == 0)
		{
			return $random_string;
		}
		else
		{
			randomStringMobileVerification($query,$length);
		}
	}
	else
	{
		randomStringMobileVerification($query,$length);
	}
}

function SetCookieLive($name, $value='', $expire = 0, $path = '', $domain='', $secure=false, $httponly=false)
{
	$_COOKIE[$name] = $value;
    return setcookie($name, $value, false, false);
	//return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
}

if(isset($_COOKIE[$cookie_name])) 
{
	//first it will create cookie on user side and next time it will not create cookie again or not update.
}
else
{
	$random_string 		= "";
	$cart_cust_id_query	= " SELECT * FROM `tbl_cart` WHERE `cart_custid` = '".$random_string."' ";								
	$cookie_value 		= randomString($cart_cust_id_query,20);
	$cookie_value;
	SetCookieLive($cookie_name,$cookie_value,time()+3600,'','',true,false);
}
/* include this on page to get loader on page*/
function getloder()
{
	?>
 		<div id="lodermodal"></div>
    	<div id="loderfade"></div>
	<?php
}
/* include this on page to get loader on page*/
/* function to short the string */
function short($string, $max)
{
	if(strlen($string) >= $max)
	{
		$string = substr($string, 0, $max - 5).'...';
	} 
	return $string;
}
// get cart Count on page Load
function getCartCount()
{
	global $db_con;
	global $cookie_name;
	
	if(isset($_SESSION['front_panel']))
	{
		  $sql_cart_count		= " SELECT * FROM `tbl_cart` WHERE `cart_custid` like (SELECT cust_id FROM `tbl_customer` WHERE ";
		  $sql_cart_count		.= " `cust_email` like '".$_SESSION['front_panel']['name']."' or `cust_mobile_num` like '".$_SESSION['front_panel']['name']."') ";
		  $sql_cart_count		.= " and `cart_status` = 0 ";
		  $result_cart_count 	= mysqli_query($db_con,$sql_cart_count) or die(mysql_error());
		  $num_rows_cart_count= mysqli_num_rows($result_cart_count);
		  return "(".$num_rows_cart_count.")";
	}
	elseif(isset($_COOKIE[$cookie_name])) 
	{
		  $cookie_value	= $_COOKIE[$cookie_name];
		  							
		  $sql_cart_count		= " SELECT * FROM `tbl_cart` WHERE `cart_custid` like '".$cookie_value."' and `cart_status` = 0 ";
		  $result_cart_count 	= mysqli_query($db_con,$sql_cart_count) or die(mysql_error());
		  $num_rows_cart_count= mysqli_num_rows($result_cart_count);
		  return "(".$num_rows_cart_count.")";									
	  }
	  else
	  {
		  return "(0)";									
	  }
	  
	  
}
// get cart Count on page Load
/* loader on front end*/
function loaderData()
{
	global $BaseFolder;
	?>
    <style type="text/css">
		#lodermodal 
		{
			background: rgb(249, 249, 249) url("<?php print $BaseFolder; ?>/images/loader.gif") no-repeat scroll 50% 50% / 100% auto;
			border: 3px solid #ababab;
			border-radius: 20px;
			box-shadow: 1px 1px 10px #ababab;
			display: none;
			height: 100px;
			left: 45%;
			overflow: auto;
			padding: 30px 15px 0;
			position: fixed;
			text-align: center;
			top: 45%;
			width: 100px;
			z-index: 1002;
		}
		#loderfade 
		{
			background-color: #666;
			display: none;
			height: 100%;
			left: 0;
			opacity: 0.7;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 1001;
		}
		
		.searchdropdown{
			float:left;
			height:30px
		}
		
		.searchtextbox{
			border:1px solid #24282e !important;
			float:left;
			margin:10px 0px 0px 10px;
			height:30px !important;
			background:#fff;
			border-radius:5px;
		}
		
		.divfloatright
		{
		float:right;	
		}
	</style>
    <?php
}
/* include this on page to get bootstrap model pop up on page*/
function modelPopUp()
{
	?>
   
 <div class="modal fade studpkg" role="dialog">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
    <div class="modal-header">                    	
                        <div align="right">
							<button type="button" class="cws-button border-radius close-popup" data-dismiss="modal"><i class="fa fa-times"></i></button>
						</div>
        			</div>
       <img src="img/pe-student-package-steps-1-03.jpg">
    </div>
  </div>
</div>


		<div class="modal fade" id="error_model" role="dialog">
    		<div class="modal-dialog"><!-- Modal content-->
				<div class="modal-content">
        			<div class="modal-header">                    	
                        <div align="right">
							<button type="button" class="cws-button border-radius close-popup" data-dismiss="modal"><i class="fa fa-times"></i></button>
						</div>
        			</div>
                    <div style="clear:both;"></div>
        			<div class="modal-body text-center" id="model_body">
        			</div>
        			<div class="modal-footer">
						&nbsp;<!--<button type="button" class="show-more" data-dismiss="modal">Close</button>-->
        			</div>
      			</div>      
    		</div>
  		</div>
    <?php
}
/* include this on page to get bootstrap model pop up on page*/
// get header data of the page
function headerData()
{
	global $db_con;
	global $BaseFolder;
	?>
    	<header class="only-color">
		        
				        
		<div class="sticky-wrapper">
			<div class="sticky-menu">
				
			</div>
		</div>
	</header>   
    
    	<div style="clear:both"></div>
        
        
       
    <?php	
}
// get header data of the page

/*Redirect Url by punit 09-11-2016*/
function getCurrentURL()
{
	$currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	$currentURL .= $_SERVER["SERVER_NAME"];
 
	if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
	{
		$currentURL .= ":".$_SERVER["SERVER_PORT"];
	} 

	$currentURL .= $_SERVER["REQUEST_URI"];
	return $currentURL;
}

function reDirect_Url($param1)
{

   global $db_con;
   $sql_get_red_url	= " SELECT * from tbl_redirection where ru_source = '".$param1."' AND ru_status='1' ";
   $res_get_red_url 	= mysqli_query($db_con, $sql_get_red_url) or die(mysqli_error($db_con));
   $num_get_red_url	= mysqli_num_rows($res_get_red_url);	
   if($num_get_red_url == 0)
	{
		$new_url = '0';
	}
	else
	{
		$row_get_red_url	= mysqli_fetch_array($res_get_red_url);
		$new_url			= $row_get_red_url['rd_currentslug'];
	}
	return $new_url;
}
			
/*Redirect Url by punit 09-11-2016*/

// For Footer on page
function footerData()
{
	global $date;
	global $db_con;
	global $BaseFolder;	
	?>	
	 <?php
		getloder();
	?>
    <!--<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>-->	
	<script type="text/javascript" src="<?php print $BaseFolder; ?>/js/infobox_packed.js"></script>    
	<script type='text/javascript' src='<?php print $BaseFolder; ?>/js/jquery.validate.min.js'></script>
	<script src="<?php print $BaseFolder; ?>/js/jquery.form.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/TweenMax.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/main.js"></script>
	<!-- jQuery REVOLUTION Slider  -->
	<script type="text/javascript" src="<?php print $BaseFolder; ?>/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?php print $BaseFolder; ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/jquery.isotope.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/owl.carousel.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/jquery-ui.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/jquery.fancybox.pack.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/jquery.fancybox-media.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/retina.min.js"></script>    
    <!--<script src="<?php print $BaseFolder; ?>/js/main_functions.js"></script>-->
    <script src="<?php print $BaseFolder; ?>/js/main_functions_orrginal.js"></script>
    <!-- form script -->
	<script src="<?php print $BaseFolder; ?>/js/scripts/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/scripts/bootstrap.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/scripts/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/scripts/plugins/validation/additional-methods.min.js"></script>
	<script src="<?php print $BaseFolder; ?>/js/scripts/plugins/wizard/jquery.form.wizard.min.js"></script>
    <script src="<?php print $BaseFolder; ?>/js/select2/select2.min.js"></script>
    <script src="<?php print $BaseFolder; ?>/js/scripts/eakroko.min.js"></script> 
   
  
        
   <!--Start of Zopim Live Chat Script-->
<!--	<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){
z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?4ADHiTbDkuKWyK9tFvMANwyYcM6pl7wG';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');-->
</script>
<!--End of Zopim Live Chat Script-->    
	<script type="text/javascript">	
		$( document ).ready(function() 
		{
			$('.tooltipped').tooltip({
		     	placement: "top",
		     	trigger: "focus"
			});		
			$('#search_box').keypress(function(e) 
			{
				if(e.which == 13) 
				{
					url = "<?php echo $BaseFolder;?>"+"/search/"+$.trim($('#search_box').val())+"/";
					window.open(url);
				}
			});
			
			$('#search').keypress(function(e) 
			{   
			    var cat_id =$('#searchdrop').val();
			    var cat_text =$('#catid_'+cat_id).text();
				
			    
				if(e.which == 13 && $('#search').val() !="" && cat_id !=0) 
				{  
					url = "<?php echo $BaseFolder;?>"+"/search_data/"+$('#searchdrop').val()+"-"+$.trim($('#search').val())+"/";
					location.assign(url);
					//window.open(url);
				}
			});
			
		});			
	</script>
	<!-- form script -->
    <?php
	modelPopUp();	
}
// For Header- CSS, JS
function headIncludes($page_title,$canonical_url,$meta_description,$meta_keywords)
{
	global $BaseFolder;
	if(trim($page_title) == "")
	{
		$page_title 		= "Planet Educate";
	}	
	if(trim($meta_description) == "")
	{
		$meta_description 	= "Planet Educate";
	}
	if(trim($meta_keywords) == "")		
	{
		$meta_keywords 		= "";
	}
	?>
	<title><?php echo $page_title;?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<!-- style -->
    <?php
    	if(trim($canonical_url) != "")
    	{
			?>
				<link href="<?php echo $canonical_url;?>" rel="canonical" />
            <?php
   		}
	?>
	<link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="<?php print $BaseFolder; ?>/css/font-awesome.css">
	<link rel="stylesheet" href="<?php print $BaseFolder; ?>/fi/flaticon.css">
	<link rel="stylesheet" href="<?php print $BaseFolder; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php print $BaseFolder; ?>/tuner/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php print $BaseFolder; ?>/tuner/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php print $BaseFolder; ?>/css/jquery.fancybox.css" />
	<link rel="stylesheet" href="<?php print $BaseFolder; ?>/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?php print $BaseFolder; ?>/rs-plugin/css/settings.css" media="screen">
	<link rel="stylesheet" href="<?php print $BaseFolder; ?>/css/animate.css">
    <link rel="stylesheet" href="<?php print $BaseFolder; ?>/css/select2/select2.css">
    <script type="text/javascript">
		function stud_popup()
        {
			$('.studpkg').modal({
						backdrop: 'static'
					});
					
					$('button.close-popup').on('click', function()
					{	
						window.location.href	= "<?php echo $BaseFolder; ?>/page-login";
					});
			
        }
        </script> 
    <!-- select2 -->
	<style>
    .select2-choice {
		margin-top:10px !important;
		height:28px !important;
	}
    </style>
	<script src="<?php print $BaseFolder; ?>/js/jquery.min.js"></script> 
       
    <?php
	loaderData();
	?>
	<!--Google Analytics Code-->
    <script type="text/javascript">
  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  	ga('create', 'UA-78812046-1', 'auto');
  	ga('send', 'pageview');
	</script>
	<!--Google Analytics Code-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5878a56e5bcc2b263bd9ce85/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script--> 

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1832829593634914'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1832829593634914&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

   
	<?php   
}
// breadCrumbs
function breadCrumbs($breadcrumbs_title,$breadcrumbs_array)	// breadCrumbs('',Books)
{
	?>
		<div class="page-title">
			<div class="grid-row">
            	<?php
					if(trim($breadcrumbs_title) != "")
					{
						echo '<h1>'.$breadcrumbs_title.'</h1>';
					}
					else
					{						
					}
				?>
				<nav class="bread-crumb">
					<a href="/">Home</a>
                    <?php						
						foreach($breadcrumbs_array as $breadcrumbs_link => $breadcrumbs_title)
						{
							?>
								<i class="fa fa-chevron-right"></i>
								<a href="<?php echo $breadcrumbs_link;?>">
									<?php echo $breadcrumbs_title;?>
                                </a>							
							<?php                                
						}						
					?>
				</nav>
			</div>
		</div>    
    <?php
}

function insert($table, $variables = array() )
{
			//Make sure the array isn't empty
	global $db_con;
	if( empty( $variables ) )
	{
		return false;
		exit;
	}
	
	$sql = "INSERT INTO ". $table;
	$fields = array();
	$values = array();
	foreach( $variables as $field => $value )
	{
		$fields[] = $field;
		$values[] = "'".$value."'";
	}
	$fields = ' (' . implode(', ', $fields) . ')';
	$values = '('. implode(', ', $values) .')';
	
	$sql .= $fields .' VALUES '. $values;

	$result		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
	
	if($result)
	{
		return mysqli_insert_id($db_con);
	}
	else
	{
		return false;
	}
}

function update($table, $variables = array(), $where,$not_where_array=array(),$and_like_array=array(),$or_like_array=array())
{
	//Make sure the array isn't empty
	global $db_con;
	if( empty( $variables ) )
	{
		return false;
		exit;
	}
	
	$sql = "UPDATE ". $table .' SET ';
	$fields = array();
	$values = array();
	
	foreach($variables as $field => $value )
	{   
		$sql  .= $field ."='".$value."' ,";
	}
	$sql   =chop($sql,',');
	
	$sql .=" WHERE 1 = 1 ";
	//==Check Where Condtions=====//
	if(!empty($where))
	{
		foreach($where as $field1 => $value1 )
		{   
			$sql  .= " AND ".$field1 ."='".$value1."' ";
		}
	}

	$result 		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
	
	if($result)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function quit($msg,$Success="")
{
	if($Success ==1)
	{
		$Success="Success";
	}
	else
	{
		$Success="fail";
	}
	echo json_encode(array("Success"=>$Success,"resp"=>$msg));
	exit();
}


?>