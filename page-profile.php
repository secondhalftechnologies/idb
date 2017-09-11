<?php
	include("includes/db_con.php");
   	
	if(!isset($_SESSION['front_panel']))
	{
		header("Location:".$BaseFolder."/page-login");
	}
	
	include("includes/city-state-country-helper.php");
	include('includes/query-helper.php');
	// ============================================================================
	// START : Hard Coding For testing the session Session not yet defined 
	// Dn By Prathamesh on 01 Aug 2017
	// ============================================================================
	
	$logged_user_type	= $_SESSION['front_panel']['cust_type'];
	$logged_uid			= $_SESSION['front_panel']['cust_id'];
	$logged_username	= $_SESSION['front_panel']['cust_name'];
	$logged_emailid		= $_SESSION['front_panel']['cust_email'];
	$logged_mobilenum	= $_SESSION['front_panel']['cust_mobile'];
	
	// ==============================================================================================================================
	// START : getting the Company Data from the tbl_customer_company table depending on the user_id [dn by Prathamesh on 06 Sep 2017]
	// ==============================================================================================================================
	// Query for Getting all the information of the company for respective user-id
	$sql_get_comp_info	= " SELECT * FROM `tbl_customer_company` WHERE `comp_user_id`='".$logged_uid."' ";
	$res_get_comp_info	= mysqli_query($db_con, $sql_get_comp_info) or die(mysqli_error($db_con));
	$num_get_comp_info	= mysqli_num_rows($res_get_comp_info);
	
	$comp_name			= '';
	$comp_pri_email		= '';
	$comp_sec_email		= '';
	$comp_pri_phone		= '';
	$comp_sec_phone		= '';
	$comp_website		= '';
	$comp_bill_address	= '';
	$comp_bill_state	= '';
	$comp_bill_city		= '';
	$comp_bill_pincode	= '';
	$comp_ship_address	= '';
	$comp_ship_state	= '';
	$comp_ship_city		= '';
	$comp_ship_pincode	= '';
	$comp_descp			= '';
	
	if($num_get_comp_info != 0)
	{
		$row_get_comp_info	= mysqli_fetch_array($res_get_comp_info);
		$comp_name			= $row_get_comp_info['comp_name'];
		$comp_pri_email		= $row_get_comp_info['comp_pri_email'];
		$comp_sec_email		= $row_get_comp_info['comp_sec_email'];
		$comp_pri_phone		= $row_get_comp_info['comp_pri_phone'];
		$comp_sec_phone		= $row_get_comp_info['comp_sec_phone'];
		$comp_website		= $row_get_comp_info['comp_website'];
		$comp_bill_address	= $row_get_comp_info['comp_bill_address'];
		$comp_bill_state	= $row_get_comp_info['comp_bill_state'];
		$comp_bill_city		= $row_get_comp_info['comp_bill_city'];
		$comp_bill_pincode	= $row_get_comp_info['comp_bill_pincode'];
		$comp_ship_address	= $row_get_comp_info['comp_ship_address'];
		$comp_ship_state	= $row_get_comp_info['comp_ship_state'];
		$comp_ship_city		= $row_get_comp_info['comp_ship_city'];
		$comp_ship_pincode	= $row_get_comp_info['comp_ship_pincode'];
		$comp_descp			= $row_get_comp_info['comp_descp'];
	}
	// ==============================================================================================================================
	// END : getting the Company Data from the tbl_customer_company table depending on the user_id [dn by Prathamesh on 06 Sep 2017]
	// ==============================================================================================================================
	
	$org_details      	= '';
	
	if($logged_user_type == 'doctors')
	{
		$contact_persone  = 'Doctor\'s';
		$org_menu_title   = 'Clinic';
		$org_details      = 'Clinic';
		$var_urDoc        = 'Doctor Practice';
	}
	elseif ($logged_user_type == 'hospitals') 
	{
		$contact_persone  = 'Hospital\'s';
		$org_menu_title   = 'Hospital';
		$org_details      = 'Hospital';
		$var_urDoc        = 'Hospital';
		$var_urDoc1       = 'Renewal 1';
		$var_urDoc2       = 'Renewal 2';
	}
	elseif ($logged_user_type == 'chemist')
	{
		$contact_persone  = 'Chemist\'s';
		$org_menu_title   = 'Chemist';
		$org_details      = 'Chemist';
		$var_urDoc        = '20 B';
		$var_urDoc1       = '21 B';
		$var_urDoc2       = '21 C';
	}
	else
	{
		$contact_persone  = 'Contact Persone\'s';
		$org_menu_title   = 'Company';
		$org_details      = 'Company';
		$var_urDoc        = '20 B';
		$var_urDoc1       = '21 B';
		$var_urDoc2       = '21 C';
	}
	
	// ============================================================================
	// END : Hard Coding For testing the session Session not yet defined 
	// Dn By Prathamesh on 01 Aug 2017
	// ============================================================================

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

        <title>Register - Indian Dava Bazar</title>

		<?php include('st-head.php'); ?>
        <?php include('st-validator-css.php'); ?>
    	<link href="assets/css/bootstrap-select.min.css" rel="stylesheet" title="selectbox">
		<style type="text/css">
			.cls_mainmenu
			{
			display: none;
			}
			
			.active
			{
			display: block;
			}
			.wrapper-smenu {
			margin: 0 auto;
			background: #fff;
			border-radius: 4px;
			position: relative;
			box-shadow: 0px 2px rgba(0, 0, 0, 0.12);
			}
			.wrapper-smenu label {
			display: block;
			position: relative;
			color: #b5abab;
			overflow: hidden;
			cursor: pointer;
			height: 56px;
			-webkit-transition: text-indent 0.2s;
			text-indent: 20px;
			padding-top: 1px;
			margin-bottom:0px;
			}
			.wrapper-smenu ul {
			margin: 0;
			padding: 0;
			}
			.wrapper-smenu li {
			color: white;
			list-style-type: none;
			}
			.wrapper-smenu li a {
			display: block;
			width: 100%;
			padding: 15px 0px;
			text-decoration: none;
			color: white;
			border-bottom: 1px solid rgba(0, 0, 0, 0.06);
			}
			.wrapper-smenu li a:hover {
			background-color: rgba(0, 0, 0, 0.06);
			}
			.wrapper-smenu label:hover {
			background: rgba(203, 228, 205, 0.6) !important;
			color: #4f7351;
			text-indent: 30px;
			-webkit-transition: text-indent 0.2s;
			transition: text-indent 0.2s;
			}
			.wrapper-smenu input[type="checkbox"] {
			display: none;
			}
			.wrapper-smenu span {
			height: 3px;
			position: absolute;
			width: 0px;
			display: block;
			top: 58px;
			background: #38B087;
			}
			.wrapper-smenu .content {
			height: 0;
			background: rgba(92, 127, 94, 0.72);
			height: 400px;
			position: relative;
			border-top: 2px solid rgba(0, 0, 0, 0.12);
			top: 4px;
			}
			.wrapper-smenu .lil_arrow {
			width: 5px;
			height: 5px;
			-webkit-transition: transform 0.8s;
			-webkit-transition: -webkit-transform 0.8s;
			transition: -webkit-transform 0.8s;
			transition: transform 0.8s;
			transition: transform 0.8s, -webkit-transform 0.8s;
			-webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
			border-top: 2px solid rgba(0, 0, 0, 0.33);
			border-right: 2px solid rgba(0, 0, 0, 0.33);
			float: right;
			position: relative;
			top: -30px;
			right: 27px;
			-webkit-transform: rotate(45deg);
					transform: rotate(45deg);
			}
			.wrapper-smenu input[type="checkbox"]:checked + label > .content {
			display: block;
			}
			.wrapper-smenu input[type="checkbox"]:checked + label > span {
			display: none;
			}
			.wrapper-smenu input[type="checkbox"]:checked + label > .lil_arrow {
			-webkit-transition: transform 0.8s;
			-webkit-transition: -webkit-transform 0.8s;
			transition: -webkit-transform 0.8s;
			transition: transform 0.8s;
			transition: transform 0.8s, -webkit-transform 0.8s;
			-webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
			-webkit-transform: rotate(135deg);
					transform: rotate(135deg);
			}
			.wrapper-smenu input[type="checkbox"]:checked + label {
			display: block;
			background: rgba(203, 228, 205, 0.6) !important;
			color: #4f7351;
			text-indent: 30px;
			height: auto;
			-webkit-transition: height 0.8s;
			transition: height 0.8s;
			-webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
			}
			.wrapper-smenu label:hover > span {
			width: 100%;
			-webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
			-webkit-transition: width 0.4s;
			transition: width 0.4s;
			}
			.wrapper-smenu input[type='checkbox']:not(:checked) + label {
			display: block;
			-webkit-transition: height 0.8s;
			transition: height 0.8s;
			height: 55px;
			-webkit-transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
			}
			
			::-webkit-scrollbar {
			display: none;
			}
			.update_success{
				background:#6C6; 
				max-height:50px; 
				height:50px; 
				border-radius:10px; 
				color:#fff; 
				font-family:'Courier New', Courier, monospace; 
				font-size:20px; 
				font-weight:600;
				text-align:center;
				padding:10px;
			}
			
    	</style>
	</head>

	<body>
		<div class="wrapper">
			<?php  include('st-header.php'); ?>
			<?php  include('st-breadcrumb.php'); ?>
			<main id="userprofile" class="inner-bottom-md">
            	<div class="container">
					<div class="row">
            			<div class="col-md-12" >
        					<div class="col-md-3">
                                <div class='wrapper-smenu'>
                                    <input id='pictures' type='checkbox'>
                                    <label for='pictures'>
                                        <p>My Account</p>
                                        <div class='lil_arrow'></div>
                                        <div class='content'>
                                            <ul>
                                                <li>
                                                	<a  href="javascript:void(0);" onclick="showDiv('profile');">Login Information</a>
                                                </li>
                                                <li>
                                                	<a  href="javascript:void(0);" onclick="showDiv('comp_info');">
														<?php echo $org_menu_title; ?> Information
                                                    </a>
                                                </li>
                                                <li>
                                                	<a  href="javascript:void(0);" onclick="showDiv('urDoc');"> Upload Required Documents </a>
                                                </li>
                                                <li>
                                                	<a href="javascript:void(0);" onclick="showDiv('pan_info');"> PAN Information </a>
                                                </li>
                                                <li>
                                                	<a href="javascript:void(0);" onclick="showDiv('gst_info');"> GST Information </a>
                                                </li>
                                                <li>
                                                	<a href="javascript:void(0);" onclick="showDiv('bank_info');"> Bank Information </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <span></span>
                                  </label>
                                    <input id='jobs' type='checkbox'>
                                    <label for='jobs'>
                                    <p>Upcoming Jobs</p>
                                    <div class='lil_arrow'></div>
                                    <div class='content'>
                                    <ul>
                                    <li>
                                    <a href='#'>Weekly Forecast</a>
                                    </li>
                                    <li>
                                    <a href='#'>Timescales</a>
                                    </li>
                                    <li>
                                    <a href='#'>Quotes</a>
                                    </li>
                                    </ul>
                                    </div>
                                    <span></span>
                                    </label>
                                    <input id='events' type='checkbox'>
                                    <label for='events'>
                                    <p>Events & Task Management</p>
                                    <div class='lil_arrow'></div>
                                    <div class='content'>
                                    <ul>
                                    <li>
                                      <a href='#'>Calendar</a>
                                    </li>
                                    <li>
                                      <a href='#'>Important Dates</a>
                                    </li>
                                    <li>
                                      <a href='#'>Someting Event related</a>
                                    </li>
                                    </ul>
                                    </div>
                                    <span></span>
                                    </label>
                                    <input id='financial' type='checkbox'>
                                    <label for='financial'>
                                    <p>Invoicing & financial</p>
                                    <div class='lil_arrow'></div>
                                    <div class='content'>
                                    <ul>
                                    <li>
                                      <a href='#'>Invoicing Templates</a>
                                    </li>
                                    <li>
                                      <a href='#'>Invoice Archives</a>
                                    </li>
                                    <li>
                                      <a href='#'>Send Invoice</a>
                                    </li>
                                    </ul>
                                    </div>
                                    <span></span>
                                    </label>
                                    <input id='settings' type='checkbox'>
                                    <label for='settings'>
                                    <p>System Settings</p>
                                    <div class='lil_arrow'></div>
                                    <div class='content'>
                                    <ul>
                                    <li>
                                      <a href='#'>User Settings</a>
                                    </li>
                                    <li>
                                      <a href='#'>Edit Profile</a>
                                    </li>
                                    <li>
                                      <a href='#'>Do something cool</a>
                                    </li>
                                    </ul>
                                    </div>
                                    <span></span>
                                    </label>
                                </div>
        		  			</div>
        					<div class="col-md-9">
                				<div id="div_success" class="col-md-12" style="height:50px;" >
                                    &nbsp;
                                </div>
                               
                                <div class="clearfix"></div>
                            	<div class="cls_mainmenu active" id="profile">
                                    Login Information
                                    <form role="form" class="register-form cf-style-1" id="frm_profile" name="frm_profile">
                                    	<input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $logged_uid; ?>">
                                        <input type="hidden" name="hid_frm_profile" id="hid_frm_profile" value="1">
                                        
                                        <div class="field-row">
                                            <label class="col-md-3 col-xs-12" for="name"><?php echo $contact_persone; ?> Name<span style="color:#F00">*</span></label>
                                            <input type="text" class="le-input col-md-9 col-xs-12" id="txt_name" name="txt_name" 
											<?php 
												if($logged_username != '')
												{
													?>
													value="<?php echo ucwords($logged_username); ?>"
													<?php
												}
												else
												{
													?>
													placeholder="Ex. Jhon Deo"
													<?php
												}
											?> 
                                            data-rule-required="true" >
                                            <div class="clearfix"></div>
                                        </div><!-- Contact Persone's Name -->
                                        
                                        <div class="field-row">
                                            <label class="col-md-3 col-xs-12" for="name">Email<span style="color:#F00">*</span></label>
                                            <input type="text" class="le-input col-md-9 col-xs-12" id="txt_email" name="txt_email"
                                            <?php
                                            if($logged_emailid != '')
											{
												?>
												value="<?php echo $logged_emailid; ?>"
												<?php
											}
											else
											{
												?>
												placeholder="Ex. email@something.com";
												<?php
											}
											?>
                                            data-rule-required="true" data-rule-email="true">
                                            <div class="clearfix"></div>
                                        </div><!-- Email -->
                                        
                                        <div class="field-row">
                                            <label class="col-md-3 col-xs-12" for="name">Mobile<span style="color:#F00">*</span></label>
                                            <input type="text" class="le-input col-md-9 col-xs-12" id="txt_mobile" name="txt_mobile"
                                            <?php
                                            	if($logged_mobilenum != '')
												{
													?>
													value="<?php echo $logged_mobilenum; ?>"
													<?php	
												}
												else
												{
													?>
													placeholder="Ex. 1234567890";
													<?php
												}
											?>
                                            data-rule-required="true" data-rule-number="true" maxlength="10" size="10">
                                            <div class="clearfix"></div>
                                        </div><!-- Mobile -->                    
                                        
                                        <div class="buttons-holder">
                                        	<button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >
                                            	Update
                                            </button>
                                        </div><!-- Submit -->
                                    </form>
                				</div>	<!--Basic Information-->
                                <div class="cls_mainmenu" id="comp_info">
                                  Company Details
                                  <form role="form" class="register-form cf-style-1" id="frm_comp_info" name="frm_comp_info">
                                    <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $logged_uid; ?>">
                                    <input type="hidden" name="hid_frm_comp_info" id="hid_frm_comp_info" value="1">
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"><?php echo $org_details ?> Name<span style="color:#F00">*</span></label>
                                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_comp_name" name="txt_comp_name" data-rule-required="true" 
										<?php
                                        if($comp_name != '')
										{
											?>
											value="<?php echo ucwords($comp_name); ?>"
											<?php	
										}	
										else
										{
											?>
											placeholder="Ex. ABC Pvt. Ltd."
											<?php	
										}
										?>                                   
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Company Name -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Primary Email<span style="color:#F00">*</span></label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_pri_email" name="txt_pri_email" data-rule-required="true" data-rule-email="true"
                                      	<?php
										if($logged_emailid != '')
										{
											?>
											value="<?php echo $logged_emailid; ?>"
											<?php
										}
										else
										{
											?>
											placeholder="Ex. email@something.com";
											<?php
										}
										?>
                                      >
                                      <label class="col-md-3 col-xs-12" for="name">Secondary Email</label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_sec_email" name="txt_sec_email" data-rule-email="true"
                                     	<?php
										if($comp_sec_email != '')
										{
											?>
											value="<?php echo $comp_sec_email; ?>"
											<?php										  
										}
										else
										{
											?>
											placeholder="Ex. email@something.com"
											<?php	
										}
									  	?> 
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Primary and Secondary Email -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Primary Phone Number<span style="color:#F00">*</span></label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_pri_phone" name="txt_pri_phone" data-rule-required="true" data-rule-number="true" maxlength="10" size="10"
                                      	<?php
											if($logged_mobilenum != '')
											{
												?>
												value="<?php echo $logged_mobilenum; ?>"
												<?php	
											}
											else
											{
												?>
												placeholder="Ex. 1234567890";
												<?php
											}
										?>
                                      >
                                      <label class="col-md-3 col-xs-12" for="name">Alternate Phone Number</label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_alt_phone" name="txt_alt_phone" data-rule-number="true" maxlength="10" size="10"
                                      	<?php
										if($comp_sec_phone != '')
										{
											?>
											value="<?php echo $comp_sec_phone; ?>"
											<?php										  
										}
										else
										{
											?>
											placeholder="Ex. 1234567890"
											<?php	
										}
									  	?>
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Primary and Secondary Phone Number -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Website</label>
                                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_website" name="txt_website"
                                      	<?php
										if($comp_website != '')
										{
											?>
											value="<?php echo $comp_website; ?>"
											<?php										  
										}
										else
										{
											?>
											placeholder="Ex. www.something.com"
											<?php	
										}
									  	?>
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Website -->
                
                                    Address Details
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Billing Address<span style="color:#F00">*</span></label>
                                      <textarea class="le-input col-md-9 col-xs-12" id="txt_billing_address" name="txt_billing_address" data-rule-required="true"><?php
										if($comp_bill_address != '')
										{
											echo $comp_bill_address;
										}
										?></textarea>
                                      <div class="clearfix"></div>
                                    </div><!-- Billing Address -->
                
                                    <div class="field-row">
                                      <label class="col-md-3  col-xs-12">Billing State<span style="color:#F00">*</span></label>
                                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_bill_state" id="txt_bill_state" onChange="getCities(this.value, this.id, 'txt_bill_city');" data-rule-required="true">
                                        <?php
                                        // =======================================================
                                        // start : query for getting the all active states only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        // send city id from session if state id is already exist in the database
                                        echo getActiveStates($comp_bill_state);
                                        // =======================================================
                                        // end : query for getting the all active state only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        ?>
                                      </select>
                                      <div class="clearfix"></div>
                                    </div><!-- Billing State -->
                
                                    <div class="field-row">
                                      <label class="col-md-3  col-xs-12">Billing City<span style="color:#F00">*</span></label>
                                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_bill_city" id="txt_bill_city" data-rule-required="true">
                                        <?php
                                        // =======================================================
                                        // start : query for getting the all active cities only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        // send city id from session if city id is already exist in the database
                                        echo getActiveCities($comp_bill_city);
                                        // =======================================================
                                        // end : query for getting the all active cities only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        ?>
                                      </select>
                                    </div><!-- Billing City -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Billing Pincode<span style="color:#F00">*</span></label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_bill_pincode" name="txt_bill_pincode" data-rule-required="true" data-rule-number="true" maxlength="6" size="6" 
                                      	<?php
										if($comp_bill_pincode != '')
										{
											?>
											value="<?php echo $comp_bill_pincode; ?>"
											<?php										  
										}
										else
										{
											?>
											placeholder="6 Digit Pincode"
											<?php	
										}
									  	?>
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Billing Pincode -->
                
                                    <div style="margin-left:1%;">
                                      <input id="address_check" name="address_check" onclick="same_as_bill();" class="css-checkbox" value="CHK" type="checkbox">
                                      <label for="address_check" class="css-label" style="margin:12px;font-size:15px;">Same As Billing Details</label>
                                      <div class="clearfix"></div>
                                    </div>
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Shipping Address<span style="color:#F00">*</span></label>
                                      <textarea class="le-input col-md-9 col-xs-12" id="txt_shipping_address" name="txt_shipping_address" data-rule-required="true"><?php
										if($comp_ship_address != '')
										{
											echo $comp_ship_address;
										}
										?></textarea>
                                      <div class="clearfix"></div>
                                    </div><!-- Shipping Address -->
                
                                    <div class="field-row">
                                      <label class="col-md-3  col-xs-12">Shipping State<span style="color:#F00">*</span></label>
                                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_shipping_state" id="txt_shipping_state" data-rule-required="true">
                                        <?php
                                        // =======================================================
                                        // start : query for getting the all active states only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        // send city id from session if state id is already exist in the database
                                        echo getActiveStates($comp_ship_state);
                                        // =======================================================
                                        // end : query for getting the all active state only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        ?>
                                      </select>
                                      <div class="clearfix"></div>
                                    </div><!-- Shipping State -->
                
                                    <div class="field-row">
                                      <label class="col-md-3  col-xs-12">Shipping City<span style="color:#F00">*</span></label>
                                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_shipping_city" id="txt_shipping_city" data-rule-required="true">
                                        <?php
                                        // =======================================================
                                        // start : query for getting the all active cities only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        // send city id from session if city id is already exist in the database
                                        echo getActiveCities($comp_ship_city);
                                        // =======================================================
                                        // end : query for getting the all active cities only
                                        // dn by prathamesh on 04092017
                                        // =======================================================
                                        ?>
                                      </select>
                                    </div><!-- Shipping City -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Shipping Pincode<span style="color:#F00">*</span></label>
                                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_shipping_pincode" name="txt_shipping_pincode" data-rule-required="true" data-rule-number="true" maxlength="6" size="6" 
                                      	<?php
										if($comp_ship_pincode != '')
										{
											?>
											value="<?php echo $comp_ship_pincode; ?>"
											<?php										  
										}
										else
										{
											?>
											placeholder="6 Digit Pincode"
											<?php	
										}
									  	?>
                                      >
                                      <div class="clearfix"></div>
                                    </div><!-- Shipping Pincode -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Description<span style="color:#F00">*</span></label>
                                      <textarea class="le-input col-md-9 col-xs-12" id="txt_description" name="txt_description" data-rule-required="true"></textarea>
                                      <div class="clearfix"></div>
                                    </div><!-- Description -->
                
                                    <div class="buttons-holder">
                                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                                    </div><!-- Submit -->
                                  </form>
                                </div>	<!--Company Details-->
                                <div class="cls_mainmenu" id="urDoc">
                                  Upload Required Documents
                                 
                                    <?php
                                    if($logged_user_type == 'doctors')
                                    {
                                      
								  //  Check Record and return single row
								  $licRow = checkExist('tbl_doctor_license',array('lic_userid'=>$logged_uid));
								  if(!$licRow) // for add and update in single form 
								  {
									  $frm_lic_name      = 'frm_lic_info';
									  $frm_lic_request   = 'add_doctor_lic_req';
									  $required          = 'data-rule-required="true"';
								  }
								  else
								  {
									  $frm_lic_name      = 'frm_lic_info';
									  $frm_lic_request   = 'update_doctor_lic_req';
									  $required          = '';
								  }
								  ?>     
                               <form role="form" class="register-form cf-style-1" id="<?php echo $frm_lic_name; ?>" name="<?php echo $frm_lic_name; ?>" enctype="multipart/form-data" method="post">
                                  <input type="hidden" name="<?php echo $frm_lic_request; ?>" value="1">
                                  <input type="hidden" name="hid_userid" id="hid_userid" value="">
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">License Number</label>
                                      <input type="text" value="<?php echo $licRow['lic_number']; ?>" class="le-input col-md-9 col-xs-12" id="txt_lic_no" name="txt_lic_no" data-rule-required="true" data-rule-number="true" minlength="12" maxlength="12" size="12" >
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo $licRow['lic_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 
									 ?>
                                    
                                    <div class="field-row">
                                    
                                      <label class="col-md-3 col-xs-12" for="name">License Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg" type="file" name="file_lic_image" id="file_lic_image" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                
                                   <?php
                                    }
                                    elseif ($logged_user_type == 'hospitals') 
                                    {
                                      ?>
                                      <?php
									  //  Check Record and return single row
								  $licRow = checkExist('tbl_hospital_license',array('lic_userid'=>$logged_uid));
								  if(!$licRow) // for add and update in single form 
								  {
									  $frm_lic_name      = 'frm_lic_info';
									  $frm_lic_request   = 'add_hospital_lic_req';
									  $required          = 'data-rule-required="true"';
								  }
								  else
								  {
									  $frm_lic_name      = 'frm_lic_info';
									  $frm_lic_request   = 'update_hospital_lic_req';
									  $required          = '';
								  }
								  ?>     
                               <form role="form" class="register-form cf-style-1" id="<?php echo $frm_lic_name; ?>" name="<?php echo $frm_lic_name; ?>" enctype="multipart/form-data" method="post">
                                  <input type="hidden" name="<?php echo $frm_lic_request; ?>" value="1">
                                  <input type="hidden" name="hid_userid" id="hid_userid" value="">
                                  <!--=========================Start : Hospital License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Hospital License Number</label>
                                      <input type="text" value="<?php echo @$licRow['lic_number_hospital']; ?>" class="le-input col-md-9 col-xs-12" id="txt_hospital_lic_no" name="txt_hospital_lic_no" data-rule-required="true" data-rule-number="true" minlength="12" maxlength="12" size="12">
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo @$licRow['lic_hospital_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">License Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg" type="file" name="file_lic_image" id="file_lic_image" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    
                                    <div class="field-row">
                                    
                                      <label class="col-md-3 col-xs-12" for="name">License Expiry Date</label>
                                      <input valuw="<?php echo @$lic_hospital_expdate; ?>" type="text" class="le-input col-md-9 col-xs-12" name="lic_hospital_date" id="lic_hospital_date" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End Hospital License Number===================================-->
                               
                               <!--=========================Start : Renewal 1 License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 1 License Number</label>
                                      <input type="text" value="<?php echo $licRow['lic_number_renewal1']; ?>" class="le-input col-md-9 col-xs-12" id="txt_renewal1_lic_no" name="txt_renewal1_lic_no" data-rule-required="true" data-rule-number="true" minlength="12" maxlength="12" size="12">
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo $licRow['lic_renewal1_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 1 Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg" type="file" name="file_renewal1_image" id="file_renewal1_image" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    
                                    <div class="field-row">
                                    
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 1 Expiry Date</label>
                                      <input value="<?php echo @$licRow['lic_renewal1_expdate']; ?>" type="text" class="le-input col-md-9 col-xs-12" name="lic_renewal1_date" id="lic_renewal1_date" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End : Renewal 1 License Number===================================-->
                				
                               <!--=========================Start : Renewal 2 License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 2 License Number</label>
                                      <input type="text" value="<?php echo @$licRow['lic_number_renewal2']; ?>" class="le-input col-md-9 col-xs-12" id="txt_renewal2_lic_no" name="txt_renewal2_lic_no" data-rule-required="true" data-rule-number="true" minlength="12" maxlength="12" size="12" >
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo $licRow['lic_renewal2_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 2 Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg" type="file" name="file_renewal2_image" id="file_renewal2_image" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    
                                    <div class="field-row">
                                    
                                      <label class="col-md-3 col-xs-12" for="name">Renewal 2 Expiry Date</label>
                                      <input value="<?php echo @$licRow['lic_renewal2_expdate']; ?>" type="text" class="le-input col-md-9 col-xs-12" name="lic_renewal2_date" id="lic_renewal2_date" data-rule-requied="true" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End : Renewal 2 License Number===================================-->
                                      <?php
                                    }
                                    elseif ($logged_user_type == 'chemist' || $logged_user_type == 'trader') 
                                    {
                                      ?>
                						 <?php
									  //  Check Record and return single row
								  $licRow = checkExist('tbl_chemist_license',array('lic_userid'=>$logged_uid));
								  if(!$licRow) // for add and update in single form 
								  {
									  $frm_lic_name      = 'frm_chemist_lic_info';
									  $frm_lic_request   = 'add_chemist_lic_req';
									  $required          = 'data-rule-required="true"';
								  }
								  else
								  {
									  $frm_lic_name      = 'frm_update_chemist_lic_info';
									  $frm_lic_request   = 'update_chemist_lic_req';
									  $required          = '';
								  }
								  ?>     
                               <form role="form" class="register-form cf-style-1" id="<?php echo $frm_lic_name; ?>" name="<?php echo $frm_lic_name; ?>" enctype="multipart/form-data" method="post">
                                  <input type="hidden" name="<?php echo $frm_lic_request; ?>" value="1">
                                  <input type="hidden" name="hid_userid" id="hid_userid" value="">
                                  <!--=========================Start : 20B License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">20B Licence Number</label>
                                      <input type="text" value="<?php echo @$licRow['lic_20B_number']; ?>" class="le-input col-md-9 col-xs-12" id="txt_20b_lic_no" name="txt_20b_lic_no" minlength="12" maxlength="12" size="12" >
                                  
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo @$licRow['lic_20B_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">20B Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg,appication/pdf" type="file" name="file_lic_20b_image" id="file_lic_20b_image"  >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End 20B License Number===================================-->
                               
                               <!--=========================Start : 20B License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">21B Licence Number</label>
                                      <input type="text" value="<?php echo @$licRow['lic_21B_number']; ?>" class="le-input col-md-9 col-xs-12" id="txt_21b_lic_no" name="txt_21b_lic_no" minlength="12" maxlength="12" size="12" >
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo @$licRow['lic_21B_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">21B Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg,appication/pdf" type="file" name="file_lic_21b_image" id="file_lic_21b_image" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End 21B License Number===================================-->
                				
                               <!--=========================Start : 21L License Number===================================-->
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">20C Licence Number</label>
                                      <input type="text" value="<?php echo @$licRow['lic_21C_number']; ?>" class="le-input col-md-9 col-xs-12" id="txt_21c_lic_no" name="txt_21c_lic_no"  minlength="12" maxlength="12" size="12" >
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- License Number -->
                                    
                                   <?php
									 if($licRow && $licRow['lic_21C_image']!="")
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/licenses/<?php echo @$licRow['lic_21C_image']; ?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">20C Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg,appication/pdf" type="file" name="file_lic_21c_image" id="file_lic_21c_image" >
                                      <div class="clearfix"></div>
                                    </div><!-- License Image -->
                               <!--=========================End 21L License Number===================================-->
                                      <?php
                                    }
                                    ?>
                                    
                                    
                                    <div class="buttons-holder">
                                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                                    </div><!-- Submit -->
                                  </form>
                                  
                                </div>	<!--Upload Required Documents-->
                                
                                
                               	<!--=======================Start : Pan Information Dn By Satish 06092017=============================================-->
                                
                                <div class="cls_mainmenu" id="pan_info">
                                  PAN Information
                                  <?php
								  
								  //  Check Record and return single row
								  $panRow = checkExist('tbl_customer_pan',array('pan_userid'=>$logged_uid));
								  if(!$panRow) // for add and update in single form 
								  {
									  $frm_pan_name      = 'frm_pan_info';
									  $frm_pan_request   = 'add_pan_req';
									  $required          = 'data-rule-required="true"';
								  }
								  else
								  {
									  $frm_pan_name      = 'frm_update_pan_info';
									  $frm_pan_request   = 'update_pan_req';
									  $required          = '';
								  }
								  ?>
                                  
                                  <form role="form" class="register-form cf-style-1" id="<?php echo $frm_pan_name; ?>" name="<?php echo $frm_pan_name; ?>" enctype="multipart/form-data" method="post">
                                  <input type="hidden" name="<?php echo $frm_pan_request; ?>" value="1">
                                  <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $logged_uid; ?>">
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Pan Number</label>
                                      <input type="text" value="<?php echo @$panRow['pan_no']; ?>" class="le-input col-md-9 col-xs-12" id="txt_pan_no" name="txt_pan_no" data-rule-required="true" minlength="10" maxlength="10" size="10">
                                      
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Number -->
                                    
                                   
									
                                     <?php
									 if($panRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/pan/<?php echo $panRow['pan_image'];?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                    
                                      <label class="col-md-3 col-xs-12" for="name">Pan Image</label>
                                      <input accept="image/jpeg,image/png,image/jpg" type="file" name="file_pan_image" id="file_pan_image" data-rule-requied="true" <?php echo $required;?>>
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Image -->
                
                                    <div class="buttons-holder">
                                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                                    </div><!-- Submit -->
                                  </form>
                                 
									  
                                </div>	<!--PAN Information-->
                                
                               <!--=======================End : Pan Information Dn By Satish 06092017=============================================-->
                               
                               	<!--=======================Start : GST Information Dn By Satish 06092017=============================================-->
                                
                                <div class="cls_mainmenu" id="gst_info">
                                  GST Information
                                  <?php
								   //  Check Record and return single row
								  $gstRow = checkExist('tbl_customer_gst',array('gst_userid'=>$logged_uid));
								  if(!$gstRow)// for add and update in single form 
								  {
									  $frm_gst_name      = 'frm_gst_info';
									  $frm_gst_request   = 'add_gst_req';
									  $required          ='data-rule-required="true"';
								  }
								  else
								  {
									  $frm_gst_name      = 'frm_update_gst_info';
									  $frm_gst_request   = 'update_gst_req';
									  $required          ="";
								  }
								  ?>
                                  <form role="form" class="register-form cf-style-1" id="<?php echo $frm_gst_name; ?>" name="<?php echo $frm_gst_name;?>" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="<?php echo $frm_gst_request; ?>" value="1">
                                    <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $logged_uid; ?>">
                                   
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">GST Number</label>
                                      <input type="text" value="<?php echo @$gstRow['gst_no']; ?>" class="le-input col-md-9 col-xs-12" id="txt_gst_no" name="txt_gst_no" data-rule-requied="true" maxlength="15" size="15">
                                      <div class="clearfix"></div>
                                    </div><!-- GST Number -->                    
                
                					 <?php
									 if($gstRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/gst/<?php echo $gstRow['gst_image'];?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">GST Image</label>
                                      <input type="file" accept="image/jpeg,image/png,image/jpg" name="file_gst_image" id="file_gst_image" <?php echo $required;?>>
                                       <div class="clearfix"></div>
                                    </div><!-- GST Image -->
                						
                                      <?php
									 if($gstRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/gst/<?php echo $gstRow['gst_ack_image'];?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Image -->
                                    <?php 
									 }
									 ?>
                                        
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">GST Acknowledgement Image</label>
                                      <input type="file" name="file_gst_ack_image" accept="image/jpeg,image/png,image/jpg" id="file_gst_ack_image" <?php echo $required;?>>
                                     <div class="clearfix"></div>
                                    </div><!-- GST Ackg Image -->
                
                                    <div class="buttons-holder">
                                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                                    </div><!-- Submit -->
                                  </form>
                                </div>	<!--GST Information-->
                                
                              <!--=======================End : GST Information Dn By Satish 06092017=============================================-->
                              
                              
                             <!--=======================Start : Bank Information Dn By Satish 06092017=============================================-->
                                <div class="cls_mainmenu" id="bank_info">
                                  Bank Information
                                  <?php
								 //  Check Record and return single row
								  $bankRow = checkExist('tbl_customer_bank_details',array('bank_userid'=>$logged_uid));
								  if(!$bankRow)// for add and update in single form 
								  {
									  $frm_bank_name      = 'frm_bank_info';
									  $frm_bank_request   = 'add_bank_req';
									  $required           = 'data-rule-required="true"';
								  }
								  else
								  {
									  $frm_bank_name      = 'frm_update_bank_info';
									  $frm_bank_request   = 'update_bank_req';
									  $required           = '';
								  }
								  ?>
                                  <form role="form" class="register-form cf-style-1" id="<?php echo $frm_bank_name; ?>" name="<?php echo $frm_bank_name; ?>" enctype="multipart/form-data" method="post">
                                   <input type="hidden" name="<?php echo $frm_bank_request; ?>" value="1">
                                    <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $logged_uid; ?>">
                                    
                                     <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Account Holder Name</label>
                                      <input value="<?php echo @$bankRow['bank_username'] ?>" type="text" class="le-input col-md-9 col-xs-12" id="txt_bank_username" name="txt_bank_username">
                                      <div class="clearfix"></div>
                                    </div><!-- Bank Name -->
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Bank Name</label>
                                      <input value="<?php echo @$bankRow['bank_name'] ?>" type="text" class="le-input col-md-9 col-xs-12" id="txt_bank_name" name="txt_bank_name">
                                      <div class="clearfix"></div>
                                    </div><!-- Bank Name -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Bank Address</label>
                                      <textarea  id="txt_bank_address" name="txt_bank_address"><?php echo @$bankRow['bank_branch'] ;?></textarea>
                                      <div class="clearfix"></div>
                                    </div><!-- Bank Address -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Bank Account Number</label>
                                      <input type="text" value="<?php echo @$bankRow['bank_acc_no'] ?>"  class="le-input col-md-9 col-xs-12" id="txt_bank_accno" name="txt_bank_accno">
                                      <div class="clearfix"></div>
                                    </div><!-- Bank Account Number -->
                
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Bank IFSC Code</label>
                                      <input type="text" value="<?php echo @$bankRow['bank_ifsc'] ?>" class="le-input col-md-9 col-xs-12" id="txt_ifsc_code" name="txt_ifsc_code" minlength="11" maxlength="11">
                                      <div class="clearfix"></div>
                                    </div><!-- Bank IFSC CODE -->     
                					
                                      <?php
									 if($bankRow)
									 {
									 ?>
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name"></label>
                                       <img style="width:200px;height:100px" src="idbpanel/documents/banks/<?php echo $bankRow['bank_image'];?>" >
                                      <div class="clearfix"></div>
                                    </div><!-- Pan Image -->
                                    <?php 
									 }
									 ?>
                                    
                                    <div class="field-row">
                                      <label class="col-md-3 col-xs-12" for="name">Bank Check Image</label>
                                      <input type="file" accept="image/jpeg,image/png,image/jpg" name="file_bank_image" id="file_bank_image" <?php echo $required;?>>
                                      <div class="clearfix"></div>
                                    </div><!-- GST Ackg Image -->
                
                                    <div class="buttons-holder">
                                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                                    </div><!-- Submit -->               
                                  </form>
                                </div>	<!--Bank Information-->
                             <!--=======================End : Pan Information Dn By Satish 06092017=============================================-->
                             
        					</div>
           				</div>
					</div>
				</div>
			</main>
			<?php include('st-footer.php'); ?>
		</div>
      	<?php include('st-javascript.php'); ?>
        <?php include('st-validator-js.php'); ?>
      	<script src="assets/js/bootstrap-select.min.js"></script>
		<script type="text/javascript">
		var baseurll = '<?php echo $BaseFolder; ?>';
		
        function showDiv(divId)
        {
			$('.cls_mainmenu').removeClass('active');
			$('#'+divId).addClass('active');
        }

        function getCities(state_id, select_id, city_select_id)
        {
        	var getStatesCity	= '1';

        	var sendInfo		= {"state_id":state_id, "city_select_id":city_select_id, "getStatesCity":getStatesCity};
        	var getStateCities	= JSON.stringify(sendInfo); 

        	$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: getStateCities, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							$('#'+city_select_id).prop('selectedIndex',0);
							$('#'+city_select_id).html(data.resp);
							$('#'+city_select_id).selectpicker('refresh');
							
						} 
						else 
						{   
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal('toggle');	
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
        }
        
		function same_as_bill()   //done by monika
		{
			if($("#address_check").prop('checked') == true)
			{
				var comp_bill_address	= $('#txt_billing_address').val();
				var comp_ship_address	= $('#txt_shipping_address').val(comp_bill_address);
				$('#txt_shipping_address').prop('readonly', true);
				
				/* state select change*/
				var bill_state = $("#txt_bill_state").val();
				$("#txt_shipping_state").val(bill_state);
				$("#txt_shipping_state").prop("readonly",true); // disable  state select
				$("#txt_shipping_state").selectpicker('refresh'); 				
				/* state select change*/
				/* City select change*/				
				getCities(bill_state,'txt_bill_state','txt_shipping_city');
				stopExecution();
			}
			else if($("#address_check").prop('checked') == false)
			{
				$('#txt_shipping_address').prop("readonly",false);
				$('#txt_shipping_state').prop("readonly",false);
				$('#txt_shipping_city').prop("readonly",false);
				$('#txt_shipping_pincode').prop("readonly",false);
				
				$('#txt_shipping_address').val('');
				$('#txt_shipping_state').prop('selectedIndex',0);
				$('#txt_shipping_state').selectpicker('refresh');
				$('#txt_shipping_city').prop('selectedIndex',0);
				$('#txt_shipping_city').selectpicker('refresh');
				$('#txt_shipping_pincode').val('');
			}						
		}
		
		function stopExecution()
		{
			setTimeout(continueExecution, 1000) //wait ten seconds before continuing
		}
		
		function continueExecution()
		{
			perm_city = $("#txt_bill_city").val();
			$("#txt_shipping_city").val(perm_city);
			$("#txt_shipping_city").prop("readonly",true); // disable city select
			$('#txt_shipping_city').selectpicker('refresh');
			$("#txt_shipping_pincode").prop("readonly",true); // disable pincode
			$("#txt_shipping_pincode").val($("#txt_bill_pincode").val());				
		}
		
        $('#frm_profile').on('submit', function(e) 
        {
			e.preventDefault();
			if($('#frm_profile').valid())
			{
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							if(data.resp == 'email_verufication')
							{
								location.href	= baseurll + "/success";			
							}
							else
							{
								$('#div_success').html('<div class="update_success">'+data.resp+'</div></div>').delay(1200).fadeIn(5000).fadeOut(5000);
							}
							
							setTimeout(function(){ $('#div_success').html('').fadeIn(5000); }, 3000);
							
						} 
						else 
						{   
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal('toggle');	
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			}
        });
        
        $('#frm_comp_info').on('submit', function(e) 
        {
			e.preventDefault();
			if($('#frm_comp_info').valid())
			{
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							if(data.resp == 'email_verufication')
							{
								location.href	= baseurll + "/success";			
							}
							else
							{
								$('#div_success').html('<div class="update_success">'+data.resp+'</div></div>').delay(1200).fadeIn(5000).fadeOut(5000);
							}
							
							setTimeout(function(){ $('#div_success').html('').fadeIn(5000); }, 3000);
						} 
						else 
						{   
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal('toggle');	
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			}
        });
        
        $('#frm_urDoc').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_urDoc').valid())
			{
				
			}
        });
        
		//============================Start : Pan  Information==========================//
		
        $('#frm_pan_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_pan_info').valid())
			{
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal('toggle');	
						} 
						else 
						{   
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal('toggle');	
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			
			}
        });
        
		 $('#frm_update_pan_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_update_pan_info').valid())
			{
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			
			}
        });
		
		
		//============================End Add Form Information==========================//
		
		//============================Start GST Information================================================//
		
        $('#frm_gst_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_gst_info').valid())
			{
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);s
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			}
        });
      
	   $('#frm_update_gst_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_update_gst_info').valid())
			{
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			}
        });
	  
	  
	  //==============================End GST Information================================================//
	  
	    
        $('#frm_bank_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_bank_info').valid())
			{
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
				
			}
        });
		
		$('#frm_update_bank_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_update_bank_info').valid())
			{
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);	
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
			}
        });
		
		
		//===============Start : Doctor LIcense informtaion=======================================//
		
        $('#frm_lic_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_lic_info').valid())
			{
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
				
			}
        });
		
		
		$('#frm_chemist_lic_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_chemist_lic_info').valid())
			{
				var B20_number =  $('#txt_20b_lic_no').val();
				var B20_image  =  $('#file_lic_20b_image').val();
				var B21_number =  $('#txt_21b_lic_no').val();
				var B21_image  =  $('#file_lic_21b_image').val();
				var C21_number =  $('#txt_21c_lic_no').val();
				var C21_image  =  $('#file_lic_21c_image').val();
				if(B20_number !="" ||  B20_image!="" ||  B21_number!="" ||  B21_image!="")    
				{
					if(B20_number =="" ||  B20_image =="" ||  B21_number =="" ||  B21_image =="")
					{
						alert('20B and 21B is required');
						return false;
					}
				}
				else
				{
					if(C21_number =="" ||  C21_image =="" )
					{
						alert('21C or 20B   is required');
						return false;
					}
				}
				
				
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
				
			}
        });
		
		$('#frm_update_chemist_lic_info').on('submit', function(e) 
        {
        	e.preventDefault();
			if($('#frm_update_chemist_lic_info').valid())
			{
				var B20_number =  $('#txt_20b_lic_no').val();
				var B20_image  =  $('#file_lic_20b_image').val();
				var B21_number =  $('#txt_21b_lic_no').val();
				var B21_image  =  $('#file_lic_21b_image').val();
				var C21_number =  $('#txt_21c_lic_no').val();
				var C21_image  =  $('#file_lic_21c_image').val();
				if(B20_number !=""  || B21_number!="" )    
				{
					if(B20_number =="" || B21_number =="" )
					{
						alert('20B and 21B is required');
						return false;
					}
				}
				else
				{
					if(C21_number =="" )
					{
						alert('21C or 20B   is required');
						return false;
					}
				}
				
				
				
				$.ajax({
					url: "load_page_profile.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unabmale request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,						
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{  
							 
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						} 
						else 
						{   
							$('#div_success').html('<div style="background:#6C6; max-height:50px; height:50px; border-radius:10px; color:#fff; font-family:\'Courier New\', Courier, monospace; font-size:20px; font-weight:600;" align="center"><div style="padding-top:10px;">'+data.resp+'</div></div>').fadeIn(5000).fadeOut(5000);
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');	
					},
					complete: function()
					{
						//alert("complete");
						//loading_hide();
					}
				});
				
			}
        });
		
        </script>
	</body>
</html>

