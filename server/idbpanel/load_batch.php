<?php
include("include/routines.php");
$json = file_get_contents('php://input');
$obj = json_decode($json);
//var_dump($obj = json_decode($json));
$uid	= $_SESSION['panel_user']['id'];
$utype	= $_SESSION['panel_user']['utype'];
$vid    =  $_SESSION['panel_user']['vendorId'];


if(isset($_FILES['file']))
{
	$sourcePath 		= $_FILES['file']['tmp_name'];      // Storing source path of the file in a variable
	$inputFileName 		= $_FILES['file']['name']; 			// Target path where file is to be stored
	move_uploaded_file($sourcePath,$inputFileName) ;
	
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	include 'PHPExcel/IOFactory.php';
	$branch_id 	= 0;
	$msg		= '';
	$insertion_flag	= 0;
	$response_array = array();
	
	try 
	{
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} 
	catch(Exception $e) 
	{
		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	
	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
	
	if(strcmp($inputFileName, "")!==0)
	{
		for($i=2;$i<=$arrayCount;$i++)
		{
			$branch_name 				= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["A"])), ENT_HTML5);
			$branch_orgname				= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["B"])), ENT_HTML5);
			$branch_addrs				= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["C"])), ENT_HTML5);
			$branch_state				= trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["D"]));
			$branch_city				= trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["E"]));
			$branch_pincode				= trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["F"]));
			$branch_meta_tag			= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["G"])), ENT_HTML5);
			$branch_meta_title			= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["H"])), ENT_HTML5);
			$branch_meta_description	= htmlspecialchars(trim(mysqli_real_escape_string($db_con,$allDataInSheet[$i]["I"])), ENT_HTML5);
			
			if($branch_name!='' && $branch_orgname!='')
			{
				// GET ORGANISATION ID
				$sql_get_orgid			= " SELECT * FROM `tbl_oraganisation_master` WHERE `org_name`='".$branch_orgname."' ";
				$res_get_orgid			= mysqli_query($db_con, $sql_get_orgid) or die(mysqli_error($db_con));
				$row_get_orgid			= mysqli_fetch_array($res_get_orgid);
				$num_get_orgid			= mysqli_num_rows($res_get_orgid);
				$branch_orgid			= $row_get_orgid['org_id'];
				
				$query = " SELECT * FROM `tbl_branch_master` WHERE `branch_name`='".$branch_name."' AND `branch_orgid`='".$branch_orgid."' " ;
								
				$sql 		= mysqli_query($db_con, $query) or die(mysqli_error($db_con));
				$recResult 	= mysqli_fetch_array($sql);
				
				// getting state and city
				// get State Code
				$sql_get_state_code1	= " SELECT `state_id`,`state` FROM `state` WHERE `state_name` = '".$branch_state."' ";
				$res_get_state_code1	= mysqli_query($db_con, $sql_get_state_code1) or die(mysqli_error($db_con));
				$row_get_state_code1	= mysqli_fetch_array($res_get_state_code1);
				$num_get_state_code1	= mysqli_num_rows($res_get_state_code1);
				$add_state				= $row_get_state_code1['state'];
				
				// get City ID
				$sql_get_city_id1		= " SELECT `city_id` FROM `city` WHERE `state_id`='".$add_state."' AND `city_name` = '".$branch_city."' ";
				$res_get_city_id1		= mysqli_query($db_con, $sql_get_city_id1) or die(mysqli_error($db_con));
				$row_get_city_id1		= mysqli_fetch_array($res_get_city_id1);
				$num_get_city_id1		= mysqli_num_rows($res_get_city_id1);
				$add_city				= $row_get_city_id1['city_id'];
				
				$existBranchName 		= $recResult["branch_name"];
				
				if($existBranchName=="" && $num_get_orgid != 0 && $num_get_state_code1 != 0 && $num_get_city_id1 != 0)
				{
					$response_array 	= insertBranch($branch_name, $branch_orgid, $branch_addrs, $add_state, $add_city, $branch_pincode, $branch_meta_description, $branch_meta_title, $branch_meta_tag,'1',$response_array);
					if($response_array)
					{
						$insertion_flag		= 1;	
					}
					else
					{
						$insertion_flag		= 0;
					}
				}
				else
				{
					// error data array
					$error_data = array("branch_name"=>$branch_name, "branch_orgid"=>$branch_orgname, "branch_address"=>$branch_addrs, "branch_state"=>$branch_state, "branch_city"=>$branch_city, "branch_pincode"=>$branch_pincode, "branch_meta_tags"=>$branch_meta_tag, "branch_meta_title"=>$branch_meta_title, "branch_meta_description"=>$branch_meta_description);	
					
					$sql_get_last_record	= " SELECT * FROM `tbl_error_data` ORDER by `error_id` DESC LIMIT 0,1 ";
					$res_get_last_record	= mysqli_query($db_con, $sql_get_last_record) or die(mysqli_error($db_con));
					$row_get_last_record	= mysqli_fetch_array($res_get_last_record);
					$num_get_last_record	= mysqli_num_rows($res_get_last_record);
					if(strcmp($num_get_last_record,0)===0)
					{
						$error_id	= 1;
					}
					else
					{
						$error_id	= $row_get_last_record['error_id']+1;
					}
					
					$error_module_name	= "branch";
					$error_file			= $inputFileName;
					$error_status		= '1';
					$error_data_json	= json_encode($error_data);
					
					$sql_insert_error_log	= " INSERT INTO `tbl_error_data`(`error_id`, `error_module_name`, `error_file`, `error_data`, `error_status`, `error_created`, `error_created_by`) 
												VALUES ('".$error_id."', '".$error_module_name."', '".$error_file."', '".$error_data_json."', '".$error_status."', '".$datetime."', '".$uid."') ";
					$res_insert_error_log 	= mysqli_query($db_con, $sql_insert_error_log) or die(mysqli_error($db_con));
					
					$insertion_flag	= 1;
				}
			}
			else
			{
				$insertion_flag = 0;	
			}
		}
		if($insertion_flag == 1)
		{
			$response_array = array("Success"=>"Success","resp"=>"Insertion Successfully");	
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Insertion Error");			
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Try to upload Different File");
	}
	echo json_encode($response_array);
}


