<?php
	include("includes/db_con.php");
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
        height: 325px;
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
                          <a  href="javascript:void(0);" onclick="showDiv('comp_info');">Company Information</a>
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
                      <label for="name">Contact Persone's Name</label>
                      <input type="text" class="le-input" id="txt_name" name="txt_name">
                    </div><!-- Contact Persone's Name -->

                    <div class="field-row">
                      <label for="name">Email</label>
                      <input type="text" class="le-input" id="txt_email" name="txt_email">
                    </div><!-- Email -->

                    <div class="field-row">
                      <label for="name">Mobile</label>
                      <input type="text" class="le-input" id="txt_mobile" name="txt_mobile">
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
                      <label for="name">Company Name</label>
                      <input type="text" class="le-input" id="txt_comp_name" name="txt_comp_name">
                    </div><!-- Company Name -->

                    
                  </form>
                </div>
                <div class="cls_mainmenu" id="urDoc">
                  Upload Required Documents
                </div>
                <div class="cls_mainmenu" id="pan_info">
                  PAN Information
                </div>
                <div class="cls_mainmenu" id="gst_info">
                  GST Information
                </div>
                <div class="cls_mainmenu" id="bank_info">
                  Bank Information
                </div>
        			</div>
           </div>
					</div>
				</div>
			</main>
			<?php include('st-footer.php'); ?>
		</div>
      <?php include('st-javascript.php'); ?>
      <script type="text/javascript">
            function showDiv(divId)
            {
                  $('.cls_mainmenu').removeClass('active');
                  $('#'+divId).addClass('active');
            }
      </script>
  </body>
</html>