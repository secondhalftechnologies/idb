<?php
	include("includes/db_con.php");

  // ============================================================================
  // START : Hard Coding For testing the session Session not yet defined 
  // Dn By Prathamesh on 01 Aug 2017
  // ============================================================================
  // $logged_user_type  = $_SESSION[]['cust_type'];

  $org_details      = '';
  $logged_user_type = 'wholesalers';
  // $logged_user_type = 'hospitals';
  // $logged_user_type = 'wholesalers';
  // $logged_user_type = 'trader';

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
                          <a  href="javascript:void(0);" onclick="showDiv('profile');">Profile</a>
                        </li>
                        <li>
                          <a  href="javascript:void(0);" onclick="showDiv('comp_info');"><?php echo $org_menu_title; ?> Information</a>
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
        				<div class="cls_mainmenu active" id="profile">
                  Basic Information
                  <form role="form" class="register-form cf-style-1" id="frm_profile" name="frm_profile">
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name"><?php echo $contact_persone; ?> Name</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_name" name="txt_name">
                      <div class="clearfix"></div>
                    </div><!-- Contact Persone's Name -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Email</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_email" name="txt_email">
                      <div class="clearfix"></div>
                    </div><!-- Email -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Mobile</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_mobile" name="txt_mobile">
                      <div class="clearfix"></div>
                    </div><!-- Mobile -->                    

                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->
                  </form>
                </div>
                <div class="cls_mainmenu" id="comp_info">
                  Company Details
                  <form role="form" class="register-form cf-style-1" id="frm_comp_info" name="frm_comp_info">
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name"><?php echo $org_details ?> Name</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_comp_name" name="txt_comp_name">
                      <div class="clearfix"></div>
                    </div><!-- Company Name -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Primary Email</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_pri_email" name="txt_pri_email">
                      <label class="col-md-3 col-xs-12" for="name">Secondary Email</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_sec_email" name="txt_sec_email">
                      <div class="clearfix"></div>
                    </div><!-- Primary and Secondary Email -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Primary Phone Number</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_pri_phone" name="txt_pri_phone">
                      <label class="col-md-3 col-xs-12" for="name">Alternate Phone Number</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_alt_phone" name="txt_alt_phone">
                      <div class="clearfix"></div>
                    </div><!-- Primary and Secondary Phone Number -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Website</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_website" name="txt_website">
                      <div class="clearfix"></div>
                    </div><!-- Website -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Beneficiary Name</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_beneficiary_name" name="txt_beneficiary_name">
                      <div class="clearfix"></div>
                    </div><!-- Beneficiary Name -->
                    
                    Address Details
                    
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Billing Address</label>
                      <textarea class="le-input col-md-9 col-xs-12" id="txt_billing_address" name="txt_billing_address"></textarea>
                      <div class="clearfix"></div>
                    </div><!-- Billing Address -->

                    <div class="field-row">
                      <label class="col-md-3  col-xs-12">Billing State</label>
                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_bill_state" id="txt_bill_state">
                        <option value="">Select Billing State</option>
                        <option value="">State 1</option>
                        <option value="">State 2</option>
                        <option value="">State 3</option>
                      </select>
                      <div class="clearfix"></div>
                    </div><!-- Billing State -->

                    <div class="field-row">
                      <label class="col-md-3  col-xs-12">Billing City</label>
                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_bill_city" id="txt_bill_city">
                        <option value="">Select Billing City</option>
                        <option value="">City 1</option>
                        <option value="">City 2</option>
                        <option value="">City 3</option>
                      </select>
                    </div><!-- Billing City -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Billing Pincode</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_bill_pincode" name="txt_bill_pincode">
                      <div class="clearfix"></div>
                    </div><!-- Billing Pincode -->

                    <div style="margin-left:1%;">
                      <input id="address_check" name="address_check" onclick="same_as_bill();" class="css-checkbox" value="CHK" type="checkbox">
                      <label for="address_check" class="css-label" style="margin:12px;font-size:15px;">Same As Billing Details</label>
                      <div class="clearfix"></div>
                    </div>

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Shipping Address</label>
                      <textarea class="le-input col-md-9 col-xs-12" id="txt_shipping_address" name="txt_shipping_address"></textarea>
                      <div class="clearfix"></div>
                    </div><!-- Shipping Address -->

                    <div class="field-row">
                      <label class="col-md-3  col-xs-12">Shipping State</label>
                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_shipping_state" id="txt_shipping_state">
                        <option value="">Select Billing State</option>
                        <option value="">State 1</option>
                        <option value="">State 2</option>
                        <option value="">State 3</option>
                      </select>
                      <div class="clearfix"></div>
                    </div><!-- Shipping State -->

                    <div class="field-row">
                      <label class="col-md-3  col-xs-12">Shipping City</label>
                      <select class="col-md-3 col-xs-12 selectpicker" data-live-search="true" name="txt_shipping_city" id="txt_shipping_city">
                        <option value="">Select Billing City</option>
                        <option value="">City 1</option>
                        <option value="">City 2</option>
                        <option value="">City 3</option>
                      </select>
                    </div><!-- Shipping City -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Shipping Pincode</label>
                      <input type="text" class="le-input col-md-3 col-xs-12" id="txt_shipping_pincode" name="txt_shipping_pincode">
                      <div class="clearfix"></div>
                    </div><!-- Shipping Pincode -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Description</label>
                      <textarea class="le-input col-md-9 col-xs-12" id="txt_description" name="txt_description"></textarea>
                      <div class="clearfix"></div>
                    </div><!-- Shipping Address -->

                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->
                  </form>
                </div>
                <div class="cls_mainmenu" id="urDoc">
                  Upload Required Documents
                  <form role="form" class="register-form cf-style-1" id="frm_urDoc" name="frm_comp_info">
                    <?php
                    if($logged_user_type == 'doctors')
                    {
                      ?>
                      
                      <?php
                    }
                    elseif ($logged_user_type == 'hospitals') 
                    {
                      ?>

                      <?php
                    }
                    elseif ($logged_user_type == 'chemist' || $logged_user_type == 'trader') 
                    {
                      ?>

                      <?php
                    }
                    ?>
                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->
                  </form>
                </div>
                <div class="cls_mainmenu" id="pan_info">
                  PAN Information
                  <form role="form" class="register-form cf-style-1" id="frm_pan_info" name="frm_pan_info" enctype="multipart/form-data" method="post">
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Pan Number</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_pan_no" name="txt_pan_no">
                      <div class="clearfix"></div>
                    </div><!-- Pan Number -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Pan Image</label>
                      <input type="file" name="file_pan_image" id="file_pan_image">
                      <input type="submit" value="Upload Image" name="submit">  
                      <div class="clearfix"></div>
                    </div><!-- Pan Image -->

                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->
                  </form>
                </div>
                <div class="cls_mainmenu" id="gst_info">
                  GST Information
                  <form role="form" class="register-form cf-style-1" id="frm_gst_info" name="frm_gst_info" enctype="multipart/form-data" method="post">
                    
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">GST Number</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_gst_no" name="txt_gst_no">
                      <div class="clearfix"></div>
                    </div><!-- GST Number -->                    

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Pan Image</label>
                      <input type="file" name="file_gst_image" id="file_gst_image">
                      <input type="submit" value="Upload Image" name="submit">  
                      <div class="clearfix"></div>
                    </div><!-- GST Image -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Pan Image</label>
                      <input type="file" name="file_gst_ack_image" id="file_gst_ack_image">
                      <input type="submit" value="Upload Image" name="submit">  
                      <div class="clearfix"></div>
                    </div><!-- GST Ackg Image -->

                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->
                  </form>
                </div>
                <div class="cls_mainmenu" id="bank_info">
                  Bank Information
                  <form role="form" class="register-form cf-style-1" id="frm_bank_info" name="frm_bank_info" enctype="multipart/form-data" method="post">
                    
                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Bank Name</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_bank_name" name="txt_bank_name">
                      <div class="clearfix"></div>
                    </div><!-- Bank Name -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Bank Address</label>
                      <textarea id="txt_bank_address" name="txt_bank_address"></textarea>
                      <div class="clearfix"></div>
                    </div><!-- Bank Address -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Bank Account Number</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_bank_name" name="txt_bank_name">
                      <div class="clearfix"></div>
                    </div><!-- Bank Account Number -->

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Bank IFSC Code</label>
                      <input type="text" class="le-input col-md-9 col-xs-12" id="txt_ifsc_code" name="txt_ifsc_code">
                      <div class="clearfix"></div>
                    </div><!-- Bank IFSC CODE -->     

                    <div class="field-row">
                      <label class="col-md-3 col-xs-12" for="name">Bank Image</label>
                      <input type="file" name="file_bank_image" id="file_bank_image">
                      <input type="submit" value="Upload Image" name="submit">  
                      <div class="clearfix"></div>
                    </div><!-- GST Ackg Image -->

                    <div class="buttons-holder">
                      <button type="submit" id="btn_submit" name="btn_submit" class="le-button" value="frm-submit" >Update</button>
                    </div><!-- Submit -->               
                  </form>
                </div>
        			</div>
           </div>
					</div>
				</div>
			</main>
			<?php include('st-footer.php'); ?>
		</div>
      <?php include('st-javascript.php'); ?>
      <script src="assets/js/bootstrap-select.min.js"></script>
      <script type="text/javascript">
        function showDiv(divId)
        {
              $('.cls_mainmenu').removeClass('active');
              $('#'+divId).addClass('active');
        }

        $('#frm_profile').on('submit', function(e) 
        {
          e.preventDefault();
        });

        $('#frm_comp_info').on('submit', function(e) 
        
        {
          e.preventDefault();
        });

        $('#frm_urDoc').on('submit', function(e) 
        {
          e.preventDefault();
        });

        $('#frm_pan_info').on('submit', function(e) 
        {
          e.preventDefault();
        });

        $('#frm_gst_info').on('submit', function(e) 
        {
          e.preventDefault();
        });

        $('#frm_bank_info').on('submit', function(e) 
        {
          e.preventDefault();
        });

        
        
        
        
        
      </script>
  </body>
</html>

