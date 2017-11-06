<?php
	include("include/routines.php");
	checkuser();
	//chkRights(basename($_SERVER['PHP_SELF']));
	// This is for dynamic title, bread crum, etc.

	$product_name  ='';
	$_REQUEST['req_id'];
	if(isset($_REQUEST['req_id']) && $_REQUEST['req_id']!="")
	{
		$sql_request 		= "select * from tbl_product_request where req_id = '".$_REQUEST['req_id']."'";
		$res_request 	= mysqli_query($db_con,$sql_request) or die(mysqli_error($db_con));
		if(mysqli_num_rows($res_request)!=0)
		{
			$row_request  	= mysqli_fetch_array($res_request);
		    $product_name   = $row_request['prod_name'];
		}
		
	}

	if(isset($_GET['pag']))
	{
		$title 	= $_GET['pag'];
	}
	else
	{
		$title	= 'Add Products';	
	}
	$path_parts   		= pathinfo(__FILE__);
	$filename 	  		= $path_parts['filename'].".php";
	$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
	$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
	$row_feature  		= mysqli_fetch_row($result_feature);
	$feature_name 		= 'Add Products'; // $row_feature[1];
	$home_name    		= "Home";
	$home_url 	  		= "view_dashboard.php?pag=Dashboard";
	$utype				= $_SESSION['panel_user']['utype'];
	$tbl_users_owner 	= $_SESSION['panel_user']['tbl_users_owner'];
