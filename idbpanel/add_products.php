<?php
	include("include/routines.php");
	checkuser();
	//chkRights(basename($_SERVER['PHP_SELF']));
	// This is for dynamic title, bread crum, etc.
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
                                    <button type="button" class="btn-info_1" style= "float:right" onClick="location.href='<?php echo $BaseFolder; ?>view_products.php';" >
                                    	<i class="icon-arrow-left"></i>&nbsp Back
                                   	</button>
                                </div>
                                <div class="box-content nopadding">
                                	<form id="frm_add_prod" class="form-horizontal form-bordered form-validate" >
                                    	
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Product Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" id="prod_name" name="prod_name" class="input-large keyup-char" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- Product Name -->
                                    
                                    	<div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Model Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<input type="text" id="prod_model_number" name="prod_model_number" class="input-large keyup-char" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- Product Model Number -->
                                        
                                        <div class="control-group" style="clear:both;">
                                        	<label for="tasktitel" class="control-label">Description<sup class="validfield"></sup></label>
                                            <div class="controls">
                                            	<textarea id="prod_description" name="prod_description" ></textarea>
                                            </div>
                                        </div> <!-- Product Description -->
                                        
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Organisation/Company<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                       	</div>
                   	</div>
               	</div>
           	</div>
       	</div>
    </body>
</html>