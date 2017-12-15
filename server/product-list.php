<?php include("includes/db_con.php"); ?>
<?php include("includes/query-helper.php"); ?>
<?php

$cat_name   = "All Category";
$cat_id     = '';
if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id']!="")
{
	$cat_id =mysqli_real_escape_string($db_con,$_REQUEST['cat_id']);
	$cat_row =checkExist('tbl_category' ,array('cat_id'=>$cat_id));
	if($cat_row)
	{
		$cat_id   = $_REQUEST['cat_id'];
		$cat_name = ucwords($cat_row['cat_name']);
	}
	
}

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

        <title>Product List - Indian Dava Bazar</title>

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
			#single-product .body-holder .qnt-holder select { width:100%; margin:9px 0; padding:8px 3px;}
			
    	</style>
	</head>


	<body>
		<div class="wrapper">
			<!-- ============================================================= HEADER ============================================================= -->
			<?php  include('st-header.php'); ?>
			<?php  /*include('st-breadcrumb.php');*/ ?>
            <?php  breadcrumbs(array('page-terms'=>"Product List")); ?>
			<!-- ============================================================= HEADER : END ======================================================== -->

           

            <section id="category-grid">
                <div class="container">
                    <!-- ========================================= SIDEBAR ========================================= -->
                    <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
                        <!-- ========================================= PRODUCT FILTER ========================================= -->
                        <div class="widget">
                            <h1>Product Filters</h1>
                            <div class="body bordered">

                                <div class="category-filter">
                                    <h2>Brands</h2>
                                    <hr>
                                    <ul>
                                        <li><input checked="checked" class="le-checkbox" type="checkbox"  /> <label>Samsung</label> <span class="pull-right">(2)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Dell</label> <span class="pull-right">(8)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Toshiba</label> <span class="pull-right">(1)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Apple</label> <span class="pull-right">(5)</span></li>
                                    </ul>
                                </div><!-- /.category-filter -->
                                <div class="category-filter">
                                    <h2>Composition</h2>
                                    <hr>
                                    <ul>
                                        <li><input checked="checked" class="le-checkbox" type="checkbox"  /> <label>Composition 01</label> <span class="pull-right">(2)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Composition 02</label> <span class="pull-right">(8)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Composition 03</label> <span class="pull-right">(1)</span></li>
                                        <li><input  class="le-checkbox" type="checkbox" /> <label>Composition 04</label> <span class="pull-right">(5)</span></li>
                                    </ul>
                                </div><!-- /.category-filter -->

                                <div class="price-filter">
                                    <h2>Price</h2>
                                    <hr>
                                    <div class="price-range-holder">

                                        <input type="text" class="price-slider" value="" >

                                        <span class="min-max">
                                            Price: $89 - $2899
                                        </span>
                                        <span class="filter-button">
                                            <a href="#">Filter</a>
                                        </span>
                                    </div>
                                </div><!-- /.price-filter -->

                            </div><!-- /.body -->
                        </div><!-- /.widget -->
                        <!-- ========================================= PRODUCT FILTER : END ========================================= -->

                        <!-- ========================================= CATEGORY TREE ========================================= -->
                        <div class="widget accordion-widget category-accordions">
                            <h1 class="border">Category</h1>
                            <div class="accordion">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne">
                                            laptops &amp; computers
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li>
                                                    <div class="accordion-heading">
                                                        <a href="#collapseSub1" data-toggle="collapse">laptop</a>
                                                    </div>
                                                    <div id="collapseSub1" class="accordion-body collapse in">
                                                        <ul>
                                                            <li><a href="#">Two Level Accordion</a></li>
                                                        </ul>
                                                    </div><!-- /.accordion-body -->
                                                </li>
                                                <li>
                                                    <div class="accordion-heading">
                                                        <a href="#collapseSub2" data-toggle="collapse">tablet</a>
                                                    </div>
                                                    <div id="collapseSub2" class="accordion-body collapse in">
                                                        <ul>
                                                            <li>
                                                                <div class="accordion-heading">
                                                                    <a href="#collapseSub3" data-toggle="collapse">Three Level Accordion</a>
                                                                </div>
                                                                <div id="collapseSub3" class="accordion-body collapse in">
                                                                    <ul>
                                                                        <li><a href="#">PDA</a></li>
                                                                        <li><a href="#">notebook</a></li>
                                                                        <li><a href="#">mini notebook</a></li>
                                                                    </ul>
                                                                </div><!-- /.accordion-body -->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li><a href="#">PDA</a></li>
                                                <li><a href="#">notebook</a></li>
                                                <li><a href="#">mini notebook</a></li>
                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div>
                                </div><!-- /.accordion-group -->

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo">
                                            desktop PC
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">gaming</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">kids</a></li>
                                                <li><a href="#">for women</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.accordion-group -->


                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse"  href="#collapse3">
                                            laptops
                                        </a>
                                    </div>
                                    <div id="collapse3" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">light weight</a></li>
                                                <li><a href="#">wide monitor</a></li>
                                                <li><a href="#">ultra laptop</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.accordion-group -->


                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse"  href="#collapse4">
                                            notebooks
                                        </a>
                                    </div>
                                    <div id="collapse4" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul>
                                                <li><a href="#">light weight</a></li>
                                                <li><a href="#">wide monitor</a></li>
                                                <li><a href="#">ultra laptop</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.accordion-group -->

                            </div><!-- /.accordion -->
                        </div><!-- /.category-accordions -->
                        <!-- ========================================= CATEGORY TREE : END ========================================= -->

                        <div class="widget">
                            <div class="simple-banner">
                                <a href="#"><img alt="" class="img-responsive" src="assets/images/blank.gif" data-echo="assets/images/banners/banner-simple.jpg" /></a>
                            </div>
                        </div>

                        <!-- ========================================= FEATURED PRODUCTS ========================================= -->
                        <div class="widget">
                            <h1 class="border">Top Sellers</h1>
                            <ul class="product-list">

                                <li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-01.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="#">Netbook Acer </a>
                                            <div class="price">
                                                <div class="price-prev">$2000</div>
                                                <div class="price-current">$1873</div>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- /.sidebar-product-list-item -->

                                <li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-02.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="#">PowerShot Elph 115 16MP Digital Camera</a>
                                            <div class="price">
                                                <div class="price-prev">$2000</div>
                                                <div class="price-current">$1873</div>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- /.sidebar-product-list-item -->

                                <li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-03.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="#">PowerShot Elph 115 16MP Digital Camera</a>
                                            <div class="price">
                                                <div class="price-prev">$2000</div>
                                                <div class="price-current">$1873</div>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- /.sidebar-product-list-item -->

                                <li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-01.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="#">Netbook Acer </a>
                                            <div class="price">
                                                <div class="price-prev">$2000</div>
                                                <div class="price-current">$1873</div>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- /.sidebar-product-list-item -->

                                <li class="sidebar-product-list-item">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-02.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 no-margin">
                                            <a href="#">PowerShot Elph 115 16MP Digital Camera</a>
                                            <div class="price">
                                                <div class="price-prev">$2000</div>
                                                <div class="price-current">$1873</div>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- /.sidebar-product-list-item -->

                            </ul><!-- /.product-list -->
                        </div><!-- /.widget -->
                        <!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
                    </div>
                    <!-- ========================================= SIDEBAR : END ========================================= -->

                    <!-- ========================================= CONTENT ========================================= -->

                    <div class="col-xs-12 col-sm-9 no-margin wide sidebar">
                        

                        <section id="gaming">
                            <div class="grid-list-products">
                                <h2 class="section-title"><?php echo $cat_name; ?></h2>

                                <div class="control-bar">
                                    <input type="hidden" name="page" id="page" value="1"/>
                                    <div id="popularity-sort" class="le-select" >
                                        <select data-placeholder="sort by popularity" onChange="loadProducts()" id="sort_by" name="sort_by">
                                            <option value="">Sort By</option>
                                             <option value="1">New Arrivals</option>
                                            <option value="2">Price L-H</option>
                                            <option value="3">Price H-L</option>
                                         </select>
                                    </div>

                                    <div id="item-count" class="le-select"  >
                                        <select id="per_page" name="per_page" onChange="loadProducts()">
                                            <option value="24">24 per page</option>
                                            <option value="48">48 per page</option>
                                            <option value="32">32 per page</option>
                                        </select>
                                    </div>

                                    <div class="grid-list-buttons">
                                        <ul>
                                            <li class="grid-list-button-item "><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> Grid</a></li>
                                            <li class="grid-list-button-item active"><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> List</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.control-bar -->

                                <div class="tab-content" id="prod_content">
                                
                                
                                    <div id="grid-view" class="products-grid fade tab-pane ">

                                        <div class="product-grid-holder">
                                            <div class="row no-margin">

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon red"><span>sale</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-01.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount green">-50% sale</div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon blue"><span>new!</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-02.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">White lumia 9001</a>
                                                            </div>
                                                            <div class="brand">nokia</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-03.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">POV Action Cam</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon red"><span>sale</span></div>
                                                        <div class="ribbon green"><span>bestseller</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-04.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">Netbook Acer TravelMate B113-E-10072</a>
                                                            </div>
                                                            <div class="brand">acer</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon red"><span>sale</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-01.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount green">-50% sale</div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon blue"><span>new!</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-02.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">White lumia 9001</a>
                                                            </div>
                                                            <div class="brand">nokia</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-03.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">POV Action Cam</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="ribbon red"><span>sale</span></div>
                                                        <div class="ribbon green"><span>bestseller</span></div>
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-04.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">Netbook Acer TravelMate B113-E-10072</a>
                                                            </div>
                                                            <div class="brand">acer</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                                <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                    <div class="product-item">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-03.jpg" />
                                                        </div>
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">POV Action Cam</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                        </div>
                                                        <div class="prices">
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="price-current pull-right">$1199.00</div>
                                                        </div>
                                                        <div class="hover-area">
                                                            <div class="add-cart-button">
                                                                <a href="single-product.html" class="le-button">add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-item -->
                                                </div><!-- /.product-item-holder -->

                                            </div><!-- /.row -->
                                        </div><!-- /.product-grid-holder -->

                                        <div class="pagination-holder">
                                            <div class="row">

                                                <div class="col-xs-12 col-sm-6 text-left">
                                                    <ul class="pagination ">
                                                        <li class="current"><a  href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">next</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="result-counter">
                                                        Showing <span>1-9</span> of <span>11</span> results
                                                    </div>
                                                </div>

                                            </div><!-- /.row -->
                                        </div><!-- /.pagination-holder -->
                                    </div><!-- /.products-grid #grid-view -->

                                    <div id="list-view" class="products-grid fade tab-pane in active ">
                                        <div class="products-list" id="products-list">

                                            <div class="product-item product-item-holder">
                                                <div class="ribbon red"><span>sale</span></div>
                                                <div class="ribbon blue"><span>new!</span></div>
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-01.jpg" />
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                        <div class="body">
                                                            <div class="label-discount green">-50% sale</div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                            <div class="excerpt">
                                                                <p><strong>Application:</strong> Headache, Pain Killer<br />
                                                                <strong>Manufacturing Date:</strong> 11/05/2017<br />
                                                                <strong>Expiry Date:</strong> 11/05/2019</p>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                        <div class="right-clmn">
                                                            <div class="price-current">$1199.00</div>
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
                                                            <a class="le-button" href="#">add to cart</a>
                                                        </div>
                                                    </div><!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->


                                            <div class="product-item product-item-holder">
                                                <div class="ribbon green"><span>bestseller</span></div>
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-02.jpg" />
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                            <div class="excerpt">
                                                                <div class="star-holder">
                                                                    <div class="star" data-score="4"></div>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis euismod erat sit amet porta. Etiam venenatis ac diam ac tristique. Morbi accumsan consectetur odio ut tincidunt.</p>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                        <div class="right-clmn">
                                                            <div class="price-current">$1199.00</div>
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
                                                            <a class="le-button disabled" href="#">add to cart</a>
                                                        </div>
                                                    </div><!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->


                                            <div class="product-item product-item-holder">
                                                <div class="ribbon red"><span>sell</span></div>
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-03.jpg" />
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                            <div class="excerpt">
                                                                <div class="star-holder">
                                                                    <div class="star" data-score="2"></div>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis euismod erat sit amet porta. Etiam venenatis ac diam ac tristique. Morbi accumsan consectetur odio ut tincidunt. </p>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                        <div class="right-clmn">
                                                            <div class="price-current">$1199.00</div>
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
                                                            <a class="le-button" href="#">add to cart</a>
                                                        </div>
                                                    </div><!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->

                                            <div class="product-item product-item-holder">
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-04.jpg" />
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                        <div class="body">
                                                            <div class="label-discount green">-50% sale</div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                            <div class="excerpt">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis euismod erat sit amet porta. Etiam venenatis ac diam ac tristique. Morbi accumsan consectetur odio ut tincidunt. </p>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                        <div class="right-clmn">
                                                            <div class="price-current">$1199.00</div>
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
                                                            <a class="le-button" href="#">add to cart</a>
                                                        </div>
                                                    </div><!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->

                                            <div class="product-item product-item-holder">
                                                <div class="ribbon green"><span>bestseller</span></div>
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-05.jpg" />
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                        <div class="body">
                                                            <div class="label-discount clear"></div>
                                                            <div class="title">
                                                                <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                            </div>
                                                            <div class="brand">sony</div>
                                                            <div class="excerpt">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis euismod erat sit amet porta. Etiam venenatis ac diam ac tristique. Morbi accumsan consectetur odio ut tincidunt.</p>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                        <div class="right-clmn">
                                                            <div class="price-current">$1199.00</div>
                                                            <div class="price-prev">$1399.00</div>
                                                            <div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
                                                            <a class="le-button" href="#">add to cart</a>
                                                        </div>
                                                    </div><!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->

                                        </div><!-- /.products-list -->

                                        <div class="pagination-holder" id="pagination-holder">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 text-left">
                                                    <ul class="pagination">
                                                        <li class="current"><a  href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">next</a></li>
                                                    </ul><!-- /.pagination -->
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="result-counter">
                                                        Showing <span>1-9</span> of <span>11</span> results
                                                    </div><!-- /.result-counter -->
                                                </div>
                                            </div><!-- /.row -->
                                        </div><!-- /.pagination-holder -->

                                    </div><!-- /.products-grid #list-view -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.grid-list-products -->

                        </section><!-- /#gaming -->
                    </div><!-- /.col -->
                    <!-- ========================================= CONTENT : END ========================================= -->
                </div><!-- /.container -->
            </section><!-- /#category-grid -->

           <!-- ============================================================= FOOTER ============================================================= -->
            <?php include('st-footer.php'); ?>
            <!-- ============================================================= FOOTER : END ======================================================= -->
        </div><!-- /.wrapper -->
		
		<?php include('st-javascript.php'); ?>
       <!-- <?php include('st-validator-js.php'); ?>-->
		<!-- For demo purposes – can be removed on production : End -->
        <script type="text/javascript" >
		
		 $(document).ready(function () {
			
		 	loadProducts();
		 });
		 
		 function loadProducts()
		 {
			var cat_id      = '<?php echo $cat_id; ?>'
			var page        = $('#page').val();
        	var getProducts	= '1';
			var sort_by     = $('#sort_by').val();
			var per_page    = $('#per_page').val();
        	var sendInfo		= {"page":page, "sort_by":sort_by,"per_page":per_page,"getProducts":getProducts,'cat_id':cat_id};
        	var getStateCities	= JSON.stringify(sendInfo); 

        	$.ajax({
					url: "load_page_products.php",
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
							$('#products-list').html(data.resp[0]);
							$('#pagination-holder').html(data.resp[1]);
							
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
		 
		</script>
        
    </body>
</html>
