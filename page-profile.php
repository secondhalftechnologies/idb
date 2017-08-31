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
			.cls_sidemenu
			{
				color: #000;
				width: 100%;
			}

                  .cls_sidemenu:hover
                  {
                        color: green;
                  }

                  .cls_sidemenu:active
                  {
                        color: #000;
                  }

			.cls_mainmenu
			{
				display: none;
			}

                  .active
                  {
                        display: block;
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
						<!-- <div class="col-md-2" >
                           &nbsp;
                        </div> -->

                        <div class="col-md-12" >
                        	<div class="container">
                        		<div class="row">
                        			<div class="col-md-3">
                        				<ul>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('profile');"> Profile </a>
                        					</li>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('company_info');"> Company Information </a>
                        					</li>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('urDoc');"> Upload Required Documents </a>
                        					</li>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('pan_info');"> PAN Information </a>
                        					</li>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('gst_info');"> GST Information </a>
                        					</li>
                        					<li>
                        						<a href="javascript:void(0);" class="cls_sidemenu" onclick="showDiv('bank_info');"> Bank Information </a>
                        					</li>
                        				</ul>
                        			</div>
                        			<div class="col-md-9">
                        				<div class="cls_mainmenu active" id="profile">
                                                      Login Details
                                                </div>
                        				<div class="cls_mainmenu" id="company_info">
                                                      Company Information
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

                        <!-- <div class="col-md-2">
                           &nbsp;
                        </div> -->
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