if((isset($obj->load_batch)) == "1" && isset($obj->load_batch))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= $obj->page;	
	$per_page		= $obj->row_limit;
	$search_text	= $obj->search_text;
	if($page != "" && $per_page != "")	
	{
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
		
		$sql_load_data  = " SELECT *  FROM `tbl_batches` as  tb  ";
		$sql_load_data .=" INNER JOIN tbl_products as tp ON tb.prod_id =tp.id  ";
		$sql_load_data .=" WHERE 1=1 ";
		if(strcmp($utype,'1')!==0)
		{
			$sql_load_data  .= " AND batch_created_by='".$uid."' ";
		}

		if($search_text != "")
		{
			$sql_load_data .= " and (product_name like '%".$search_text."%'or branch_created like '%".$search_text."%' or branch_modified like '%".$search_text."%') ";	
		}
		$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
		$sql_load_data .=" ORDER BY batch_id ASC LIMIT $start, $per_page ";
		$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
		if(strcmp($data_count,"0") !== 0)
		{		
			$branch_data = "";	
			$branch_data .= '<table id="tbl_user" class="table table-bordered dataTable" style="width:100%;text-align:center">';
    	 	$branch_data .= '<thead>';
    	  	$branch_data .= '<tr>';
         	$branch_data .= '<th style="text-align:center">Sr No.</th>';
			$branch_data .= '<th style="text-align:center">Product  Name</th>';
			$branch_data .= '<th style="text-align:center">Batch Number</th>';
			$branch_data .= '<th style="width:6%;text-align:center">Manufacturing Date</th>';
			$branch_data .= '<th style="text-align:center">Expiry Date</th>';
			$branch_data .= '<th style="text-align:center">Created</th>';
			$branch_data .= '<th style="text-align:center">Created By</th>';
			$branch_data .= '<th style="text-align:center">Modified</th>';
			$branch_data .= '<th style="text-align:center">Modified By</th>';
			/*$dis = checkFunctionalityRight("view_batch.php",3);
			if($dis)
			{			
				$branch_data .= '<th style="text-align:center">Status</th>';						
			}
			$edit = checkFunctionalityRight("view_batch.php",1);
			if($edit)
			{			
				$branch_data .= '<th style="text-align:center">Edit</th>';			
			}
			$del = checkFunctionalityRight("view_batch.php",2);
			if($del)
			{			
				$branch_data .= '<th style="text-align:center">';
				$branch_data .= '<div style="text-align:center">';
				$branch_data .= '<input type="button"  value="Delete" onclick="multipleDelete();" class="btn-danger"/>';
				$branch_data .= '</div></th>';
			}
			$branch_data .= '</tr>';*/
      		$branch_data .= '</thead>';
      		$branch_data .= '<tbody>';
			while($row_load_data = mysqli_fetch_array($result_load_data))
			{
	    	  	$branch_data .= '<tr>';				
				$branch_data .= '<td style="text-align:center">'.++$start_offset.'</td>';				
				$branch_data .= '<td style="text-align:center">'.ucwords($row_load_data['prod_name']).'</td>';
				$branch_data .= '<td style="text-align:center"><input type="button" value="'.ucwords($row_load_data['prod_batch_no']).'" class="btn-link" id="'.$row_load_data['batch_id'].'" onclick="addMoreBranch(this.id,\'view\');"></td>';
				$branch_data .= '<td style="text-align:center">'.ucwords($row_load_data['prod_manu_date']).'</td>';
				$branch_data .= '<td style="text-align:center">'.$row_load_data['prod_exp_date'].'</td>';

				$branch_data .= '<td style="text-align:center">'.ucwords($row_load_data['batch_created']).'</td>';
				$branch_data .= '<td style="text-align:center">'.ucwords($row_load_data['batch_created_by']).'</td>';
				$branch_data .= '<td style="text-align:center">'.$row_load_data['branch_modified'].'</td>';
				$branch_data .= '<td style="text-align:center">'.ucwords($row_load_data['branch_by_modified']).'</td>';
				/*$dis = checkFunctionalityRight("view_batch.php",3);
				if($dis)
				{				
					$branch_data .= '<td style="text-align:center">';	
					if($row_load_data['branch_status'] == 1)
					{
						$branch_data .= '<input type="button" value="Active" id="'.$row_load_data['batch_id'].'" class="btn-success" onclick="changeStatus(this.id,0);">';
					}
					else
					{
						$branch_data .= '<input type="button" value="Inactive" id="'.$row_load_data['batch_id'].'" class="btn-danger" onclick="changeStatus(this.id,1);">';
					}
					$branch_data .= '</td>';	
				}
				$edit = checkFunctionalityRight("view_batch.php",1);
				if($edit)
				{				
					$branch_data .= '<td style="text-align:center">';
					$branch_data .= '<input type="button" value="Edit" id="'.$row_load_data['batch_id'].'" class="btn-warning" onclick="addMoreBranch(this.id,\'edit\');"></td>';				
				}
				$del = checkFunctionalityRight("view_batch.php",2);
				if($del)
				{					
					$branch_data .= '<td><div class="controls" align="center">';
					$branch_data .= '<input type="checkbox" value="'.$row_load_data['batch_id'].'" id="batch'.$row_load_data['batch_id'].'" name="batch'.$row_load_data['batch_id'].'" class="css-checkbox batch">';
					$branch_data .= '<label for="batch'.$row_load_data['batch_id'].'" class="css-label"></label>';
					$branch_data .= '</div></td>';										
				}
	          	$branch_data .= '</tr>';	*/														
			}	
      		$branch_data .= '</tbody>';
      		$branch_data .= '</table>';	
			$branch_data .= $data_count;
			$response_array = array("Success"=>"Success","resp"=>$branch_data);					
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Data Available");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
	}
	echo json_encode($response_array);	
}
if((isset($obj->load_add_batch_part)) == "1" && isset($obj->load_add_batch_part))
{
	$batch_id 	= $obj->batch_id;
	$req_type 	= $obj->req_type;
	$response_array = array();
	$data  ='';

	if($req_type != "")
	{ 
		if($req_type=='add')
		{
			$data .='<input type="hidden" value="1" name="add_batch_request">';
		}
		else
		{
			$sql_get_batch = " SELECT * FROM tbl_batches WHERE batch_id ='".$batch_id."'";
			$res_get_batch = mysqli_query($db_con,$sql_get_batch) or die(mysqli_error($db_con));
			$row  		   = mysqli_fetch_array($res_get_batch);
			$data .='<input type="hidden" value="1" name="update_batch_request">';
			$data .='<input type="hidden" value="'.$batch_id.'" name="batch_id">';

		}

		$disabled ='';
		
        // =======================Prouct Type================================//
		$data .= '<div class="control-group">';
		$data .= '<label for="tasktitel" class="control-label">Product Type<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<select '.$disabled.' onChange="getProduct(this.value);" name="prod_type" id="prod_type" placeholder="Select Type" class="select2-me input-large" data-rule-required="true" >';
		$data .= '<option value="" >Select Type</option>';
		
		$sql_get_type ="SELECT * FROM tbl_category WHERE cat_type='parent' AND cat_status=1 ";
		$res_get_type = mysqli_query($db_con,$sql_get_type) or die(mysqli_error($db_con));
		$num_get_type = mysqli_num_rows($res_get_type);
		if($num_get_type !=0)
		{
			while($cat_row = mysqli_fetch_array($res_get_type))
			{
				$data .= '<option value="'.$cat_row['cat_id'].'"  ';

				if(@$row['prod_type']==$cat_row['cat_id'])
				{
					$data .='selected ="selected"';
				}
		
				$data .=' >'.ucwords($cat_row['cat_name']).'</option>';
			}
			
		}
		
		$data .= '</select>';
		$data .= '</div>';
		$data .= '</div> <!-- prod_type -->';
		$data .= '<script type="text/javascript">';
		$data .= '$("#prod_type").select2();';		
				
		$data .= '</script>';

        ///////========================Product Name================================//
		$data .= '<div class="control-group">';
		$data .= '<label for="tasktitel" class="control-label">Product Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<select  '.$disabled.' name="prod_id" id="prod_id" placeholder="Select Type"  class="select2-me input-large" data-rule-required="true" >';
		$data .= '<option value="">Select Product</option>';
		if($req_type !='add')
		{
			$sql = "SELECT * FROM tbl_products WHERE prod_type='".@$row['prod_type']."'";
			$res = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
			while($prod_row = mysqli_fetch_array($res))
			{
				$data .='<option value="'.$prod_row['id'].'" ';
					if($prod_row['id']==$row['prod_id'])
					{
						$data .=' selected="selected"';
					}
				$data .='>'.ucwords($prod_row['prod_name']).'</option>';
			}
		}
		$data .= '</select>';

		if($req_type=='add')
		{
			$data .='<a href="add_products.php" target="_blank"><button type="button" class="btn-info">&nbsp;Request Product</button></button></a>';
		}
		

		$data .= '</div>';
		$data .= '</div> <!-- prod_type -->';
		$data .= '<script type="text/javascript">';
		$data .= '$("#prod_id").select2();';		
		$data .= '</script>';

		$data .= ' <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Product Id<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Vendor Product ID" id="vprod_id" name="vprod_id" class="input-large" value="'.@$row['vprod_id'].'" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->';
										
		 ///////========================Product MRP================================//
		$data .= '<div class="control-group" id="prod_mrp">';
		$data .= '<label for="tasktitel" class="control-label">Product MRP<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="text" '.$disabled.' type="text" id="prod_mrp" name="prod_mrp"  placeholder="Product MRP " value="'.@$row['prod_mrp'].'" class="input-large" data-rule-required="true" >' ;
		$data .= '</div>';
		$data .= '</div> <!-- Prod mRP -->';

		///////========================Product MRP================================//
		$data .= '<div class="control-group ">';
		$data .= '<label for="tasktitel" class="control-label">Selling Price / Unit Price
        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="text" '.$disabled.' type="text" id="prod_price" name="prod_price"  placeholder="Product Price " value="'.@$row['prod_price'].'" class="input-large" data-rule-required="true" onChange="getCommission(this.value)"; onkeypress="return numsonly(event);">' ;
		$data .= '<span id="commission_msg"></span>';
		$data .= '</div>';
		$data .= '</div> <!-- Prod Price -->';

		///////========================Product Quantity================================//
		$data .= '<div class="control-group">';
		$data .= '<label for="tasktitel" class="control-label">Quantity
         <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="number" '.$disabled.' type="text" id="prod_quantity" min="1" name="prod_quantity"  placeholder="Product Quantity " value="'.@$row['prod_quantity'].'" class="input-large" data-rule-required="true" >' ;
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';

		///////========================Batch Number================================//
		$data .= '<div class="control-group span6">';
		$data .= '<label for="tasktitel" class="control-label">Batch Number
        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="text" '.$disabled.' type="text" id="prod_batch_no" name="prod_batch_no"  placeholder="Batch Number" value="'.@$row['prod_batch_no'].'" class="input-large" data-rule-required="true" >' ;
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';

		///////========================Product Quantity================================//
		$data .= '<div class="control-group span6">';
		$data .= '<label for="tasktitel" class="control-label">Manufacuring Date
         <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="text" '.$disabled.' type="text" id="prod_manu_date" name="prod_manu_date"  placeholder="Manufacuring Date " value="'.@$row['prod_manu_date'].'" class="input-large datepicker" data-rule-required="true" >' ;
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';

		


		///////======================== Expiry Date================================//
		$data .= '<div class="control-group span6">';
		$data .= '<label for="tasktitel" class="control-label">Expiry Date
         <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="text" '.$disabled.' type="text" id="prod_exp_date" name="prod_exp_date"  placeholder="Expiry Date " value="'.@$row['prod_exp_date'].'" class="input-large datepicker" data-rule-required="true" >' ;
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';
 		$data .="<script type=\"text/javascript\">	 $( '.datepicker' ).datepicker({
		changeMonth	: true,
		changeYear	: true,
		format: 'dd-mm-yyyy',
		yearRange 	: 'c:c',//replaced 'c+0' with c (for showing years till current year)
		startDate: '+d',
			
	   });</script>";

	


		///////======================== Origin================================//
		$data .= '<div class="control-group span6">';
		$data .= '<label for="tasktitel" class="control-label">Origin
        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<select '.$disabled.' name="prod_origin" id="prod_origin" placeholder="Select Origin" class="select2-me input-large" data-rule-required="true" >';
		$data .= '<option value="">Select Origin</option>';
		$data .= '<option value="India"  ';

		if(@$row['prod_origin']=='India')
		{
			$data .='selected ="selected"';
		}

		$data .=' >India</option>';
		$data .= '<option value="China"  ';

		if(@$row['prod_origin']=='China')
		{
			$data .='selected ="selected"';
		}
		$data .=' > China</option>';

		$data .= '<option value="Imported "  ';

		if(@$row['prod_origin']=='Imported ')
		{
			$data .='selected ="selected"';
		}

		$data .=' >Imported</option>';

		$data .= '</select>';
		$data .= '</div>';
		$data .= '</div> <!-- prod_type -->';
		$data .= '<script type="text/javascript">';
		$data .= '$("#prod_origin").select2();';		
		$data .= '</script>';

		///////========================Certificate of Analysis /Authenticity===============================//
		$data .= '<div class="control-group" style="clear:both">';
		$data .= '<label for="tasktitel" class="control-label">Certificate of Analysis / Authenticity
        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="file"  type="text" id="img_coa" name="img_coa"   class="input-large" ';
		if($req_type=='add')
		{
			$data .=' data-rule-required="true" ';
		}
		

		$data .=' >' ;
		if($req_type !='add')
		{
			$data .='<a Target="_blank" href="documents/coa/'.$row['prod_coa'].'">'.$row['prod_coa'].'</a>';
		}
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';
		
		
		//======================Start : Sample Request 06112017===============================//
		$data .= '<div class="control-group">';
		$data .= '<label for="radio" class="control-label">Sample Required<span style="color:#F00;font-size:20px;">*</span></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="radio" name="prod_sample" id="prod_sample" value="1" class="prod_sample css-radio" data-rule-required="true" ';
		
		if(isset($row['prod_sample']) && $row['prod_sample']== 1)
		{
			$data .= 'checked';
		}
		$data .= '> Yes ';
		$data .= '<input type="radio" name="prod_sample" id="prod_sample" value="0" class="prod_sample css-radio" data-rule-required="true"';
		if(isset($row['prod_sample']) && $row['prod_sample']== 0)
		{
			$data .= 'checked';
		}
		$data .= '> No ';
			
		$data .= '<label for="radiotest" class="css-label" ></label>';
		$data .='<label style="color:red" id="sampleCharge"  name = "radiotest" > ';
		$data .=' <span id="spanMsg">';
		if(isset($row['prod_sample']) && $row['prod_sample'] == 1)
		{
			$data .='You will be charged 100 Rs. extra ';
		}
		$data .='</span>';
		$data .='</label>';
		$data .= '</div>';
		$data .= '</div><!--Status-->';
		
		$data .='<script type="application/javascript">';
		
		$data .='</script>';
		//====================End : Sample Request=================================================//
		
		
		$data .= '<div class="control-group">';
		$data .= '<label for="radio" class="control-label">Status<span style="color:#F00;font-size:20px;">*</span></label>';
		$data .= '<div class="controls">';
		
		
		$data .= '<input type="radio" name="batch_status" value="1" class="css-radio" data-rule-required="true" ';
		
		if(@$row['batch_status'] == 1)
		{
			$data .= 'checked';
		}
		$data .= '> Active ';
		$data .= '<input type="radio" name="batch_status" value="0" class="css-radio" data-rule-required="true"';
		if(@$row['batch_status'] == 0)
		{
			$data .= 'checked';
		}
		$data .= '> Inactive ';
			
		$data .= '<label for="radiotest" class="css-label"></label>';
		$data .= '<label name = "radiotest" ></label>';
		$data .= '</div>';
		$data .= '</div><!--Status-->';	
		
		$data .= '<div class="control-group" style="clear:both">';
		$data .= '<label for="tasktitel" class="control-label">Disclaimer 
        <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
		$data .= '<div class="controls">';
		$data .= '<input type="checkbox" value="1"   id="disclaimer" name="disclaimer"   class="input-large" ';
		if($row['prod_disclaimer']=='1')
		{
			$data .=' checked ';
		}
		$data .=' >' ;
		
		$data .= '</div>';
		$data .= '</div> <!-- Prod prod_quantity -->';




		$data .= '<div class="form-actions">';
		if($batch_id == "" && $req_type == "add")
		{
			$data .= '<button type="submit" name="reg_submit_add" class="btn-success">Add Batch</button>';			
		}
		elseif($batch_id != "" && $req_type == "edit")
		{
			$data .= '<button type="submit" name="reg_submit_edit" class="btn-success">Update Batch</button>';
		}
		
		$data .= '</div> <!-- Save and cancel -->';
        $response_array = array("Success"=>"Success","resp"=>$data);	
    }
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Request Not received");		
	}
	echo json_encode($response_array);
}


