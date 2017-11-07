<?php include("includes/db_con.php"); ?>
<?php include("includes/query-helper.php"); ?>
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

        <title>Disclaimer - Indian Dava Bazar</title>

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
            <?php  breadcrumbs(array('page-disclaimer'=>"Disclaimer")); ?>
			<!-- ============================================================= HEADER : END ======================================================== -->

            <main id="about-us">
                <div class="container inner-top-xs inner-bottom-sm">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                         <?php
							
							$result = getRecord('tbl_pages_module',array('page_name'=>'disclaimer'),array(),array(),array());
							$row    = mysqli_fetch_array($result);
							echo $row['page_content'];
						?>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->

             </main><!-- /#about-us -->
            <!-- ========================================= MAIN : END ========================================= -->

            <!-- ============================================================= FOOTER ============================================================= -->
            <?php include('st-footer.php'); ?>
            <!-- ============================================================= FOOTER : END ======================================================= -->
        </div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
        <?php include('st-validator-js.php'); ?>
		<!-- For demo purposes – can be removed on production : End -->
    </body>

</html>