?>
<!DOCTYPE html>
<html>
	<head>
    <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
    ?>
    <script type="text/javascript" src="js/add_product.js"></script>
    <style>
        .input-large{
       
        }
    </style>
    </head>
	<body  class="<?php echo $theme_name;?>" data-theme="<?php echo $theme_name;?>" >
    	<?php
		/*include Bootstrap model pop up for error display*/
		modelPopUp();
		/*include Bootstrap model pop up for error display*/
		/* this function used to add navigation menu to the page*/
		navigation_menu();
		/* this function used to add navigation menu to the page*/
		?> <!-- Navigation Bar -->
        <div class="container-fluid" id="content">
        	<div id="main" style="margin-left:0px !important">
            	<div class="container-fluid" id="div_view_spec">
					<?php
                    /* this function used to add navigation menu to the page*/
                    breadcrumbs($home_url,$home_name,'Add Products',$filename,$feature_name);
                    /* this function used to add navigation menu to the page*/
                    ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        <?php echo $feature_name; ?>
                                    </h3>
                                    <button type="button" class="btn-info_1" style= "float:right" onClick="window.close()" >
                                    	<i class="icon-arrow-left"></i>&nbsp Back
                                   	</button>
                                </div>
                                <div class="box-content nopadding">
                                
                                	<form id="frm_add_prod" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <input type="hidden"  value="1" name="add_product_req" id="add_product_req"> 
                                    	
                                    	<div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Category<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                        	<div class="controls" id="">
                                            <select data-rule-required="true" onChange="getCat(this.value);getPacking(this.value);getFactor(this.value);productType(this.value);getApplication(this.value);" name="txt_type" id="txt_type"  class = "select2-me input-xlarge" >
                                            <option  value="">Select Category</option>
                                            <?php
											
											$sql = " SELECT * FROM tbl_category WHERE cat_status =1  AND cat_type = 'parent' ";
											$res = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
											while($row = mysqli_fetch_array($res))
											{
											  echo '<option value="'.$row['cat_id'].'" ';
											  if($row['cat_name']=='row')
											  {
												  echo ' selected ';
											  }
											  echo '>'.ucwords($row['cat_name']).'</option>';
											}
											?>
											</select>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Sub Category<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                 <select name="txt_cat" id="txt_cat" class = "select2-me input-xlarge"   data-rule-required="true" >
                                            	<?php
											// Query For getting all categories from the system
											$sql_get_cats	= " SELECT * FROM `tbl_category` ";
											$sql_get_cats	.= " WHERE `cat_status`='1' ";
											$sql_get_cats	.= " 	AND `cat_name`!='none' ";
											$sql_get_cats	.= " 	AND `cat_type`='parent' ";
											$sql_get_cats	.= " 	AND `cat_id`='1' ";
											$sql_get_cats	.= " ORDER BY `cat_name` ASC ";
											$res_get_cats	= mysqli_query($db_con, $sql_get_cats) or die(mysqli_error($db_con));
											$num_get_cats	= mysqli_num_rows($res_get_cats);
											
											if($num_get_cats != 0)
											{
												?>
												<option  value="">Select Sub Category</option>
												<?php
												while($row_get_cats = mysqli_fetch_array($res_get_cats))
												{
													?>
													<option value="<?php echo $row_get_cats['cat_id']; ?>">
														<?php echo ucwords($row_get_cats['cat_name']); ?>
													</option>
													<?php
													echo getSubCatValue($row_get_cats['cat_id'], 'add');
												}
											}
											else
											{
												?>
												<option value="">No Match Found</option>
												<?php	
											}
											?>
                                                </select>
                                            
                                            </div>
                                        </div>	<!-- Product Name -->
                                    
                                       <!-- 	<div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Model Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" placeholder="Model Number" id="prod_model_number" name="prod_model_number" class="input-large" data-rule-required="true" />
                                            </div>
                                        </div>	 --><!-- Product Model Number -->
                                        
                                        
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Product Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Product Name" id="prod_name" name="prod_name" class="input-xlarge" value="<?php echo @$product_name; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Product Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           <input type="file" name="prod_img" accept="image/*">
                                            </div>
                                        </div><!--Image Type-->
                                        
                                        
                                         <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Product Id<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Product ID" id="vprod_id" name="vprod_id" class="input-xlarge" value="<?php echo @$vprod_id; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->
                                        
                                        <div class="control-group span6" >
                                        	<label for="tasktitel" class="control-label">Pharmacopia<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            <select name="txt_pharmacopia" id="txt_pharmacopia" onChange="loadData();" data-rule-required="true"   class = "select2-me input-xlarge" >
                                            	<?php
											// Query For getting all categories from the system
											$sql_get_pharmacopia	= " SELECT * FROM `tbl_pharmacopia` ";
											$sql_get_pharmacopia	.= " WHERE `pharmacopia_status`='1' ";
										    $sql_get_pharmacopia	.= " ORDER BY `pharmacopia_name` ASC ";
											$res_get_pharmacopia	= mysqli_query($db_con, $sql_get_pharmacopia) or die(mysqli_error($db_con));
											$num_get_pharmacopia	= mysqli_num_rows($res_get_pharmacopia);
											
											if($num_get_pharmacopia != 0)
											{
												?>
												<option  value="">Select Pharmacopia</option>
												<?php
												while($row_get_pharmacopia = mysqli_fetch_array($res_get_pharmacopia))
												{
													?>
													<option value="<?php echo $row_get_pharmacopia['pharmacopia_id']; ?>">
														<?php echo ucwords($row_get_pharmacopia['pharmacopia_name']); ?>
													</option>
													<?php
												}
											}
											else
											{
												?>
												<option value="">No Match Found</option>
												<?php	
											}
											?>
                                                </select>
                                            </div>
                                        </div><!--Pharmacopia-->

                                        <div class="control-group span6" id="div_form_factor">
                                        	<label for="tasktitel" class="control-label">Form Factor<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
	                                            <select name="txt_factor" id="txt_factor"  class = "select2-me input-xlarge" >
	                                            	<?php
												// Query For getting all categories from the system
												$sql_get_factor	= " SELECT * FROM `tbl_form_factor` ";
												$sql_get_factor	.= " WHERE `status`='1' ";
											    $sql_get_factor	.= " ORDER BY `form_factor_name` ASC ";
												$res_get_factor	= mysqli_query($db_con, $sql_get_factor) or die(mysqli_error($db_con));
												$num_get_factor	= mysqli_num_rows($res_get_factor);
												
												if($num_get_factor != 0)
												{
													?>
													<option  value="">Select Form Factor</option>
													<?php
													while($row_get_factor = mysqli_fetch_array($res_get_factor))
													{
														?>
														<option value="<?php echo $row_get_factor['cat_id']; ?>">
															<?php echo ucwords($row_get_factor['form_factor_name']); ?>
														</option>
														<?php
													}
												}
												else
												{
													?>
													<option value="">No Match Found</option>
													<?php	
												}
												?>
                                                </select>
                                            </div>
                                        </div><!--form factor-->
                                        


                                        

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Composition Type<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                        	<div class="controls" id="">
	                                            <select name="txt_cmp_cat" id="txt_cmp_cat" onChange="showComposition(this.value);"  class = "select2-me input-xlarge"   data-rule-required="true" >
	                                            <option  value="">Select Composition Type</option>
	                                            <option value="Generic">Generic</option>
	                                            <option value="Combination">Combination</option>
	                                            <option value="Special">Special</option>
												</select>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->
                                        
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Composition<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                             <?php
											// Query For getting all categories from the system
											$sql_get_composition	= " SELECT * FROM `tbl_composition` ";
											$sql_get_composition	.= " WHERE `spec_status`='1' ";
										    $sql_get_composition	.= " ORDER BY `spec_name` ASC ";
											$res_get_composition	= mysqli_query($db_con, $sql_get_composition) or die(mysqli_error($db_con));
											$num_get_composition	= mysqli_num_rows($res_get_composition);
											
											if($num_get_composition != 0)
											{
											?>
                                            <div class="controls" id="single">
                                            <select name="txt_cmp" id="txt_cmp"  class = "select2-me input-xlarge"   data-rule-required="true" >
                                            <option  value="">Select Composition</option>
                                            <?php 
											while($row_get_composition= mysqli_fetch_array($res_get_composition))
											{?>
												<option value="<?php echo $row_get_composition['spec_id']; ?>">
                                                <?php echo ucwords($row_get_composition['spec_name']); ?>
                                                </option>
											<?php 
											}
											?>
											
											</select>
                                            </div><!--single-->


						
                                            <div class="controls" style="display:none;" id="multiple">
                                            <select multiple="multiple"  id="prod_catid" onChange="console.log($(this).children(":selected").length)" name="txt_cmp_type" id="txt_cmp_type" placeholder="Select Composition"  class = "select2-me input-xlarge"  data-rule-required="true" >
                                            <?php 
											$res_get_composition	= mysqli_query($db_con, $sql_get_composition) or die(mysqli_error($db_con));
											while($row_get_composition= mysqli_fetch_array($res_get_composition))
											{?>
												<option value="<?php echo $row_get_composition['spec_id']; ?>">
                                                <?php echo ucwords($row_get_composition['spec_name']); ?>
                                                </option>
											<?php 
											}
											?>
											</select>
                                            </div><!--multiple and specilized-->
                                            <?php 
											} 
											else
											{
											?>
                                            <div class="controls"  id="multiple">
                                            <select multiple="multiple"  onChange="console.log($(this).children(":selected").length)" name="txt_cmp" id="txt_cmp" onChange="loadData();"  class = "select2-me input-xlarge" 
                                            >
                                            <option  value="">Select Composition</option>
											
											</select>
                                            </div><!--No match found-->
                                            <?php
											 } ?>
                                        </div><!--Composition Type-->
                                        
                                        
                                        
                                      <!--   
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Drug Type<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           
                                            <div class="controls">
                                            <select name="txt_drug_type" id="txt_drug_type" onChange="showComposition(this.value);"  class = "select2-me input-large" style="width:90%">
                                            <option  value="">Select Drug Type</option>
											<option  value="Single">Single</option>
                                            <option  value="Multiple">Multiple</option>
                                            <option  value="Specialized">Specialized</option>
											</select>
                                            </div>
                                        </div> --><!--Composition Type-->
                                        <!-- =============================================================== -->
                                         <!-- ======================Start For Formulation====================== -->
                                        <div class="control-group span6" id="div_cost_effective_pack" style="display: none">
                                        	<label for="tasktitel" class="control-label">Cost Effective Pack<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" placeholder="Cost Effective Pack" id="txt_cost_effective_pack" name="txt_cost_effective_pack" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- Cost Efective Pack -->

                                        <div class="control-group span6" id="div_stadard_pack" style="display: none">
                                        	<label for="tasktitel" class="control-label">Sellable Standard Pack<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" placeholder="Sellable Standard Pack" id="txt_stadard_pack" name="txt_stadard_pack" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- Sellable Standard Pack -->

                                        <div class="control-group span6" id="div_shipper" style="display: none">
                                        	<label for="tasktitel" class="control-label">Shipper <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" placeholder="Shipper" id="txt_shipper" name="txt_shipper" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- txt_shipper -->

                                        <!-- ======================End For Formulation====================== -->
                                        <!-- =============================================================== -->
                                        
                                        
                                        <div class="control-group span6" >
                                        	<label for="tasktitel" class="control-label">Tax Class<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <select name="txt_tax" id="txt_tax"  class = "select2-me input-xlarge"   data-rule-required="true" >
                                            <?php
											// Query For getting all categories from the system
											$sql_get_gst	= " SELECT * FROM `tbl_gst_master` ";
											$sql_get_gst	.= " WHERE `gst_status`='1' ";
										    $sql_get_gst	.= " ORDER BY `gst_name` ASC ";
											$res_get_gst	= mysqli_query($db_con, $sql_get_gst) or die(mysqli_error($db_con));
											$num_get_gst	= mysqli_num_rows($res_get_gst);
											
											if($num_get_gst!= 0)
											{
											?>
                                            <option  value="">Select Tax Class</option>
											<?php
												while($row_get_gst = mysqli_fetch_array($res_get_gst))
												{
													?>
													<option value="<?php echo $row_get_gst['gst_id']; ?>">
														<?php echo ucwords($row_get_gst['gst_name']); ?>
													</option>
													<?php
												}
                                           }
											else
											{
											?>
                                            	<option  value="">No Match Found</option>
                                            <?php
											}
											?>
											</select>
                                            </div>
                                        </div><!--Tax Type-->
                                        
                                        <div class="control-group" style="clear: both">
                                        	<label for="tasktitel" class="control-label">Application<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <!--<input placeholder="Application" type="text" name="txt_attribute" id="txt_attribute"  data-rule-required="true"   class=" input-xlarge" style="" />-->
                                           <select multiple="multiple"  id="txt_attribute" onChange="console.log($(this).children(":selected").length)" name="txt_attribute[]" id="txt_attribute"  class = "select2-me input-xlarge"  data-rule-required="true" placeholder="Select Application" >					
                                             
                                              <?php
											// Query For getting all categories from the system
											$sql_get_app	= " SELECT * FROM `tbl_attribute` ";
											$sql_get_app	.= " WHERE `status`='1' ";
										    $sql_get_app	.= " ORDER BY `attribute_name` ASC ";
											$res_get_app	= mysqli_query($db_con,$sql_get_app) or die(mysqli_error($db_con));
											$num_get_app	= mysqli_num_rows($res_get_app);
											
											if($num_get_app != 0)
											{
												while($row_get_app= mysqli_fetch_array($res_get_app))
												{?>
													<option value="<?php echo $row_get_app['id']; ?>">
													<?php echo ucwords($row_get_app['attribute_name']); ?>
													</option>
												<?php 
												}
												?>
											
                                            
                                            <?php 
											}
											?>
											
											</select>
                                           </div>
                                        </div><!--Application (ATTRIBUTE) -->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Length<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Dimension Length" type="text" name="txt_dimensionl" id="txt_dimensionl"   data-rule-required="true"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension length -->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Height<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Dimension Height" type="text" name="txt_dimensionh" id="txt_dimensionh"  data-rule-required="true"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension height-->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Width<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Dimension Width" type="text" name="txt_dimensionw" id="txt_dimensionw"  data-rule-required="true"   class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension weight-->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Unit of Weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <select name="txt_uoweight" id="txt_uoweight"  class="select2-me input-large"   data-rule-required="true" >
                                            <option>Select Unit</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Mg">Mg</option>
                                            <option value="Gms">Gms</option>
											</select>
                                            </div>
                                        </div><!--Unit of weight Type-->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">NETT weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           <input type="text"  placeholder="Enter NETT Weight"  name="txt_nweight"  data-rule-required="true"  id="txt_nweight"  class=" input-large" style=" ">
                                            <!--<select name="txt_nweight" id="txt_nweight"  class="select2-me input-large"  data-rule-required="true" >
                                             
                                            <?php
											// Query For getting all categories from the system
											$sql_get_weight	= " SELECT * FROM `tbl_unit_of_weight` ";
											$sql_get_weight   .= " WHERE `uow_status`='1' ";
										    $sql_get_weight   .= " ORDER BY `uow_name` ASC ";
											$res_get_weight	= mysqli_query($db_con, $sql_get_weight) or die(mysqli_error($db_con));
											$num_get_weight	= mysqli_num_rows($res_get_weight);
											
											if($num_get_weight!= 0)
											{
											?>
                                            <option  value="">Select Weight</option>
											<?php
												while($row_get_weight = mysqli_fetch_array($res_get_weight))
												{
													?>
													<option value="<?php echo $row_get_weight['uow_id']; ?>">
														<?php echo ucwords($row_get_weight['uow_name']); ?> 
													</option>
													<?php
												}
                                           }
											else
											{
											?>
												<option  value="">No Match Found</option>
											<?php
											}
											?>
											</select>-->
                                            </div>
                                        </div><!--NETT weight-->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">GROSS weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           
                                           <input type="text"  placeholder="Enter GROSS Weight"  name="txt_gweight"  data-rule-required="true"  id="txt_gweight"  class=" input-large" style=" ">
                                           
                                            <!--<select name="txt_gweight" id="txt_gweight"  class="select2-me input-large" style="width:90%"  data-rule-required="true" >
                                            <?php
											// Query For getting all categories from the system
											$sql_get_weight	= " SELECT * FROM `tbl_unit_of_weight` ";
											$sql_get_weight   .= " WHERE `uow_status`='1' ";
										    $sql_get_weight   .= " ORDER BY `uow_name` ASC ";
											$res_get_weight	= mysqli_query($db_con, $sql_get_weight) or die(mysqli_error($db_con));
											$num_get_weight	= mysqli_num_rows($res_get_weight);
											
											if($num_get_weight!= 0)
											{
											?>
                                            <option  value="">Select Weight</option>
											<?php
												while($row_get_weight = mysqli_fetch_array($res_get_weight))
												{
													?>
													<option value="<?php echo $row_get_weight['uow_id']; ?>">
														<?php echo ucwords($row_get_weight['uow_name']); ?> 
													</option>
													<?php
												}
                                           }
											else
											{
											?>
												<option  value="">No Match Found</option>
											<?php
											}
											?>
											</select>-->
                                            </div>
                                        </div><!--Gross weight-->
                                        
                                        <div class="control-group span12">
                                        	<label for="tasktitel" class="control-label">Packing<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           
                                            <select name="txt_packing" id="txt_packing"  class = "select2-me input-xlarge"  data-rule-required="true" >
                                            <?php
											// Query For getting all categories from the system
											$sql_get_packing	= " SELECT * FROM `tbl_packing` ";
											$sql_get_packing   .= " WHERE `status`='1' ";
										    $sql_get_packing   .= " ORDER BY `packing_name` ASC ";
											$res_get_packing	= mysqli_query($db_con, $sql_get_packing) or die(mysqli_error($db_con));
											$num_get_packing	= mysqli_num_rows($res_get_packing);
											
											if($num_get_packing!= 0)
											{
											?>
                                            <option  value="">Select Packing</option>
											<?php
												while($row_get_packing = mysqli_fetch_array($res_get_packing))
												{
													?>
													<option value="<?php echo $row_get_packing['id']; ?>">
														<?php echo ucwords($row_get_packing['packing_name']); ?> 
													</option>
													<?php
												}
                                           }
										   else
											{
											?>
												<option  value="">No Match Found</option>
											<?php
											}
											?>
											</select>
                                            </div>
                                        </div><!--Packing Type-->

                                        


                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Manufactured by<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Manufactured by" type="text" name="txt_manufactured"  data-rule-required="true"  id="txt_manufactured"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Manufactured by -->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Manufactured Licence Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Manufactured Licence Number" type="text" name="txt_manufactured_lic"  data-rule-required="true"  id="txt_manufactured_lic"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Manufactured by -->
                                         

                                        


                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">DMF (if Yes or No)</label>
                                           <div class="controls">
                                            <input  type="file" name="img_dmf" id="img_dmf"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Manufactured by -->
                                        

                                        <div class="control-group " style="clear: both;">
                                        	<label for="tasktitel" class="control-label">Meta Keywords<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <textarea style="width:50%" rows="4" name="txt_meta" id="txt_meta" data-rule-required="true" ></textarea> 
                                           </div>
                                        </div><!--Status -->

                                        
                                        
                                        <div class="control-group" style="display: none" id="div_hsn">
                                        	<label for="tasktitel" class="control-label">HSN Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="HSN Number" type="text" name="txt_hsn" id="txt_hsn"  class=" input-large" style=""  data-rule-required="true" />
                                           </div>
                                        </div><!--HSN Number -->
                                        
                                        <div class="control-group" id="div_ean" style="clear: both;display: none" >
                                        	<label for="tasktitel" class="control-label">EAN Number</label>
                                           <div class="controls">
                                            <input placeholder="EAN Number" type="text" name="txt_ean" id="txt_ean"  class=" input-large" style=""   />
                                           </div>
                                        </div><!--EAN Number -->
										
                                       <!--========================Certificate of Analysis /Authenticity===============================//-->
                                        
                                        <div class="control-group span6">
                                      	 <label for="tasktitel" class="control-label">Material Handling
                                        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                           <input type="text"  type="text" id="prod_handling" name="prod_handling"   class="input-large" value="" placeholder="Material Handling" data-rule-required="true" >
                                            </div>
                                        </div> <!-- Prod_handling -->
                                        
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Insurance<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input type="radio" name="txt_insurance" value="1" class="css-radio" data-rule-required="true" checked > Active
                                         <input type="radio" name="txt_insurance" value="0" class="css-radio" data-rule-required="true"  > Inactive
                                            </div>
                                        </div><!--Insurance -->

                                        <div class="control-group " style="clear:both">
                                        	<label for="tasktitel" class="control-label">Status<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input type="radio" name="txt_status" value="1" class="css-radio" data-rule-required="true" checked > Active 
                                         <input type="radio" name="txt_status" value="0" class="css-radio" data-rule-required="true"  > Inactive 
                                            </div>
                                        </div><!--Status -->
                                        
                                        
										 <div class="form-actions" style="clear:both">
                                         <button type="submit" name="reg_submit_add" class="btn-success">Add Product</button>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                       	</div>
                   	</div>

               	</div>
           	</div>
       	</div>
        
    <!--======================Start : Javascript Dn By satish 12sep2017=========================-->
       <script type="text/javascript" >
	   	
			function showComposition(type)
			{
				if(type !="Combination")
				{
					$('#single').css('display','block');
					$('#multiple').css('display','none');
				}
				else
				{
					$('#single').css('display','none');
					$('#multiple').css('display','block');
				}
			}
			
			
			$('#frm_add_prod').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_add_prod').valid())
				{
					
					$.ajax({
						url: "load_products.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert("Product Added Successfully");
								window.location.assign("view_products.php?pag=Products");
							} 
							else 
							{
								//alert("Wrong Entries");
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
						}
					});
				}
			});		
	   	
		
		   function getCat(cat_id)
		   {
			   
				if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getCat":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_cat').html(data.resp);
						} 
						else 
						{
							
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
							$('#error_model').modal('toggle');
							loading_hide();					
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
						$('#error_model').modal('toggle');
						loading_hide();
					},
					complete: function()
					{
						loading_hide();	
					}
				});		
		
		
		   }
		   
		   
		   function getPacking(cat_id)
		   {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getPacking":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_packing').html(data.resp);
						} 
						else 
						{
							
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
							$('#error_model').modal('toggle');
							loading_hide();					
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
						$('#error_model').modal('toggle');
						loading_hide();
					},
					complete: function()
					{
						loading_hide();	
					}
				});		
		
		
		   }
		   
		    function getFactor(cat_id)
		    {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getFactor":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_factor').html(data.resp);
						} 
						else 
						{
						
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
							$('#error_model').modal('toggle');
							loading_hide();					
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
						$('#error_model').modal('toggle');
						loading_hide();
					},
					complete: function()
					{
						loading_hide();	
					}
				});		
		
		
		   }
		   function getApplication(cat_id)
		    {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getApplication":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_attribute').html(data.resp);
						} 
						else 
						{
						
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
							$('#error_model').modal('toggle');
							loading_hide();					
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
						$('#error_model').modal('toggle');
						loading_hide();
					},
					complete: function()
					{
						loading_hide();	
					}
				});		
		
		
		   }
	   </script>
     <!--======================Start : Javascript Dn By satish 12sep2017=========================-->
    </body>
</html>