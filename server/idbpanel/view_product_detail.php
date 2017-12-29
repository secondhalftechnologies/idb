<?php
    include("include/routines.php");
    checkuser();
    //chkRights(basename($_SERVER['PHP_SELF']));
    // This is for dynamic title, bread crum, etc.

    $product_name  ='';
    $_REQUEST['req_id'];
    if(isset($_REQUEST['req_id']) && $_REQUEST['req_id']!="")
    {
        $sql_request        = "select * from tbl_product_request where req_id = '".$_REQUEST['req_id']."'";
        $res_request    = mysqli_query($db_con,$sql_request) or die(mysqli_error($db_con));
        if(mysqli_num_rows($res_request)!=0)
        {
            $row_request    = mysqli_fetch_array($res_request);
            $product_name   = $row_request['prod_name'];
        }
        
    }

    if(isset($_GET['pag']))
    {
        $title  = $_GET['pag'];
    }
    else
    {
        $title  = 'View Product';   
    }
    $path_parts         = pathinfo(__FILE__);
    $filename           = $path_parts['filename'].".php";
    $sql_feature        = "select * from tbl_admin_features where af_page_url = '".$filename."'";
    $result_feature     = mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
    $row_feature        = mysqli_fetch_row($result_feature);
    $feature_name       = 'View Product'; // $row_feature[1];
    $home_name          = "Home";
    $home_url           = "view_dashboard.php?pag=Dashboard";
    $utype              = $_SESSION['panel_user']['utype'];
    $tbl_users_owner    = $_SESSION['panel_user']['tbl_users_owner'];


    if(isset($_REQUEST['product_id']) && $_REQUEST['product_id']!="")
    {
        $product_id = $_REQUEST['product_id'];
        $prod_row        = checkExist('tbl_products' ,array('id'=>$product_id));
    }
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
                    breadcrumbs($home_url,$home_name,'Edit Product',$filename,$feature_name);
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
                                    <a  class="btn-info_1" href="view_products.php?pag=Products" style= "float:right;color:white" onClick="window.close()" >
                                        <i class="icon-arrow-left"></i>&nbsp; Back
                                    </a>
                                </div>
                                <div class="box-content nopadding">
                                
                                    <form id="frm_update_prod" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <input type="hidden"  value="1" name="update_product_req" id="update_product_req"> 
                                        <input type="hidden"  value="<?php echo $product_id; ?>" name="product_id" id="product_id"> 
                                        <div class="control-group span6">
                                            <label for="tasktitel" class="control-label">Category</label>
                                            <div class="controls" id="">
                                            <?php $cat_name = lookupValue('tbl_category','cat_name',array('cat_id'=>$prod_row['prod_type']));
                                            echo ucwords($cat_name);
                                             ?>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->

                                        <div class="control-group span6">
                                            <label for="tasktitel" class="control-label">Sub Category</label>
                                            <div class="controls">
                                            <?php 
                                                 $cat_name = lookupValue('tbl_category','cat_name',array('cat_id'=>$prod_row['prod_cat']));
                                                  echo ucwords($cat_name);
                                             ?>
                                            </div>
                                        </div>  <!-- Product Name -->
                                    
                                        <div class="control-group" style="clear: both">
                                            <label for="tasktitel" class="control-label">Product Name</label>
                                            <div class="controls">
                                                <?php echo $prod_row['prod_name'] ?>
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
                                           
                                           <?php $pharmacopia_name = lookupValue('tbl_pharmacopia','pharmacopia_name',array('pharmacopia_id'=>$prod_row['prod_pharmacopia']));
                                            echo ucwords($pharmacopia_name);
                                             ?>
                                             
                                              
                                            </div>
                                        </div><!--Pharmacopia-->

                                        <div class="control-group span6" id="div_form_factor">
                                            <label for="tasktitel" class="control-label">Form Factor</label>
                                            <div class="controls">
                                                <?php $prod_factor = lookupValue('tbl_form_factor','form_factor_name',array('cat_id'=>$prod_row['prod_factor']));
                                                echo ucwords($prod_factor);
                                                 ?>
                                            </div>
                                        </div><!--form factor-->
                                        
                                        <div class="control-group span6">
                                            <label for="tasktitel" class="control-label">Composition Type</label>
                                           
                                            <div class="controls" id="">
                                                 <?php 
                                                echo ucwords($prod_row['prod_comp_cat']);
                                               ?>
                                          </div><!--single-->
                                        </div><!-- Composition TYpe -->
                                        
                                        <div class="control-group span6">
                                            <label for="tasktitel" class="control-label">Composition<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                             

                                            <?php

                                            $sql_get_prod_comp = "SELECT * FROM tbl_product_composition WHERE product_id='".$product_id."' ";
                                            $res_get_prod_comp =mysqli_query($db_con,$sql_get_prod_comp) or die(mysqli_error($db_con));
                                            $comp_array = array();
                                            while($row_get_prod_comp = mysqli_fetch_array($res_get_prod_comp))
                                            {
                                                array_push($comp_array,$row_get_prod_comp['composition_id']);
                                            }

                                            // Query For getting all categories from the system
                                            $sql_get_composition    = " SELECT * FROM `tbl_composition` ";
                                            $sql_get_composition    .= " WHERE `spec_status`='1' ";
                                             $sql_get_composition    .= " AND spec_id IN (".implode(',',$comp_array).") ";
                                            $sql_get_composition    .= " ORDER BY `spec_name` ASC ";
                                            $res_get_composition    = mysqli_query($db_con, $sql_get_composition) or die(mysqli_error($db_con));
                                            $num_get_composition    = mysqli_num_rows($res_get_composition);
                                            
                                            if($num_get_composition != 0)
                                            {
                                                $style      = '';
                                                $style1      = '';
                                                if($prod_row['prod_comp_cat']=='Combination')
                                                {
                                                    $style      = 'display:none';
                                                }
                                                else
                                                {
                                                    $style1      = 'display:none';
                                                }
                                            ?>

                                                <div class="controls" id="single" style="<?php echo $style; ?>">
                                                    
                                                    <?php 
                                                    $comp_name_arr
                                                    while($row_get_composition= mysqli_fetch_array($res_get_composition))
                                                    {
                                                        array_push($comp_name_arr,$row_get_composition['spec_name']);
                                                    }
                                                    ?>
                                                    </select>
                                                </div><!--single-->


                                                    
                                                <div class="controls" style="<?php echo $style1; ?>" id="multiple">
                                                    <select multiple="multiple"  id="prod_catid" onChange="console.log($(this).children(":selected").length)" name="txt_cmp_type[]" id="txt_cmp_type" placeholder="Select Composition"  class = "select2-me input-xlarge"  data-rule-required="true" >
                                                    <?php 
                                                    $res_get_composition    = mysqli_query($db_con, $sql_get_composition) or die(mysqli_error($db_con));
                                                    while($row_get_composition= mysqli_fetch_array($res_get_composition))
                                                    {
                                                        echo '<option value="'.$row_get_composition['spec_id'].'"';
                                                        if(in_array($row_get_composition['spec_id'], $comp_array))
                                                        {
                                                            echo ' selected ';
                                                        }
                                                        echo '>'.ucwords($row_get_composition['spec_name']).'</option>';
                                                    
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
                                         <!-- =============================================================== -->
                                         <!-- ======================Start For div_generic_name====================== -->
                                        <div class="control-group span6" id="div_generic_name" style="display: none">
                                            <label for="tasktitel" class="control-label">Generic Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <input type="text" placeholder="Generic Name" id="generic_name" name="generic_name" class="input-xlarge" value="<?php echo $prod_row['generic_name'] ?>" data-rule-required="true" />
                                            </div>
                                        </div>  <!-- Generic Name -->

                                        <div class="control-group span6" id="div_size_attribute" style="display: none">
                                            <label for="tasktitel" class="control-label">Size Attribute<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <?php
                                                 $size_att_arr  = array('small','large','xl');
                                                 ?>
                                                <select name="size_attribute" id="size_attribute"  class="select2-me input-large"   data-rule-required="true" >


                                                <option>Select Size</option>
                                                <?php
                                                 foreach($size_att_arr as $sz)
                                                 {
                                                    echo '<option value="'.$sz.'" ';
                                                    if($sz==$prod_row['size_attribute'])
                                                    {
                                                        echo ' selected ';
                                                    }
                                                    echo ' >'.ucwords($sz).'</option>';
                                                 }
                                                 ?>
                                                </select>
                                            </div>
                                        </div>  <!-- Size attribute-->


                                        <!-- ======================Start For Cost Effective Pack====================== -->
                                        <div class="control-group span6" id="div_cost_effective_pack" style="display: none">
                                            <label for="tasktitel" class="control-label">Cost Effective Pack<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <input type="text" placeholder="Cost Effective Pack" id="txt_cost_effective_pack" name="txt_cost_effective_pack" class="input-xlarge" value="<?php echo $prod_row['prod_effective_pack'] ?>" data-rule-required="true" />
                                            </div>
                                        </div>  <!-- Cost Efective Pack -->

                                        <div class="control-group span6" id="div_stadard_pack" style="display: none">
                                            <label for="tasktitel" class="control-label">Sellable Standard Pack<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <input type="text" placeholder="Sellable Standard Pack" id="txt_stadard_pack" value="<?php echo $prod_row['prod_standard_pack'] ?>" name="txt_stadard_pack" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>  <!-- Sellable Standard Pack -->

                                        <div class="control-group span12" id="div_shipper" style="display: none">
                                            <label for="tasktitel" class="control-label">Shipper <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <input type="text" placeholder="Shipper" id="txt_shipper" name="txt_shipper" value="<?php echo $prod_row['prod_shipper'] ?>" class="input-xlarge" data-rule-required="true" />
                                            </div>
                                        </div>  <!-- txt_shipper -->

                                        <!-- ======================End For Formulation====================== -->
                                        <!-- =============================================================== -->
                                        
                                        
                                        <div class="control-group span12" >
                                            <label for="tasktitel" class="control-label">Tax Class<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <select name="txt_tax" id="txt_tax"  class = "select2-me input-xlarge"   data-rule-required="true" >
                                            <?php
                                            // Query For getting all categories from the system
                                            $sql_get_gst    = " SELECT * FROM `tbl_gst_master` ";
                                            $sql_get_gst    .= " WHERE `gst_status`='1' ";
                                            $sql_get_gst    .= " ORDER BY `gst_name` ASC ";
                                            $res_get_gst    = mysqli_query($db_con, $sql_get_gst) or die(mysqli_error($db_con));
                                            $num_get_gst    = mysqli_num_rows($res_get_gst);
                                            
                                            if($num_get_gst!= 0)
                                            {
                                            ?>
                                            <option  value="">Select Tax Class</option>
                                            <?php
                                                while($row_get_gst = mysqli_fetch_array($res_get_gst))
                                                {
                                                    $selected = '';
                                                    if($row_get_gst['gst_id']==$prod_row['prod_tax'])
                                                    {
                                                        $selected =' selected ';
                                                    }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $row_get_gst['gst_id']; ?>">
                                                        <?php echo ucwords($row_get_gst['gst_name']); ?> %
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
                                           <?php
                                            $attribute_arr  = array();
                                            $sql_get_attr  = " SELECT attribute_id FROM tbl_product_attributes WHERE product_id ='".$prod_row['id']."'";
                                            $res_get_attr  = mysqli_query($db_con,$sql_get_attr) or die(mysqli_error($db_con));
                                            while($row_get_attr = mysqli_fetch_array($res_get_attr))
                                            {
                                                array_push($attribute_arr,$row_get_attr['attribute_id']);
                                            }
                                           ?>
                                           <select multiple="multiple"  id="txt_attribute" onChange="console.log($(this).children(":selected").length)" name="txt_attribute[]" id="txt_attribute"  class = "select2-me input-xlarge"  data-rule-required="true" placeholder="Select Application" >                  
                                             
                                            <?php
                                            // Query For getting all categories from the system
                                            $sql_get_app    = " SELECT * FROM `tbl_attribute` ";
                                            $sql_get_app    .= " WHERE `status`='1' ";
                                            $sql_get_app    .= " ORDER BY `attribute_name` ASC ";
                                            $res_get_app    = mysqli_query($db_con,$sql_get_app) or die(mysqli_error($db_con));
                                            $num_get_app    = mysqli_num_rows($res_get_app);
                                            
                                            if($num_get_app != 0)
                                            {
                                                while($row_get_app= mysqli_fetch_array($res_get_app))
                                                {
                                                    $selected ='';
                                                    if(in_array($row_get_app['id'],$attribute_arr))
                                                    {
                                                        $selected ='selected';
                                                    }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $row_get_app['id']; ?>">
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
                                            <input placeholder="Dimension Length" type="text" name="txt_dimensionl" id="txt_dimensionl" value="<?php echo $prod_row['prod_dimension_l']; ?>"   data-rule-required="true"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension length -->

                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">Dimension Height<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Dimension Height" type="text" name="txt_dimensionh" id="txt_dimensionh" value="<?php echo $prod_row['prod_dimension_h']; ?>"  data-rule-required="true"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension height-->

                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">Dimension Width<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Dimension Width" type="text" name="txt_dimensionw" id="txt_dimensionw" value="<?php echo $prod_row['prod_dimension_w']; ?>"  data-rule-required="true"   class=" input-large" style="" />
                                           </div>
                                        </div><!--Dimension weight-->
                                        
                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">Unit of Weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <?php
                                                 $uow_arr  = array('kg','mg','gms');
                                             ?>
                                            <select name="txt_uoweight" id="txt_uoweight"  class="select2-me input-large"   data-rule-required="true" >


                                            <option>Select Unit</option>
                                            <?php
                                             foreach($uow_arr as $unit)
                                             {
                                                echo '<option value="'.$unit.'" ';
                                                if($unit==$prod_row['prod_unit_weight']){
                                                    echo ' selected';
                                                }
                                                echo ' >'.ucwords($unit).'</option>';
                                             }
                                             ?>
                                            </select>
                                            </div>
                                        </div><!--Unit of weight Type-->

                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">NETT weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           <input type="text"  placeholder="Enter NETT Weight"  name="txt_nweight"  data-rule-required="true" value="<?php echo $prod_row['prod_nett_weight']; ?>"  id="txt_nweight"  class=" input-large" style=" ">
                                           </div>
                                        </div><!--NETT weight-->
                                        
                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">GROSS weight<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           
                                           <input type="text"  placeholder="Enter GROSS Weight"  name="txt_gweight"  data-rule-required="true" value="<?php echo $prod_row['prod_gross_weight']; ?>"  id="txt_gweight"  class=" input-large" style=" ">
                                           </div>
                                        </div><!--Gross weight-->
                                        
                                        <div class="control-group span12">
                                            <label for="tasktitel" class="control-label">Packing<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                           
                                            <select name="txt_packing" id="txt_packing"  class = "select2-me input-xlarge"  data-rule-required="true" >
                                            <?php
                                            // Query For getting all categories from the system
                                            $sql_get_packing    = " SELECT * FROM `tbl_packing` ";
                                            $sql_get_packing   .= " WHERE `status`='1' ";
                                            $sql_get_packing   .= " ORDER BY `packing_name` ASC ";
                                            $res_get_packing    = mysqli_query($db_con, $sql_get_packing) or die(mysqli_error($db_con));
                                            $num_get_packing    = mysqli_num_rows($res_get_packing);
                                            
                                            if($num_get_packing!= 0)
                                            {
                                            ?>
                                            <option  value="">Select Packing</option>
                                            <?php
                                                while($row_get_packing = mysqli_fetch_array($res_get_packing))
                                                {
                                                    
                                                    echo '<option value="'.$row_get_packing['id'].'" ';
                                                    if($row_get_packing['id']==$prod_row['prod_packing'])
                                                    {
                                                        echo ' selected ';
                                                    }
                                                    echo '>'.ucwords($row_get_packing['packing_name']).'
                                                    </option>';
                                                    
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
                                        
                                        
                                         <div class="control-group span12">
                                            <label for="tasktitel" class="control-label">Commission</label>
                                           <div class="controls">
                                           
                                            <select name="txt_commission" id="txt_commission"  class = "select2-me input-xlarge"  data-rule-required="true" >
                                            <?php
                                            // Query For getting all categories from the system
                                            $sql_get_gst    = " SELECT * FROM `tbl_gst_master` ";
                                            $sql_get_gst    .= " WHERE `gst_status`='1' ";
                                            $sql_get_gst    .= " ORDER BY `gst_name` ASC ";
                                            $res_get_gst    = mysqli_query($db_con, $sql_get_gst) or die(mysqli_error($db_con));
                                            $num_get_gst    = mysqli_num_rows($res_get_gst);
                                            
                                            if($num_get_gst!= 0)
                                            {
                                            ?>
                                            <option  value="">Select Commission</option>
                                            <?php
                                                while($row_get_gst = mysqli_fetch_array($res_get_gst))
                                                {
                                                    
                                                    echo '<option value="'.$row_get_gst['gst_id'].'"  ';
                                                    if($row_get_gst['gst_id']==$prod_row['prod_commission'])
                                                    {
                                                        echo ' selected ';
                                                    }

                                                    echo '>'.ucwords($row_get_gst['gst_name']).' %
                                                    </option>';
                                                    
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
                                            <input placeholder="Manufactured by" type="text" name="txt_manufactured"  data-rule-required="true"  value="<?php echo $prod_row['prod_manufactured']; ?>"  id="txt_manufactured"  class=" input-large" style="" />
                                           </div>
                                        </div><!--Manufactured by -->


                                        
                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">Manufactured Licence Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="Manufactured Licence Number" type="text" name="txt_manufactured_lic" value="<?php echo $prod_row['prod_manufactured_number']; ?>"  data-rule-required="true"  id="txt_manufactured_lic"  class=" input-medium" style="" />
                                           </div>
                                        </div><!--Manufactured by -->
                                         
                                        <div class="control-group span4">
                                            <label for="tasktitel" class="control-label">DMF</label>
                                           <div class="controls">
                                            <input  type="file" name="img_dmf" id="img_dmf"  class=" input-large" style="" />
                                            <?php
                                             if($prod_row['prod_dmf']!="")
                                             {
                                                echo  '<a href="documents/dmf/'.$prod_row['prod_dmf'].'">'.$prod_row['prod_dmf'].'</a>';
                                             }
                                             ?>

                                           </div>
                                        </div><!--Manufactured by -->
                                        
                                        <div class="control-group" style="display: none" id="div_hsn">
                                            <label for="tasktitel" class="control-label">HSN Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input placeholder="HSN Number" type="text" name="txt_hsn" id="txt_hsn"  class=" input-large" value="<?php echo $prod_row['prod_manufactured_number']; ?>"  style=""  data-rule-required="true" />
                                           </div>
                                        </div><!--HSN Number -->
                                        
                                        <div class="control-group" id="div_ean" style="clear: both;display: none" >
                                            <label for="tasktitel" class="control-label">EAN Number</label>
                                           <div class="controls">
                                            <input placeholder="EAN Number" value="<?php echo $prod_row['prod_manufactured_number']; ?>"  type="text" name="txt_ean" id="txt_ean"  class=" input-large" style=""   />
                                           </div>
                                        </div><!--EAN Number -->
                                        
                                       <!--========================Certificate of Analysis /Authenticity===============================//-->
                                        
                                        <div class="control-group" style="clear:both">
                                         <label for="tasktitel" class="control-label">Material Handling
                                        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                           <input type="text"  type="text" id="prod_handling" name="prod_handling"   class="input-large"  value="<?php echo $prod_row['prod_handling']; ?>"  placeholder="Material Handling" data-rule-required="true" >
                                            </div>
                                        </div> <!-- Prod_handling -->
                                        
                                        <div class="control-group">
                                            <label for="tasktitel" class="control-label">Insurance<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">


                                            <input type="radio" name="txt_insurance" value="1" class="css-radio" data-rule-required="true" <?php if($prod_row['prod_insurance']==1) echo 'checked'; ?> > Active
                                         <input type="radio" name="txt_insurance" value="0" class="css-radio" data-rule-required="true"  <?php if($prod_row['prod_insurance']==0) echo 'checked'; ?>> Inactive
                                            </div>
                                        </div><!--Insurance -->
                                        
                                        <div class="control-group " style="clear: both;">
                                            <label for="tasktitel" class="control-label">Meta Keywords<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <textarea style="width:50%" rows="4" name="txt_meta" id="txt_meta" data-rule-required="true" ><?php echo $prod_row['prod_meta_tags']; ?></textarea> 
                                           </div>
                                        </div><!--Meta Keywords -->
                                        
                                        <div class="control-group " style="clear:both">
                                            <label for="tasktitel" class="control-label">Status<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                           <div class="controls">
                                            <input type="radio" name="txt_status" value="1" class="css-radio" data-rule-required="true" <?php if($prod_row['prod_status']==1) echo 'checked'; ?> > Active 
                                         <input type="radio" name="txt_status" value="0" class="css-radio" data-rule-required="true"  <?php if($prod_row['prod_status']==0) echo 'checked'; ?>> Inactive 
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
            
            
            $('#frm_update_prod').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#frm_update_prod').valid())
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
                var sendInfo    = {"cat_id":cat_id,"getCat":1};
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
                var sendInfo    = {"cat_id":cat_id,"getPacking":1};
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
                var sendInfo    = {"cat_id":cat_id,"getFactor":1};
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
                var sendInfo    = {"cat_id":cat_id,"getApplication":1};
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

           $('document').ready(function(){

            productType(<?php echo $prod_row['prod_type']; ?>);
           })
       </script>
     <!--======================Start : Javascript Dn By satish 12sep2017=========================-->
    </body>
</html>