if((isset($obj->getProduct)) == "1" && isset($obj->getProduct))
{

	$type     = mysqli_real_escape_string($db_con,$obj->type);
	$sql = "SELECT * FROM tbl_products WHERE prod_status =1 AND prod_type='".$type."'";
	$res = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
	$data .='<option value="" disabled>Select Product</option>';
	while($row=mysqli_fetch_array($res))
	{
		$data .='<option value="'.$row['id'].'">'.ucwords($row['prod_name']).'</option>';
	}
	
	quit($data,1);
}


if((isset($_POST['add_batch_request'])) == "1" && isset($_POST['add_batch_request']))
{
	
	$data['prod_type'] = mysqli_real_escape_string($db_con,$_POST['prod_type']);
	$data['prod_id'] = mysqli_real_escape_string($db_con,$_POST['prod_id']);
	$data['prod_mrp'] = mysqli_real_escape_string($db_con,$_POST['prod_mrp']);
	$data['prod_price'] = mysqli_real_escape_string($db_con,$_POST['prod_price']);
	$data['prod_quantity'] = mysqli_real_escape_string($db_con,$_POST['prod_quantity']);
	
	$prod_manu_date 		= mysqli_real_escape_string($db_con,$_POST['prod_manu_date']);
	$prod_manu_date 		= explode('-',$prod_manu_date);
	$data['prod_manu_date'] = $prod_manu_date[2].'-'.$prod_manu_date[1].'-'.$prod_manu_date[0];
	
	$prod_exp_date 		= mysqli_real_escape_string($db_con,$_POST['prod_exp_date']);
	$prod_exp_date 		= explode('-',$prod_exp_date);
	$data['prod_exp_date'] = $prod_exp_date[2].'-'.$prod_exp_date[1].'-'.$prod_exp_date[0];
	
	$data['prod_origin'] = mysqli_real_escape_string($db_con,$_POST['prod_origin']);
	$data['prod_handling'] = mysqli_real_escape_string($db_con,$_POST['prod_handling']);
	$data['batch_status'] = mysqli_real_escape_string($db_con,$_POST['batch_status']);
	$data['prod_batch_no'] = mysqli_real_escape_string($db_con,$_POST['prod_batch_no']);
	$data['prod_disclaimer'] = mysqli_real_escape_string($db_con,$_POST['disclaimer']);
	$data['prod_sample'] = mysqli_real_escape_string($db_con,$_POST['prod_sample']);
	
	$data['vprod_id']      		   = mysqli_real_escape_string($db_con,$_POST['vprod_id']);
	if(!isExist('tbl_batches' ,array('vprod_id'=>$data['vprod_id'])))
 	{
		if(isset($_FILES['img_coa']) && $_FILES['img_coa']['name']!='')
		{
			$coa_size      = $_FILES['img_coa']['size'];
			if($coa_size > 5242880 &&  $coa_size !=0) // file size
			{
				quit('Document size should be less than 5 MB');
			}
			
			$coa_img               = explode('.',$_FILES['img_coa']['name']);
			$coa_img               = date('dhyhis').'.'.$coa_img[1];
			
			
			$dir                          = 'documents/coa/'.$coa_img;
			
			if(move_uploaded_file($_FILES['img_coa']['tmp_name'],$dir))
			{
				$data['prod_coa']      = $coa_img;
			}
			else
			{
				quit('DMF Document not uploaded.!');
			}
	
			$data['batch_created']     = $datetime;
			
			
			$data['batch_created_by']  = $uid;
			$data['user_id']  = $uid;
			$res = insert('tbl_batches',$data);
			if($res)
			{
				quit('Batch Added Successfully',1);
			}
			else
			{
				quit('Something went wrong...!');
			}
		}
		else
		{
			quit('COA Document required...!');
		}
	}
	else
	{
		quit('Vendor Product id  already Exist...!');
	}
	
	
}


