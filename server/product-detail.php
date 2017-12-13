<!DOCTYPE html>
<html lang="en">
<?php include("includes/db_con.php"); ?>
<?php include("includes/query-helper.php"); ?>

<?php
function show_full_path($cat_id,$array)
{
  	global $db_con;
	$sql_get_cat = "SELECT * FROM tbl_category WHERE cat_id ='".$cat_id."' AND cat_name !='none'";
	$res_get_cat = mysqli_query($db_con,$sql_get_cat) or die(mysqli_error($db_con));
	$num_rows    = mysqli_num_rows($res_get_cat);
	if($num_rows !=0)
	{   $row =mysqli_fetch_array($res_get_cat);
		array_push($array,ucwords($row['cat_name']));
		if($row['cat_type']!="parent")
		{
		  $array = show_full_path($row['cat_type'],$array);
		}
	}
	return $array;
}


if(isset($_REQUEST['batch_id']) && $_REQUEST['batch_id']!='')
{
	$brow = checkExist('tbl_batches' ,array('batch_id'=>$_REQUEST['batch_id']));
	if($brow)
	{
		$prow = checkExist('tbl_products' ,array('id'=>$brow['prod_id']));
		if($prow)
		{
			if($prow['prod_slug']==$_REQUEST['prod_slug'])
			{
				
			}
			else
			{
				header("LOCATION:index.php");
			}
		}
		else
		{
			header("LOCATION:index.php");
		}
	}
	else
	{
		header("LOCATION:index.php");
	}
}
else
{
	header("LOCATION:index.php");
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

        <title>Product Details - Indian Dava Bazar</title>

		<?php include('st-head.php'); ?>
        
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
            <?php  breadcrumbs(array('page-terms'=>"Product Details")); ?>
			<!-- ============================================================= HEADER : END ======================================================== -->
            <div id="single-product">
                <div class="container">

                    <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
                        <div class="product-item-holder size-big single-product-gallery small-gallery">

                            <div id="owl-single-product" class="owl-carousel">
                            <?php
							
							
							  $imageResult = getRecord('tbl_product_images' ,array('prod_id'=>$prow['id']),array(),array(),array(),array('image_order'=>'ASC'));
								while($imageRow = mysqli_fetch_array($imageResult))
								{?>
                               	 <div class="single-product-gallery-item" id="slide<?php echo $imageRow['image_id']; ?>">
                                    <a data-rel="prettyphoto" href="images/products/prodid_<?php echo $prow['id']; ?>/large/<?php echo $imageRow['image_name']; ?>">
                                        <img class="img-responsive" alt="" src="images/products/prodid_<?php echo $prow['id']; ?>/large/<?php echo $imageRow['image_name']; ?>" />
                                    </a>
                                </div><!-- /.single-product-gallery-item -->
							<?php
                            	}
							?>
                            </div><!-- /.single-product-slider -->


                            <div class="single-product-gallery-thumbs gallery-thumbs">

                                <div id="owl-single-product-thumbnails" class="owl-carousel">
                                <?php
                                $imageResult = getRecord('tbl_product_images' ,array('prod_id'=>$prow['id']),array(),array(),array(),array('image_order'=>'ASC'));
								
								$i= 0;
								while($imageRow = mysqli_fetch_array($imageResult))
								{?>
                               	  <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="<?php echo $i; ?>" href="#slide<?php echo $imageRow['image_id']; ?>">
                                        <img width="67" alt="" src="images/products/prodid_<?php echo $prow['id']; ?>/small/<?php echo $imageRow['image_name']; ?>" />
                                    </a>
								<?php
								$i++;
                                }
                                ?>
                                </div><!-- /#owl-single-product-thumbnails -->

                                <div class="nav-holder left hidden-xs">
                                    <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
                                </div><!-- /.nav-holder -->

                                <div class="nav-holder right hidden-xs">
                                    <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
                                </div><!-- /.nav-holder -->

                            </div><!-- /.gallery-thumbs -->

                        </div><!-- /.single-product-gallery -->
                    </div><!-- /.gallery-holder -->
                    <div class="no-margin col-xs-12 col-sm-7 body-holder">
                        <div class="body">
                            <div class="availability"><label>Availability:</label><span class="available">  in stock</span></div>

                            <div class="title"><a href="#"> <?php echo ucwords($prow['prod_name']); ?></a></div>
                            <div class="brand"><?php echo ucwords($prow['prod_manufactured']); ?></div>

                            <div class="social-row">
                                <span class="st_facebook_hcount"></span>
                                <span class="st_twitter_hcount"></span>
                                <span class="st_pinterest_hcount"></span>
                            </div>

                            <div class="excerpt">
                            <?php
                            	$application        = $prow['prod_attribute'];
                                if($application!="")
                                {
                                    $sql_get_applcation  = "SELECT GROUP_CONCAT(attribute_name separator  ', ') as attribute FROM tbl_attribute WHERE id IN(".$application.")";
                                    $res_get_application = mysqli_query($db_con,$sql_get_applcation) or die(mysqli_error($db_con));
                                    $row_get_application = mysqli_fetch_array($res_get_application);
                                    $application         = ucwords($row_get_application['attribute']);
                                }
								
								$composition        = $prow['prod_comp'];
								if($composition!="")
								{
									$sql_get_composition  = "SELECT GROUP_CONCAT(spec_name separator  ', ') as composition FROM tbl_composition WHERE spec_id IN(".$composition.")";
									$res_get_composition = mysqli_query($db_con,$sql_get_composition) or die(mysqli_error($db_con));
									$row_get_composition = mysqli_fetch_array($res_get_composition);
									$composition         = ucwords($row_get_composition['composition']);
								}
							?>
                                <p><strong>Application:</strong> <?php echo $application; ?></p>
                                <p><strong>Composition:</strong> <?php echo $composition; ?></p>
                                <p><strong>* Seller Location:</strong> Mumbai, MH</p>
                            </div>

                            <div class="prices">
                                <div class="price-current">Rs. <?php echo $brow['prod_price']; ?></div>
                               <!-- <div class="price-prev">Rs. 200</div>-->
                            </div>
                            
                            <div class="qnt-holder">
                            	<select><option>Select Quantity Type</option><option>Single Unit</option><option>Shipper</option></select>
                                <div class="le-quantity">
                                    <form>
                                        <a class="minus" href="#reduce"></a>
                                        <input name="quantity" readonly type="text" value="1" />
                                        <a class="plus" href="#add"></a>
                                    </form>
                                </div>
                                <a id="addto-cart" href="cart.html" class="le-button huge">add to cart</a>
                            </div><!-- /.qnt-holder -->
                        </div><!-- /.body -->

                    </div><!-- /.body-holder -->
                </div><!-- /.container -->
            </div><!-- /.single-product -->

            <!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
            <section id="single-product-tab">
                <div class="container">
                    <div class="tab-holder">

                        <ul class="nav nav-tabs simple" >
                            <li class="active"><a >Additional Information</a></li>
                        </ul><!-- /.nav-tabs -->
						<?php
							$manufacturing_date = explode('-',$brow['prod_manu_date']);
							$manufacturing_date = $manufacturing_date[1].'/'.$manufacturing_date[0];
							
							$expiry_date        = explode('-',$brow['prod_exp_date']);
							$expiry_date		= $expiry_date[1].'/'.$expiry_date[0];
						?>
						<div class="tab-content">
                            <div class="tab-pane active row">
                                <div class="col-md-6">
                                    <ul class="tabled-data">
                                        <li>
                                            <label>SKU</label>
                                            <div class="value"><?php echo $prow['prod_id']; ?></div>
                                        </li>
                                        <li>
                                            <label>Batch No</label>
                                            <div class="value"><?php echo $brow['prod_batch_no']; ?></div>
                                        </li>
                                        <li>
                                            <label>Manufacturing Date</label>
                                            <div class="value"><?php echo $manufacturing_date; ?></div>
                                        </li>
                                        <li>
                                            <label>Expiry Date</label>
                                            <div class="value"><?php echo $expiry_date; ?></div>
                                        </li>
                                        <li>
                                            <label>Origin</label>
                                            <div class="value"><?php echo ucwords($brow['prod_origin']); ?></div>
                                        </li>
                                        <li>
                                            <label>Material Handling</label>
                                            <div class="value"><?php echo ucwords($brow['prod_handling']) ?></div>
                                        </li>
                                        
                                        <li>
                                            <label>COA</label>
                                            <div class="value"><a href="<?php echo $BaseFolder; ?>/idbpanel/documents/coa/<?php echo $brow['prod_coa'];  ?>" download>View</a></div>
                                        </li>
                                    </ul><!-- /.tabled-data -->
                                </div>
                                <div class="col-md-6">
                                    <ul class="tabled-data">
                                        <li>
                                            <label>Category</label>
                                            <div class="value">
                                            
                                           
                                            <?php $cat_names =  show_full_path($prow['prod_cat'],array());
												foreach($cat_names as $cat_name)
												{
													echo ' <a href="#">'.$cat_name.'</a> ,';
												}
											 ?>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Keywords</label>
                                            <div class="value"><a href="#">Pain Killer</a>, <a href="#">Headache</a></div>
                                        </li>
                                        <li>
                                            <label>dimensions</label>
                                            <div class="value"><?php echo $prow['prod_dimension_l']; ?>x<?php echo $prow['prod_dimension_h']; ?>x<?php echo $prow['prod_dimension_w']; ?> cm</div>
                                        </li>
                                        <li>
                                            <label>Unit weight</label>
                                            <div class="value"><?php echo $prow['prod_nett_weight']; ?> <?php echo $prow['prod_unit_weight']; ?></div>
                                        </li>
                                        <li>
                                            <label>Gross Weight</label>
                                            <div class="value"><?php echo $prow['prod_gross_weight']; ?> <?php echo $prow['prod_unit_weight']; ?></div>
                                        </li>
                                        <?php
											if($brow['prod_mrp']!='')
											{ 
										?>
                                        <li>
                                            <label>M.R.P.</label>
                                            <div class="value">Rs. <?php echo $brow['prod_mrp']; ?></div>
                                        </li>
                                        <?php 
											}
										?>
                                        
                                        <?php
											$pcrow = checkExist('tbl_packing' ,array('id'=>$prow['prod_packing']));
										
										?>
                                        <li>
                                            <label>Packaging</label>
                                            <div class="value"><?php echo  ucwords($pcrow['packing_name']); ?></div>
                                        </li>
                                        <li>
                                            <label>Manufactured By</label>
                                            <div class="value"><?php echo ucwords($prow['prod_manufactured']); ?></div>
                                        </li>
                                        <?php
										if($prow['prod_manufactured_number']!="")
										{
										?>
                                        <li>
                                            <label>Manufacturer Licence No</label>
                                            <div class="value"><?php echo $prow['prod_manufactured_number']; ?></div>
                                        </li>
                                        <?php
										}?>
                                         <?php
										if($prow['prod_dmf']!="")
										{
										?>
                                        <li>
                                            <label>DMF</label>
                                            <div class="value"><a href="<?php echo $BaseFolder; ?>/idbpanel/documents/dmf/<?php echo $prow['prod_dmf'];  ?>" download>View</a></div>
                                        </li>
                                        <?php
										}?>
                                    </ul><!-- /.tabled-data -->
                                </div>
                            </div><!-- /.tab-pane #description -->
                        </div>
                    </div><!-- /.tab-holder -->
                </div><!-- /.container -->
            </section><!-- /#single-product-tab -->
            <!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->
            <!-- ========================================= RECENTLY VIEWED ========================================= -->
            <!-- /#recently-reviewd -->
             <!-- ============================================================= FOOTER ============================================================= -->
            <?php include('st-footer.php'); ?>
            <!-- ============================================================= FOOTER : END ======================================================= -->
        </div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
       
		<!-- For demo purposes – can be removed on production : End -->
    </body>

</html>
