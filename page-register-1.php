<?php
include("includes/db_con.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
	$page_title			= "Planet Educate Register";
	$canonical_url		= "https://www.planeteducate.com/page-register";
	$meta_description	= "Planet Educate Register";
	$meta_keywords		= "Planet Educate Register";
	headIncludes($page_title,$canonical_url,$meta_description,$meta_keywords);
	?>
</head>
<body class="">

	
	<main>
		<section class="fullwidth-background bg-2">
			<div class="grid-row">
				<div class="login-block">
					<div class="logo">
						<!--<img src="img/pe_logo.png" data-at2x='img/logo@2x.png' style="max-width:100%;" alt>-->
					<h2>Registration</h2>
                    </div>
					<form class="login-form" novalidate id="user_register" enctype="multipart/form-data">	
                    <input type="hidden"  name="registration" id="registration" value="1"  >					
                        <div class="form-group">                        
							<input type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Your Full Name" data-rule-required="true" >
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div><!-- fullname--> 
						<div class="form-group">
							<input type="email" class="form-control" name="cust_email" id="cust_email" placeholder="Email Address" onBlur="checkEmailUser(this.id,this.value,'register','email_label_error_register')" data-rule-email="true" data-rule-required="true">
							<span class="input-icon">
								<i class="fa fa-envelope"></i>
							</span>
                            <span id="email_label_error_register">
                            </span>
						</div><!-- email-->    
						<div class="form-group">
							<input type="text" class="form-control tooltipped" name="cust_mobile_num" id="cust_mobile_num" placeholder="Mobile Number" onBlur="checkMobileUser(this.id,this.value,'register','mobile_label_error_register');" data-rule-required="true" minlength="10" maxlength="10" data-rule-number="true" data-toggle="tooltip" data-container="body"  title="Enter your 10 digit mobile number without '0'">
							<span class="input-icon">
								<i class="fa fa-mobile"></i>
							</span>
                            <span id="mobile_label_error_register">
                            </span>
   						</div><!-- phone-->
                        <!--<div class="form-group">
    <div class="radio">
        <label>
            <input type="radio" name="underwear" required>
            Boxers
        </label>
    </div>

    <div class="radio">
        <label>
            <input type="radio" name="underwear" required>
            Briefs
        </label>
    </div>
</div>-->
<div class="form-group control-group">
														<div class="radio radio_type controls">
								<input style="height:20px;" id="1_type" value="1" name="cust_type" data-rule-required="true" type="radio">
								<label for="1_type"></label>
								</div>
								<b>Learner</b>
                                								<div class="radio radio_type controls">
								<input style="height:20px;" id="2_type" value="2" name="cust_type" data-rule-required="true" type="radio">
								<label for="2_type"></label>
								</div>
								<b>Parent</b>
                                								<div class="radio radio_type controls">
								<input style="height:20px;" id="3_type" value="3" name="cust_type" data-rule-required="true" type="radio">
								<label for="3_type"></label>
								</div>
								<b>Educator</b>
                                                        </div>
<!---->
						<div class="form-group">
							<input type="file" data-rule-extension="pdf" accept="application/pdf" class="form-control tooltipped" name="file" id="file" placeholder="" title=" Document" data-rule-required="true">
						</div><!-- pdf-->                        
                        <div class="form-group radio" >
                        <input type="radio" id="B_type" value="Buyer" name="cust_type" class="form-control tooltipped" data-rule-required="true">
                        <span for ="B_type">Buyer</span>
                        </div>
                        <div class="form-group radio" style="margin-left:15%">
                        <input type="radio" id="V_type" value="Vendor" name="cust_type" class="form-control tooltipped" data-rule-required="true">
                        <span for ="V_type">Vender / Seller</span>
                        </div>
                        
                        <!--vendor/buyer-->
                       	<p class="large">
							Already a Member ?<a href="page-login.php">  Login here</a>
							</p><!-- Already Member-->  
                        <button id="reg_submit_reg" name="reg_submit_reg" type="submit" class="button-fullwidth cws-button bt-color-3 border-radius" >Register</button>
					</form>
				</div>
			</div>
		</section>
	</main>
	<?php footerData(); ?>
	<!-- scripts -->
	<script src="js/select2.js"></script>
	<!-- scripts -->
 	<?php
	   	if(!isset($_SESSION['front_panel']))
		{
			?>				
    		<script type="text/javascript">
			//	updateState('cust_country_register','cust_state_register');
			</script>
			<?php
		}
	?>
</body>
</html>