if((isset($_POST['update_batch_request'])) == "1" && isset($_POST['update_batch_request']))
{
	
	$data['prod_type'] = mysqli_real_escape_string($db_con,$_POST['prod_type']);

	$batch_id= mysqli_real_escape_string($db_con,$_POST['batch_id']);

	$data['prod_id'] = mysqli_real_escape_string($db_con,$_POST['prod_id']);
	$data['prod_mrp'] = mysqli_real_escape_string($db_con,$_POST['prod_mrp']);
	$data['prod_price'] = mysqli_real_escape_string($db_con,$_POST['prod_price']);
	$data['prod_quantity'] = mysqli_real_escape_string($db_con,$_POST['prod_quantity']);
	$data['prod_manu_date'] = mysqli_real_escape_string($db_con,$_POST['prod_manu_date']);
	$data['prod_exp_date'] = mysqli_real_escape_string($db_con,$_POST['prod_exp_date']);
	$data['prod_origin'] = mysqli_real_escape_string($db_con,$_POST['prod_origin']);
	$data['prod_handling'] = mysqli_real_escape_string($db_con,$_POST['prod_handling']);
	$data['batch_status'] = mysqli_real_escape_string($db_con,$_POST['batch_status']);
	$data['prod_batch_no'] = mysqli_real_escape_string($db_con,$_POST['prod_batch_no']);
	$data['prod_disclaimer'] = mysqli_real_escape_string($db_con,$_POST['disclaimer']);
	if(isset($_FILES['img_coa']) && $_FILES['img_coa']['name']!='')
	{
		$coa_size      = $_FILES['img_coa']['size'];
		if($coa_size > 5242880 &&  $coa_size !=0) // file size
		{
			quit('Document size should be less than 5 MB');
		}
		
		$coa_img               = explode('.',$_FILES['img_coa']['name']);
		$coa_img               = date('dhyhis').'.'.$coa_img[1];
		
		
		$dir                          = 'documents/coa/'.$coa_img;
		
		if(move_uploaded_file($_FILES['img_coa']['tmp_name'],$dir))
		{
			$data['prod_coa']      = $coa_img;
		}
		else
		{
			quit('DMF Document not uploaded.!');
		}
    }

    $data['batch_modified']     = $datetime;;
	$data['batch_modified_by']  = $uid;
	
	$res = update('tbl_batches',$data,array('batch_id'=>$batch_id));
	if($res)
	{
		quit('Batch Added Successfully',1);
	}
	else
	{
		quit('Something went wrong...!');
	}
	
}

