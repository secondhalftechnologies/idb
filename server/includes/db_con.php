<?php ob_start();
   session_start();  

	ini_set('session.cookie_domain', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');
	date_default_timezone_set('Asia/Kolkata');
	$date 				= new DateTime(null, new DateTimeZone('Asia/Kolkata'));
	$datetime 			= $date->format('Y-m-d H:i:s');
	$error_path 		= "images/no-image.jpg";
	if ($_SERVER['HTTP_HOST'] == "localhost" || preg_match("/^192\.168\.0.\d+$/",$_SERVER['HTTP_HOST']) || preg_match("/^punit$/",$_SERVER['HTTP_HOST']))
	{
		
		$server_set = 0;
		$dbname 	= "idb2017";
		$dbuser 	= "root";
		$dbpass 	= "";
		if($_SERVER['HTTP_HOST'] == "localhost")
		{
			$BaseFolder = "http://localhost/idb/server";		
		}
		else
		{
			$BaseFolder = "http://192.168.0.19/idb/server";	
		}
		
	}
	else
	{
		
		$server_set = 1;
		$dbname = "kumar7_idb2017";
		$dbuser = "kumar7_idb2017";
		$dbpass = "Tech@!2017";	
		$BaseFolder = "https://www.kumar7.com";	
	}
	$db_con = mysqli_connect("localhost",$dbuser, $dbpass) or die("Can not connect to Database");
	$cookie_name		= "indian_dava_cart"; // cookie will be set with this name on planet educate users when not logged in
	$min_order_value 	= 500; // this variable to set min order value for shipping charges
	$shipping_charge	= 49;
	if($db_con)
	{
		mysqli_select_db($db_con,$dbname) or die(mysqli_error($db_con));
		//$_SESSION['front_panel'] 	= "";
		$logged_uid 			= 0;
		define('BASE_FOLDER',$BaseFolder);		
	}
	
	$json 			= file_get_contents('php://input');
	$obj 			= json_decode($json);
	$response_array	= array();

	
	$_SESSION['offline_cart']= array();
	
	
	function breadcrumbs($array)
	{
	global $BaseFolder;	
	global $logged_uid,$db_con;
	?>
    
    <div class="animate-dropdown">
    <!-- ========================================= BREADCRUMB ========================================= -->
    <div id="top-mega-nav">
        <div class="container">
            <nav>
                <ul class="inline">
                  <li class="breadcrumb-nav-holder">
                        <ul>
                            <li class="breadcrumb-item">
                                <a href="<?php echo $BaseFolder; ?>">Home</a>
                            </li>
                            <?php
							
							foreach($array as $url=>$name)
							{?>
                             <li class="breadcrumb-item current gray">
                                <a href="<?php echo $url; ?>"><?php echo ucwords($name) ?></a>
                            </li>
							<?php
                            }
							?>
                           
                            
                        </ul>
                    </li><!-- /.breadcrumb-nav-holder -->
                </ul>
                 <!--======================Start : Done By satish 03112017===========================-->
                <?php
                    
                    $sql_check_status= "SELECT cust_status  FROM tbl_customer WHERE cust_id ='".$logged_uid."' AND cust_type='trader'";
                    $res_check_status = mysqli_query($db_con,$sql_check_status) or die(mysqli_error($db_con));
                    $row_check_status = mysqli_fetch_array($res_check_status);
                    if($row_check_status['cust_status']==1)
                    {?>
                     <div class="fright padding20">
                        <a target="_blank" href="idbpanel/redirect.php">Go to Admin</a>
                    </div>
              <?php }
                
                ?>
                <!--======================End : Done By satish 03112017===========================-->
            </nav>
        </div><!-- /.container -->
    </div><!-- /#top-mega-nav -->
                <!-- ========================================= BREADCRUMB : END ========================================= -->
 </div>
	<?php
    }
?>