<?php
include("includes/db_con.php");
if(isset($_REQUEST['email_code']))
{
?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <!-- Meta -->
            <meta charset="utf-8">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="keywords" content="">
            <meta name="robots" content="all">
    
            <title>Indian Dava Bazar </title>
    
            <?php include('st-head.php'); ?>
        </head>            
        <body>
            <div class="wrapper">
	            <?php  include('st-header.php'); ?>
                <?php  include('st-breadcrumb.php'); ?>
               	<?php
				$email_text 			= mysqli_real_escape_string($db_con,$_REQUEST['email_code']);
				$sql_verify_email 		= " select * from `tbl_customer` where cust_emailstatus = '".$email_text."' ";
				$result_verify_email 	= mysqli_query($db_con,$sql_verify_email) or die(mysqli_error($db_con));
				$num_rows_verify_email 	= mysqli_num_rows($result_verify_email);
				
				if($num_rows_verify_email == 1)
				{
					$row_verify_email	= mysqli_fetch_array($result_verify_email);
					$cust_id	 		= $row_verify_email['cust_id'];	
					$sql_update_email 	= " UPDATE `tbl_customer` ";
					$sql_update_email 	.= " 	SET `cust_emailstatus`='1', ";
					$sql_update_email 	.= " 		`cust_modified`='".$datetime."' ";
					$sql_update_email 	.= " WHERE `cust_id` = '".$cust_id."' ";
					$result_update_email= mysqli_query($db_con,$sql_update_email) or die(mysqli_error($db_con));		
					
					if($result_update_email)
					{
						?>
						<!-- ========================================= MAIN ========================================= -->
						<main id="authentication" class="inner-bottom-md">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div align="center">
											<h2>
												<a href="<?php echo $BaseFolder; ?>/page-login" style="color:#F00;">
													Thank you for validating your email with us...
												</a>
												<script type="text/javascript">
													$("#model_body").html('<span style="style="color:#F00;">Thank you for validating your email with us...</span>');
													$('#error_model').modal('toggle');
													$('button.close-popup').on('click', function()
													{
														window.location.href = "<?php echo $BaseFolder.'/page-login'; ?>";
													});
												</script>
											</h2>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.container -->
						</main><!-- /.authentication -->
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
							window.location.href="/";
							</script>
						<?php			
					}
				}
				elseif($num_rows_verify_email > 1)
				{
					?>
						<script type="text/javascript">			
							window.location.href="/";
						</script>
					<?php				
				}
				else
				{
					?>
						<script type="text/javascript">		
							window.location.href="/";
						</script>
					<?php		
				}
				?>
                <?php include('st-footer.php'); ?>
            </div>
            <?php include('st-javascript.php'); ?>
        </body>
    </html>
	<?php	
}
else
{
	$admin_email 	= "support@idb.com";
	$sub 	 		= "Unauthorised user detected.";	
	$message 		= " User information.";
	sendEmail($admin_email,$sub,$message);
	?>
    	<script type="text/javascript">
			var cli_browser_info	= navigator.userAgent;
			var cli_ip_address		= "";
			$.getJSON("http://jsonip.com/?callback=?", function (data) {
    	    	console.log(data);
        		cli_ip_address		= data.ip;
    		});			
			window.location.href = "<?php echo $BaseFolder; ?>";
		</script>
    <?php
}
?>