<?php include("includes/db_con.php"); ?>
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

        <title>Contact Us - Indian Dava Bazar</title>

		<?php include('st-head.php'); ?>
        <?php include('st-validator-css.php'); ?>
    	<link href="assets/css/bootstrap-select.min.css" rel="stylesheet" title="selectbox">
        
        <!--==================Start: Done By satish for Timepicker====================================-->
        <link href="assets/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link href="assets/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
        <!--==================End : Done By satish====================================-->
		<style type="text/css">
		    /*==Start Done by satish 03112017=====*/
		    .fleft
			{
				float:left;
			}
			.fright
			{
				float:right;
			}
			.padding20
			{
				padding:20px;
				color:#4f7351;
			}
			
			paddingr15
			{
				padding-right:15px;
			}
			.padding20 a
			{
				color:#4f7351;
			}
			 /*==End Done by satish 03112017=====*/
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
			text-indent: 10px;
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
			/*text-indent: 30px;*/
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
			height: 426px;
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
			/*text-indent: 30px;*/
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
			

			<!-- ============================================================= HEADER ============================================================= -->
			<?php  include('st-header.php'); ?>
			<?php  /*include('st-breadcrumb.php');*/ ?>
            <?php  breadcrumbs(array('page-contact'=>"Contact Us")); ?>
			<!-- ============================================================= HEADER : END ======================================================== -->

              <main id="contact-us" class="inner-bottom-md">
                <section class="google-map map-holder">
                    <div id="map" class="map center"></div>
                    <form role="form" class="get-direction">
                        <div class="container">
                            <div class="row">
                                <div class="center-block col-lg-10">
                                    <div class="input-group">
                                        <input type="text" class="le-input input-lg form-control" placeholder="Enter Your Starting Point">
                                        <span class="input-group-btn">
                                            <button class="btn btn-lg le-button" type="button">Get Directions</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                        </div>
                    </form>
                </section>

                <div class="container">
                    <div class="row">

                        <div class="col-md-8">
                            <section class="section leave-a-message">
                                <h2 class="bordered">Leave a Message</h2>
                                <p>Maecenas dolor elit, semper a sem sed, pulvinar molestie lacus. Aliquam dignissim, elit non mattis ultrices, neque odio ultricies tellus, eu porttitor nisl ipsum eu massa.</p>
                                <form id="contact-form" class="contact-form cf-style-1 inner-top-xs" method="post" >
                                    <div class="row field-row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Your Name*</label>
                                            <input class="le-input" >
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Your Email*</label>
                                            <input class="le-input" >
                                        </div>
                                    </div><!-- /.field-row -->
									
                                    <div class="row field-row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Subject</label>
                                            <input class="le-input" >
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Mobile Number</label>
                                            <input class="le-input" >
                                        </div>
                                    </div><!-- /.field-row -->
                                    

                                    <div class="field-row">
                                        <label>Your Message</label>
                                        <textarea rows="8" class="le-input"></textarea>
                                    </div><!-- /.field-row -->

                                    <div class="buttons-holder">
                                        <button type="submit" class="le-button huge">Send Message</button>
                                    </div><!-- /.buttons-holder -->
                                </form><!-- /.contact-form -->
                            </section><!-- /.leave-a-message -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <section class="our-store section inner-left-xs">
                                <h2 class="bordered">Our Store</h2>
                                <address>
                                    17 Princess Road <br/>
                                    London, Greater London <br/>
                                    NW1 8JR, UK
                                </address>
                                <h3>Hours of Operation</h3>
                                <ul class="list-unstyled operation-hours">
                                    <li class="clearfix">
                                        <span class="day">Monday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Tuesday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Wednesday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Thursday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Friday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Saturday:</span>
                                        <span class="pull-right hours">12-6 PM</span>
                                    </li>
                                    <li class="clearfix">
                                        <span class="day">Sunday</span>
                                        <span class="pull-right hours">Closed</span>
                                    </li>
                                </ul>
                                <h3>Career</h3>
                                <p>If you're interested in employment opportunities at MediaCenter, please email us: <a href="mailto:contact@yourstore.com">contact@yourstore.com</a></p>
                            </section><!-- /.our-store -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main>
            <!-- ========================================= MAIN : END ========================================= -->

            <!-- ============================================================= FOOTER ============================================================= -->
            <?php include('st-footer.php'); ?>
            <!-- ============================================================= FOOTER : END ======================================================= -->
        </div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
        <?php include('st-validator-js.php'); ?>
       
        <script src="http://maps.google.com/maps/api/js?key= AIzaSyDbBmtgccSu5p0wCRztnlGW1ML_FsL68X0&amp;sensor=false&amp;language=en"></script>		<script src="assets/js/gmap3.min.js"></script>
        
		<!-- For demo purposes – can be removed on production : End -->
    </body>

</html>