if((isset($obj->productRequest)) == "1" && isset($obj->productRequest))
{
	$prod_name = mysqli_real_escape_string($db_con,$obj->prod_name);
	if($prod_name=="")
	{
		quit('Please Enter Product Name');
	}

	if(!isExist('tbl_products' ,array('prod_name'=>$prod_name)))
	{
		$data['prod_name']    = $prod_name;
		$data['req_userid']    = $uid;
		$data['req_created']    = $datetime;
		$data['prod_name']    = $prod_name;
		$data['prod_name']    = $prod_name;
		$res                  = insert('tbl_product_request',$data);
		if($res)
		{
			quit('Request Successfully Sent...!',1);
		}
		else
		{
			quit('Something Went Wrong...!');
		}
	}
	else
	{
		quit('This product name is available');
	}
}


if((isset($obj->getCommission)) == "1" && isset($obj->getCommission))
{
	
	$price		= $obj->price;
	$prod_id	= $obj->prod_id;
	$commission_per =0;
	
	$row = checkExist('tbl_products',array('id'=>$prod_id));
	$commission_per = $row['prod_commission'];
	if($row['prod_commission']=="")
	{
		$crow = checkExist('tbl_category',array('cat_id'=>$row['prod_cat']));
		$commission_per = $crow['cat_commission'];
	}
	
	$commission = $price * ($commission_per/100);
	$commission_msg = " Commission percentage is ".$commission_per." %. ".$commission." Rs will be charged  ";
	quit($commission_msg,1);
	
}


?>