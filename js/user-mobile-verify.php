<?php
	include("includes/db_con.php");
	
	if(isset($_SESSION['otp_validation']))
	{
		$otp_validation	= $_SESSION['otp_validation'];		
	}
	else
	{
		$otp_validation ="";
	}
	//exit();
	
	if(isset($_SESSION['front_panel']) == true)
	{
		$sql 		= "SELECT * FROM `tbl_customer` WHERE (`cust_email` like '".$_SESSION['front_panel']['name']."' ";
		$sql 	   .= "or `cust_mobile_num` like '".$_SESSION['front_panel']['name']."' ) ";									
		$result 	= mysqli_query($db_con,$sql) or die(mysql_error());
		$row		= mysqli_fetch_array($result);
		
		$cust_mobile_num	= $row['cust_mobile_num'];
		$cust_mobile_status	= $row['cust_mobile_status'];
		
		$num_rows 	= mysqli_num_rows($result);
		
		if($cust_mobile_status != '1') // if customer has not verified his mobileno i.e status not equals to 1 then it will go in if statement
		{
			if($num_rows != 0)
			{
				?>
				<!DOCTYPE html>
				<html>
					<head>
						<?php 
							$page_title			= "Mobile Verification";
							$meta_title			= "Mobile Verification";
							$meta_description	= "Mobile Verification";
							$meta_keywords		= "Mobile Verification";
							headIncludes($page_title,$meta_title,$meta_description,$meta_keywords);	
						?>
					</head>
					<body class="">
						<!-- header-->
						<?php 
                            headerData(); 
                            $breadcrumbs_title	= "";
                            $breadcrumbs_array	= array("javascript:void(0);"=>"Mobile Verification");
                            breadCrumbs($breadcrumbs_title,$breadcrumbs_array);
						?>
						<!-- header-->
						<main>
							<section class="fullwidth-background bg-2">
								<div class="grid-row">
									<div class="login-block">
										<div class="logo">
											<h2>Verify mobile number</h2>
										</div>
										<form method="post" class='login-form' id="user_mobile_verification">
											<input type="hidden" id="hid_cust_mobile_num" name="hid_cust_mobile_num" value="<?php echo $cust_mobile_num; ?>" >
											<input type="hidden" id="hid_cust_email" name="hid_cust_email" value="<?php echo $_SESSION['front_panel']['name']; ?>" >
											<input type="hidden" id="hid_cust_mobile_status" name="hid_cust_mobile_status" value="<?php echo $cust_mobile_status; ?>" >
											<div class="form-group">
												A text with your code has been sent to your mobile number : <?php echo '<strong>'.$cust_mobile_num.'</strong>'; ?>
											</div>
                                            
											<div class="form-group" align="center">
                                            	<?php
												
												//if($_SESSION['front_panel']['cust_mobile_status'] != 1)
												//{
												?>
												<div id="getting-started" align="right"></div>
												
												<div id="getting-started1" align="right">
													Trouble receiving Code? <a href="javascript:void(0)" style="color:#35A8CA" onClick="sendVerificationCode_m('<?php echo $_SESSION['front_panel']['name']; ?>','mobile');">Resend Code</a>
												</div>
												<?php
													
												//}
												?>
												<input type="text"  class="form-control tooltipped small" name="cust_mobile_verify" id="cust_mobile_verify" placeholder="Enter Code" minlength="6" maxlength="6" data-rule-required="true" data-toggle="tooltip" data-container="body" st title="Enter your 6 digit mobile verification code here" autocomplete="off">
												<span id="email_label_error_login"></span>
											</div>
											<div align="center">
											<button id="reg_submit_reg" name="reg_submit_reg" type="submit" class="cws-button bt-color-3 border-radius small" style="text-align:centre;" >Verify</button>
										   </div> 
										</form>
									</div>
								</div>
							</section>
						</main>
                        <!-- footer -->
						<?php footerData(); ?>
                        <!-- footer -->
                        
                       	<script src="<?php print $BaseFolder; ?>/js/jquery.countdown.js"></script>
                        
						<script type="text/javascript">
							if(location.hostname == 'localhost' || location.hostname == '127.0.0.1' || location.hostname == '192.168.1.249')
							{
								//var base_url = window.location.origin+"/planeteducate/";	
								var base_url = "http://192.168.1.249/planeteducate_sm/";	
							}
							else
							{
								var base_url = window.location.origin+"/";
							}
							
							$(document).ready(function() {
								$("#cust_mobile_verify").keydown(function (e) {
									// Allow: backspace, delete, tab, escape, enter and .
									if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
										 // Allow: Ctrl+A
										(e.keyCode == 65 && e.ctrlKey === true) ||
										 // Allow: Ctrl+C
										(e.keyCode == 67 && e.ctrlKey === true) ||
										 // Allow: Ctrl+X
										(e.keyCode == 88 && e.ctrlKey === true) ||
										 // Allow: home, end, left, right
										(e.keyCode >= 35 && e.keyCode <= 39)) {
											 // let it happen, don't do anything
											 return;
									}
									// Ensure that it is a number and stop the keypress
									if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
										e.preventDefault();
									}
								});
								
							// start code by prathamesh 12102016 for otp when registration and resend code
							
							var fiveSeconds = "<?php echo $otp_validation; ?>"; 
							
							var counter_1	= 1;
							$('#getting-started').countdown(fiveSeconds, {elapse: true})
							.on('update.countdown', function(event) {
							  var $this = $(this); // if elapsed =
							  
							  if (event.elapsed) { //true
								$('#getting-started').css('display', 'none'); // hide the clock 
								//$('#getting-started1').css('display', 'block');// show the Resend link
								
								if(counter_1 == 1)
								{
									counter_1++;
									var user_email			= "<?php echo $_SESSION['front_panel']['name']; ?>";
									var cust_mobile_number	= "<?php echo $_SESSION['front_panel']['cust_mobile_num']; ?>";
		
									// This ajax call for updating the mobile status of the user to 2 [2 for otp expire]
									var sendInfo		= {"user_email":user_email, "cust_mobile_number":cust_mobile_number, "update_mobile_stauts":1};
									var update_mob_num	= JSON.stringify(sendInfo);
									
									$.ajax({
										url: base_url+"includes/main.php",
										type: "POST",
										data: update_mob_num,
										async:false,						
										contentType: "application/json; charset=utf-8",						
										success: function(response) 
										{
											data = JSON.parse(response);
											if(data.Success == "Success") 
											{
												$('#getting-started1').css('display', 'block');// show the Resend link
												//location.reload();
											} 
											else 
											{	
												loading_hide();
												$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
												$('#error_model').modal({
													backdrop: 'static'
												});
											}
										},
										error: function (request, status, error) 
										{
											loading_hide();
											$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
											$('#error_model').modal({
												backdrop: 'static'
											});										
										},
										complete: function()
										{
										}
									});
								}
								
							  } else { //false
								$(this).text(event.strftime('%H:%M:%S'));// initate the clock	
								$('#getting-started1').css('display', 'none'); // hide the Resend link
								$('#getting-started').css('display', 'block'); // show the clock
							  }
							});
							
							// end code by prathamesh 12102016 for otp resend
								
							});
						</script>
					</body>
				</html>
				<?php
				
			}
			else
			{
				header("Location:/");
				exit(0);	
			}		
		}
		else
		{
			if(isset($_SESSION['front_panel']))
			{
				?>
					<script type="text/javascript">
                        window.location.href = "<?php echo $BaseFolder.'/page-profile';?>";
                    </script>
                <?php	
			}
			else
			{
				$redirect_to 		= "page-profile";
				if(isset($_REQUEST['redirect_to']) && $_REQUEST['redirect_to'] != "")
				{
					$redirect_to 	= mysqli_real_escape_string($db_con,$_REQUEST['redirect_to']);
					if($redirect_to == 1)
					{
						$redirect_to = "page-cart";
					}		
				}	
			}
				
		}
	}
	else
	{
		header("Location:page-login");
		exit(0);	
	}
?>
