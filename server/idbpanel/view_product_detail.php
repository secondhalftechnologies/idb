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
		$title	= 'View Product';	
	}

	if(isset($_REQUEST['product_id']) && $_REQUEST['product_id']!="")
	{
		$product_id = $_REQUEST['product_id'];
		$prod_row        = checkExist('tbl_products' ,array('id'=>$product_id));
	}

	$path_parts   		= pathinfo(__FILE__);
	$filename 	  		= $path_parts['filename'].".php";
	$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
	$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
	$row_feature  		= mysqli_fetch_row($result_feature);
	$feature_name 		= 'View Product'; // $row_feature[1];
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
                    breadcrumbs($home_url,$home_name,'View Product',$filename,$feature_name);
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
                                    <a href="view_products.php?pag=Products" class="btn-info_1" style= "float:right;color: white" >
                                    	<i class="icon-arrow-left"></i>&nbsp; Back
                                   	</a>
                                </div>
                                <div class="box-content nopadding">
                                
                                	<form id="frm_add_prod" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <input type="hidden"  value="1" name="add_product_req" id="add_product_req"> 
                                    	
                                    	<div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Category</label>
                                        	<div class="controls" id="">
                                              <?php $cat_name = lookupValue('tbl_category','cat_name',array('cat_id'=>$prod_row['prod_type']));
                                            echo ucwords($cat_name);
                                             ?>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Sub Category<sup class="validfield"></label>
                                            <div class="controls">
                                                 <?php 
                                                 $cat_name = lookupValue('tbl_category','cat_name',array('cat_id'=>$prod_row['prod_cat']));
                                            echo ucwords($cat_name);
                                             ?>
                                            </div>
                                        </div>	<!-- Product Name -->
                                    
                                      
                                        
                                        
                                        <div class="control-group" style="clear: both">
                                        	<label for="tasktitel" class="control-label">Product Name</label>
                                            <div class="controls">
                                                	<?php echo @ucwords($prod_row['prod_name']); ?>
                                            </div>
                                        </div><!--Category=====-->


                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Product Image</label>
                                           <div class="controls">
                                           <?php
                                           echo $prod_row['image_name'];
                                           $image_name = lookupValue('tbl_product_images','image_name',array('prod_id'=>$prod_row['id']));
                                           ?>
                                          <img style="height: 100px;width: 100px" src="../images/products/prodid_<?php echo $prod_row['id'] ?>/small/<?php echo $image_name; ?>" alt="" />
                                            </div>
                                        </div><!--Image Type-->
                                        
                                        
                                        
                                        
                                        <div class="control-group span6" >
                                        	<label for="tasktitel" class="control-label">Pharmacopia</label>
                                            <div class="controls">
											<?php $pharmacopia = lookupValue('tbl_pharmacopia','pharmacopia_name',array('pharmacopia_id'=>$prod_row['prod_pharmacopia']));
                                            echo $pharmacopia;
                                             ?>
                                           </div>
                                        </div><!--Pharmacopia-->


                                        <div class="control-group span6" id="div_form_factor">
                                        	<label for="tasktitel" class="control-label">Form Factor</label>
                                            <div class="controls">
	                                            <?php $ffcator = lookupValue('tbl_form_factor','form_factor_name',array('id'=>$prod_row['prod_factor']));
                                            echo ucwords($ffcator);
                                             ?>
                                            </div>
                                        </div><!--form factor-->
                                        


                                        

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Composition Type</label>
                                        	<div class="controls" id="">
	                                            <?php echo $prod_row['prod_comp_cat']; ?>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->
                                        
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Composition</label>
                                             <div class="controls"  id="multiple">
                                           <?php
											// Query For getting all categories from the system
											$sql_get_composition	= " SELECT * FROM `tbl_composition` ";
											$sql_get_composition	.= " WHERE `spec_status`='1' ";
											$sql_get_composition	.= " AND spec_id IN ";
											$sql_get_composition	.= " ( SELECT DISTINCT composition_id FROM tbl_product_compositions WHERE product_id ='".$prod_row['id']."') ";
										   $sql_get_composition	.= " ORDER BY `spec_name` ASC ";
											$res_get_composition	= mysqli_query($db_con, $sql_get_composition) or die(mysqli_error($db_con));
											$num_get_composition	= mysqli_num_rows($res_get_composition);
											$comp_array = array();
											if($num_get_composition != 0)
											{
											
											while($row_get_composition= mysqli_fetch_array($res_get_composition))
											{
												array_push($comp_array,ucwords($row_get_composition['spec_name']));
											
											}
											echo implode(',',$comp_array);
										}
											?>
                                            </div><!--multiple and specilized-->
                                            
                                        </div><!--Composition Type-->
                                        
                                        
                                        
                                     
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

                                        <div class="control-group span12" id="div_shipper" style="display: none">
                                        	<label for="tasktitel" class="control-label">Shipper <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" placeholder="Shipper" id="txt_shipper" name="txt_shipper" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- txt_shipper -->

                                        <!-- ======================End For Formulation====================== -->
                                        <!-- =============================================================== -->
                                        
                                        
                                        <div class="control-group span12" >
                                        	<label for="tasktitel" class="control-label">Tax Class</label>
                                           <div class="controls">
                                           

                                             <?php $tax = lookupValue('tbl_gst_master','gst_name',array('gst_id'=>$prod_row['prod_tax']));
                                            echo ucwords($tax).' %';
                                             ?>
                                            
                                            </div>
                                        </div><!--Tax Type-->
                                        
                                        <div class="control-group" style="clear: both">
                                        	<label for="tasktitel" class="control-label">Application</label>
                                           <div class="controls">
                                            <?php 
                                            $sql_get_attribute   =" SELECT attribute_name FROM tbl_attribute WHERE ";
                                             $sql_get_attribute .=" id IN (SELECT DISTINCT attribute_id FROM tbl_product_attributes WHERE product_id='".$prod_row['id']."')  ";
                                             $res_get_attribute =mysqli_query($db_con,$sql_get_attribute) or die(mysqli_error($db_con));
                                             $attribute_array  = array();
                                             while($row_get_attribute =mysqli_fetch_array($res_get_attribute))
                                             {
                                             	array_push($attribute_array,ucwords($row_get_attribute['attribute_name']));
                                             }
                                             echo implode(',',$attribute_array);
                                            ?>
                                            </div>
                                        </div><!--Application (ATTRIBUTE) -->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Length</label>
                                           <div class="controls">
                                             <?php 
                                            echo ucwords($prod_row['prod_dimension_l']);
                                             ?>
                                           </div>
                                        </div><!--Dimension length -->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Height</label>
                                           <div class="controls">
                                            <?php 
                                            echo ucwords($prod_row['prod_dimension_h']);
                                             ?>
                                           </div>
                                        </div><!--Dimension height-->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Dimension Width</label>
                                           <div class="controls">
                                              <?php 
                                            echo ucwords($prod_row['prod_dimension_w']);
                                             ?>
                                           </div>
                                        </div><!--Dimension weight-->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Unit of Weight</label>
                                           <div class="controls">
                                           <?php
                                           	echo ucwords($prod_row['prod_unit_weight']);
                                             ?>
                                            </div>
                                        </div><!--Unit of weight Type-->

                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">NETT weight</label>
                                           <div class="controls">
                                           <?php
                                           	echo ucwords($prod_row['prod_nett_weight']);
                                             ?>
                                            </div>
                                        </div><!--NETT weight-->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">GROSS weight </label>
                                           <div class="controls">
                                           
                                           <?php
                                           	echo ucwords($prod_row['prod_gross_weight']);
                                             ?>
                                            </div>
                                        </div><!--Gross weight-->
                                        
                                        <div class="control-group span12">
                                        	<label for="tasktitel" class="control-label">Packing</label>
                                           <div class="controls">
                                           <?php $prod_packing = lookupValue('tbl_packing','packing_name',array('id'=>$prod_row['prod_packing']));
                                            echo ucwords($prod_packing);
                                             ?>
                                            </div>
                                        </div><!--Packing Type-->
                                        
                                        
                                         <div class="control-group span12">
                                        	<label for="tasktitel" class="control-label">Commission</label>
                                           <div class="controls">
                                           <?php $prod_commission = lookupValue('tbl_gst_master','gst_name',array('gst_id'=>$prod_row['prod_commission']));
                                            echo ucwords($prod_commission).' %';
                                             ?>
                                            </div>
                                        </div><!--Packing Type-->

                                        


                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Manufactured by</label>
                                           <div class="controls">
                                            <?php echo ucfirst($prod_row['prod_manufactured']); ?>
                                           </div>
                                        </div><!--Manufactured by -->
                                        
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">Manufactured Licence Number<sup class="validfield"></label>
                                           <div class="controls">
                                             <?php echo ucfirst($prod_row['prod_manufactured_number']); ?>
                                           </div>
                                        </div><!--Manufactured by -->
                                         

                                        

                                        <?php 

                                        if($prod_row[' prod_dmf'])
                                        {
										?>
                                        <div class="control-group span4">
                                        	<label for="tasktitel" class="control-label">DMF</label>
                                           <div class="controls">
                                          	
                                           </div>
                                        </div><!--Manufactured by -->
                                        <?php
                                    	}
                                    	?>
										<div class="control-group" style="display: none" id="div_hsn">
                                        	<label for="tasktitel" class="control-label">HSN Number</label>
                                           <div class="controls">
                                            <?php echo ucfirst($prod_row['prod_hsn']); ?>
                                           </div>
                                        </div><!--HSN Number -->
                                        
                                        <div class="control-group" id="div_ean" style="clear: both;display: none" >
                                        	<label for="tasktitel" class="control-label">EAN Number</label>
                                           <div class="controls">
                                            <?php echo ucfirst($prod_row['prod_ean']); ?>
                                           </div>
                                        </div><!--EAN Number -->
										
                                       <!--========================Certificate of Analysis /Authenticity===============================//-->
                                        
                                        <div class="control-group" style="clear:both">
                                      	 <label for="tasktitel" class="control-label">Material Handling
                                        </label>
                                            <div class="controls">
                                           <?php echo ucfirst($prod_row['prod_handling']); ?>
                                            </div>
                                        </div> <!-- Prod_handling -->
                                        
                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Insurance</label>
                                           <div class="controls">
                                            <?php
                                            if($prod_row['prod_insurance']==1)
                                            {
                                            	echo 'Yes';
                                            }
                                            else
                                            {
                                            	echo 'No';
                                            }
                                            ?>
                                            </div>
                                        </div><!--Insurance -->
										
                                        <div class="control-group " style="clear: both;">
                                        	<label for="tasktitel" class="control-label">Meta Keywords</label>
                                           <div class="controls">
                                        <?php echo $prod_row['prod_meta_tags']; ?>
                                           </div>
                                        </div><!--Meta Keywords -->
                                        
                                        <div class="control-group " style="clear:both">
                                        	<label for="tasktitel" class="control-label">Status<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <?php
                                            if($prod_row['prod_status']==1)
                                            {
                                            	echo 'Active';
                                            }else
                                            {
                                            	echo 'Inactive';
                                            }
                                            ?>
                                            </div>
                                        </div><!--Status -->
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