<?php
include("includes/db_con.php");
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
	//$redirect_to 		= "page-profile";
	$redirect_to 		= "user-mobile-verify";
	if(isset($_REQUEST['redirect_to']) && $_REQUEST['redirect_to'] != "")
	{
		$redirect_to 	= mysqli_real_escape_string($db_con,$_REQUEST['redirect_to']);
		if($redirect_to == 1)
		{
			$redirect_to = "page-cart";	
		}		
	}	
	?>
	<html>
	<head>
	<?php
		$page_title			= "Register";
		$meta_title			= "Register";
		$meta_description	= "Register";
		$meta_keywords		= "Register";
		headIncludes($page_title,$meta_title,$meta_description,$meta_keywords);	
	?>
    <!-- implemented by punit 10102016-->
    <style type="text/css">
		.radio_type
		{
			margin-left:15%;
		}
		.agreement_type{
		margin-top:15px;
		margin-left:30%;
		}
		.large_type{
		margin-left:35%;
		}
		
		
		@media screen and (max-width: 768px) {
		.radio_type
		{
			margin-left:0%;
		}
		.agreement_type{
		margin-top:15px;
		margin-left:0%;
		}
		.large_type{
		margin-left:0%;
		}
		
		}
    </style>
	<!-- implemented by punit 10102016-->
	</head>
	<body class="">
	<!-- header-->
	  <?php 
	  		headerData(); 
			//$breadcrumbs_title	= "";
			//$breadcrumbs_array	= array("javascript:void(0);"=>"Register");
			//breadCrumbs($breadcrumbs_title,$breadcrumbs_array);	  
	  ?>
	<input type="hidden" id="redirect_to" name="redirect_to" value="<?php echo $redirect_to;?>">      
	<!-- header-->
	<main>
		<section class="fullwidth-background bg-2">
			<div class="grid-row">
				<div class="login-block">
					<div class="logo">
						<!--<img src="img/pe_logo.png" data-at2x='img/logo@2x.png' style="max-width:100%;" alt>-->
					<h2>Registration</h2>
                    </div>
					<form class="login-form form-validate" novalidate id="user_register" >	
                    	
                        
                        <div class="form-group control-group">                      
							<div class="controls">
                            <input type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Your Full Name" data-rule-required="true" autocomplete="off">
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
                            </div>
						</div><!-- fname--> 
                         
						<div class="form-group control-group">
							<div class="controls">
                            <input type="email" class="form-control" name="cust_email" id="cust_email" placeholder="Email Address" onBlur="checkEmailUser(this.id,this.value,'register','email_label_error_register')" data-rule-email="true" data-rule-required="true" autocomplete="off">
                           <span class="input-icon">
								<i class="fa fa-envelope"></i>
							</span>
                            <span id="email_label_error_register">
                            </span>
                            </div>
						</div><!-- email-->  
                          
						<div class="form-group control-group">
							<div class="controls">
                            <input type="text" class="form-control tooltipped" name="cust_mobile_num" id="cust_mobile_num" placeholder="Mobile Number" onBlur="checkMobileUser(this.id,this.value,'register','mobile_label_error_register');" data-rule-required="true" minlength="10" maxlength="10" data-rule-number="true" data-toggle="tooltip" data-container="body"  title="Enter your 10 digit mobile number without '0'" autocomplete="off">
                           <span class="input-icon">
								<i class="fa fa-mobile"></i>
							</span>
                            <span id="mobile_label_error_register">
                            </span>
                            </div>
   						</div><!-- phone-->
                        
                        <div class="form-group control-group">
                       		 <div class="controls">
							<input type="file" data-rule-extension="pdf" accept="application/pdf" class="form-control tooltipped" name="file" id="file" placeholder="" title=" Document" data-rule-required="true">
                             </div>
						</div>
                        
                        <div class="form-group control-group">
                        
                       <div class="radio radio_type controls">
								<input style="height:20px;" type="radio" id="buyer_type" value="buyer_type" name="cust_type" data-rule-required="true" >
                                <label for ="buyer_type"></label>
                        </div>
                        <b>Buyer</b>
                        
                        <div class="radio radio_type controls">
								<input style="height:20px;" type="radio" id="vendor_type" value="vendor_type" name="cust_type" data-rule-required="true" >
                                <label for ="vendor_type"></label>
                        </div>
                        <b>Vendor/Seller</b>
						
                        </div>
                        <div class="agreement agreement_type control-group" >
                        	<div class="checkbox controls" style="margin-top:0 !important;padding:0px !important">
								<input  type="checkbox" id="Agreement" value="Agreement" name="Agreement" data-rule-required="true" class="category_parent" >
								<label for="Agreement"></label>
                         	</div>
                        	<b style="font-size:13px;">I agree to the <a href="<?php print $BaseFolder; ?>/pages/4/">Terms and Conditions !</a></b>
                     	</div><!-- Agreement Checkbox-->
                       
                       	<!--<p class="large" style="margin-left:35%">
							Already a Member ?<a href="page-login.php"> Login here</a>
						</p>--><!-- Already Member-->
                        <p class="large large_type" >
							Already a Member ?<a href="<?php print $BaseFolder; ?>/page-login"> Login here</a>
						</p>
						
                        <button id="reg_submit_reg_guest" name="reg_submit_reg_guest" type="submit" class="button-fullwidth cws-button bt-color-3 border-radius" >Register</button>
					</form>
                    
				</div>
			</div>
		</section>
	</main>
	<!-- footer -->
	<?php footerData(); ?>
	<!-- footer -->
	<!-- scripts -->
	<script src="js/select2.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
			$("#cust_mobile_num_register").keydown(function (e) {
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
		});
    </script>
	<!-- scripts --> 	
	</body>
	</html>    
    <?php
}
?>
