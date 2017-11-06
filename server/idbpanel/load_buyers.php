<?php
include("include/routines.php");
$json = file_get_contents('php://input');
$obj = json_decode($json);
//var_dump($obj = json_decode($json));
$uid				= $_SESSION['panel_user']['id'];
$utype				= $_SESSION['panel_user']['utype'];
		
if((isset($_REQUEST['insert_req'])) == "1" && isset($_REQUEST['insert_req']))
{
	$cust_fname				= strtolower(mysqli_real_escape_string($db_con,$_REQUEST['cust_fname']));
	$cust_lname				= strtolower(mysqli_real_escape_string($db_con,$_REQUEST['cust_lname']));
	$cust_email				= mysqli_real_escape_string($db_con,$_REQUEST['cust_email']);
	$cust_mobile_num		= mysqli_real_escape_string($db_con,$_REQUEST['cust_mobile_num']);
	$cust_password			= mysqli_real_escape_string($db_con,$_REQUEST['cust_password']);
	$cust_status			= mysqli_real_escape_string($db_con,$_REQUEST['cust_status']);
	$response_array = array();
	if($cust_fname != "" && $cust_lname != "" && $cust_email != "" && $cust_mobile_num != "" && $cust_password != "" && $cust_status != "")
	{	
		$sql_check_customers 		= " select * from tbl_customer where cust_email like '".$cust_email."' or cust_mobile_num like '".$cust_mobile_num."'  "; 
		$result_check_customers 	= mysqli_query($db_con,$sql_check_customers) or die(mysqli_error($db_con));
		$num_rows_check_customers 	= mysqli_num_rows($result_check_customers);
		if($num_rows_check_customers == 0)
		{
			$sql_last_rec 		= "SELECT * FROM tbl_customer ORDER by cust_id DESC LIMIT 0,1";
			$result_last_rec 	= mysqli_query($db_con,$sql_last_rec) or die(mysqli_error($db_con));
			$num_rows_last_rec 	= mysqli_num_rows($result_last_rec);
			if($num_rows_last_rec == 0)
			{
				$cust_id 		= 1;				
			}
			else
			{
				$row_last_rec 	= mysqli_fetch_array($result_last_rec);				
				$cust_id 		= $row_last_rec['cust_id']+1;
			}
			$sql_check 				= " SELECT `id` FROM `tbl_customer` WHERE 1=1 and ";
			$row_get_existing_cust 	= mysqli_fetch_array($result_get_existing_cust);
			
			if($row_get_existing_cust['cust_email'] != $cust_email)
			{
				$cust_email_query		= $sql_check." `cust_email_status` = '".$random_string."' ";
				$cust_email_status		= randomString($cust_email_query,5);					
			}
			if($row_get_existing_cust['cust_mobile_num'] != $cust_mobile_num)
			{
				$cust_mobile_query		= $sql_check." `cust_mobile_status` = '".$random_string."' ";
				$cust_mobile_status		= randomString($cust_mobile_query,5);				
			}				
			if($row_get_existing_cust['cust_password'] != $cust_password)
			{
				$cust_salt_value_query 	= $sql_check." `cust_salt_value` = '".$random_string."' ";
				$cust_salt_value		= randomString($cust_salt_value_query,5);
				$new_cust_password		=  md5($cust_salt_value.$cust_password);
			}						
			
			// query for insertion
			$sql_insert_customers 	= " INSERT INTO `tbl_customer`(`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_mobile_num`,`cust_password`,`cust_salt_value`";
			$sql_insert_customers 	.= "  , `cust_email_status`,`cust_mobile_status`,`cust_created`, `cust_created_by`,`cust_status`) ";
			$sql_insert_customers 	.= " VALUES ('".$cust_id."', '".$cust_fname."','".$cust_lname."','".$cust_email."','".$cust_mobile_num."','".$cust_password."','".$cust_salt_value."'";
			$sql_insert_customers 	.= " ,'".$cust_email_status."','".$cust_mobile_status."','".$datetime."', '".$uid."', '".$cust_status."')";			
			$result_insert_customers = mysqli_query($db_con,$sql_insert_customers) or die(mysqli_error($db_con));
			if($sql_insert_customers)
			{
				$response_array = array("Success"=>"Success","resp"=>"Record Inserted.");			
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"Record Not Inserted.");					
			}			
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Customers ".$cust_fname." already Exist");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Empty Data.");	
	}
	
	echo json_encode($response_array);		
}

if((isset($_REQUEST['update_req'])) == "1" && isset($_REQUEST['update_req']))
{
	$cust_id				= mysqli_real_escape_string($db_con,$_REQUEST['cust_id']);
	$cust_fname				= strtolower(mysqli_real_escape_string($db_con,$_REQUEST['cust_fname']));
	$cust_lname				= strtolower(mysqli_real_escape_string($db_con,$_REQUEST['cust_lname']));
	$cust_email				= mysqli_real_escape_string($db_con,$_REQUEST['cust_email']);
	$cust_mobile_num		= mysqli_real_escape_string($db_con,$_REQUEST['cust_mobile_num']);
	$cust_password			= mysqli_real_escape_string($db_con,$_REQUEST['cust_password']);
	$cust_status			= mysqli_real_escape_string($db_con,$_REQUEST['cust_status']);
	$response_array = array();
	if($cust_fname != "" && $cust_lname != "" && $cust_email != "" && $cust_mobile_num != "" && $cust_password != "" && $cust_status != "")
	{
		$sql_check_customers 		= " select * from tbl_customer where (cust_email like '".$cust_email."' or cust_mobile_num like '".$cust_mobile_num."')and cust_id != '".$cust_id."' "; 
		$result_check_customers 	= mysqli_query($db_con,$sql_check_customers) or die(mysqli_error($db_con));
		$num_rows_check_customers = mysqli_num_rows($result_check_customers);
		if($num_rows_check_customers == 0)
		{
			$sql_get_existing_cust 		= " select * from tbl_customer where cust_id = '".$cust_id."' ";
			$result_get_existing_cust	= mysqli_query($db_con,$sql_get_existing_cust) or die(mysqli_error($db_con));
			$num_rows_get_existing_cust = mysqli_num_rows($result_get_existing_cust);
			if($num_rows_get_existing_cust != 0 )
			{
				$sql_check 				= " SELECT `id` FROM `tbl_customer` WHERE 1=1 and ";
				$row_get_existing_cust 	= mysqli_fetch_array($result_get_existing_cust);
				
				$sql_update_customers = " UPDATE `tbl_customer` SET `cust_fname`='".$cust_fname."', `cust_lname`='".$cust_lname."',";
				$sql_update_customers .= " `cust_email`='".$cust_email."',`cust_mobile_num`='".$cust_mobile_num."',";
				
				if($row_get_existing_cust['cust_email'] != $cust_email)
				{
					$cust_email_query		= $sql_check." `cust_email_status` = '".$random_string."' ";
					$cust_email_status		= randomString($cust_email_query,5);					
					$sql_update_customers .= " `cust_email_status`='".$cust_email_status."',";
				}
				if($row_get_existing_cust['cust_mobile_num'] != $cust_mobile_num)
				{
					$cust_mobile_query		= $sql_check." `cust_mobile_status` = '".$random_string."' ";
					$cust_mobile_status		= randomString($cust_mobile_query,5);				
					$sql_update_customers .= " `cust_mobile_status`='".$cust_mobile_status."',";
				}				
				if($row_get_existing_cust['cust_password'] != $cust_password)
				{
					$cust_salt_value_query 	= $sql_check." `cust_salt_value` = '".$random_string."' ";
					$cust_salt_value		= randomString($cust_salt_value_query,5);
					$new_cust_password		=  md5($cust_salt_value.$cust_password);
					$sql_update_customers .= " `cust_password`='".$new_cust_password."',`cust_salt_value`='".$cust_salt_value."',";										
				}						
				$sql_update_customers .= " `cust_modified`='".$datetime."',`cust_modified_by`='".$uid."' WHERE `cust_id` = '".$cust_id."' ";
				$result_update_customers = mysqli_query($db_con,$sql_update_customers) or die(mysqli_error($db_con));
				if($result_update_customers)
				{
					$response_array = array("Success"=>"Success","resp"=>"Update Succesfull");			
				}
				else
				{
					$response_array = array("Success"=>"fail","resp"=>"Record Not Inserted.");					
				}
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"Record Not Inserted.");
			}
		}		
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Customers ".$page_name." already Exists.");	
		}		
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Empty Data.");	
	}
	echo json_encode($response_array);		
}

if((isset($obj->load_customers_parts)) == "1" && isset($obj->load_customers_parts))
{
	$cust_id 		= mysqli_real_escape_string($db_con,$obj->cust_id);
	$req_type 		= strtolower(mysqli_real_escape_string($db_con,$obj->req_type));
	$response_array = array();
	$data           ='';
	if($req_type != "")
	{
		
		if($req_type=='edit' || $req_type=='view')
		 {
			if($req_type=='edit')
			{
				$disabled='';
			}
			else
			{
				$disabled='disabled';
			}
			
			$sql_get_data =" SELECT * FROM tbl_customer WHERE cust_id='".$cust_id."' ";
			$res_get_data = mysqli_query($db_con,$sql_get_data) or die(mysqli_error($db_con));
			$row_get_data = mysqli_fetch_array($res_get_data);
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Customers Name <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input '.$disabled.' type="text" id="cust_fname" name="cust_fname" class="input-large" data-rule-required="true" value="'.$row_get_data['cust_name'].'" />';
			$data .= '</div>';	
			$data .= '</div>';	
			
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Customers Email <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input '.$disabled.' type="text" id="cust_email" name="cust_email" class="input-large" data-rule-required="true" value="'.$row_get_data['cust_email'].'" />';
			$data .= '</div>';	
			$data .= '</div>';	
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Customers Mobile <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input '.$disabled.' type="text" id="cust_mobile" name="cust_mobile" class="input-large" data-rule-required="true" value="'.$row_get_data['cust_mobile'].'" />';
			$data .= '</div>';
			$data .= '</div>';	// Csutomer MObile
			
			
			$sql_get_pan  =" SELECT * FROM tbl_customer_pan WHERE  ";
			$sql_get_pan .="  pan_userid='".$cust_id."'";
			$res_get_pan = mysqli_query($db_con,$sql_get_pan) or die(mysqli_error($db_con));
			$row_get_pan = mysqli_fetch_array($res_get_pan);
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Pan Number <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input '.$disabled.' type="text" id="cust_pan" name="cust_pan" class="input-large" data-rule-required="true" value="'.$row_get_pan['pan_no'].'" />';
			$data .= '</div>';
			$data .= '</div>';  // Cust PAN
			
			
			
			$sql_get_gst  =" SELECT * FROM tbl_customer_gst WHERE  ";
			$sql_get_gst .="  gst_userid='".$cust_id."'";
			$res_get_gst = mysqli_query($db_con,$sql_get_gst) or die(mysqli_error($db_con));
			$row_get_gst = mysqli_fetch_array($res_get_gst);
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">GST Number <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input '.$disabled.' type="text" id="cust_gst" name="cust_gst" class="input-large" data-rule-required="true" value="'.$row_get_gst['gst_no'].'" />';
			$data .= '</div>';
			$data .= '</div>'; // Cust GST
			
			$sql_get_bank  =" SELECT * FROM tbl_customer_company WHERE  ";
			$sql_get_bank .="  comp_user_id='".$cust_id."' ORDER BY comp_created_by DESC";
			$res_get_bank = mysqli_query($db_con,$sql_get_bank) or die(mysqli_error($db_con));
			$num_get_bank = mysqli_num_rows($res_get_bank);
			
			if($num_get_bank!=0)
			{
				
				$data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Company Details <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Company Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Company Name</th>
							   <th style="text-align:center">Establiashment</th>
							   <th style="text-align:center">Billing Addess</th>
							   <th style="text-align:center">Shipping Address</th>
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$bank_no =1;			 
				while($row_get_comp = mysqli_fetch_array($res_get_bank))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_comp['bank_created']));
					$data .='<tr>
							   <td style="text-align:center">'.$bank_no++.'</td>
							   <td style="text-align:center;with:10%">
							   '.$row_get_comp['comp_name'].'
							   </td>
							   <td style="text-align:center">'.$row_get_comp['comp_establishment'].'</td>
							   <td style="text-align:center;with:10%">'.$row_get_comp['comp_bill_address'].'</td>
							   
							   <td style="text-align:center" >'.$row_get_comp['comp_ship_address'].'
							   </td>
							   
							   <td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';	
			}///  customer company
			
			$sql_get_licence  =" SELECT * FROM tbl_customer_licenses WHERE  ";
			$sql_get_licence .="  lic_custid='".$cust_id."' ORDER BY lic_created DESC";
			$res_get_licence = mysqli_query($db_con,$sql_get_licence) or die(mysqli_error($db_con));
			$num_get_licence = mysqli_num_rows($res_get_licence);
			
			if($num_get_licence!=0)
			{
				
				$data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Licence Details <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Licence Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Licence No.</th>
							   <th style="text-align:center">Expiry Date</th>
							   <th style="text-align:center">Document</th>
							   <th style="text-align:center">Type</th>
							   
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$lic_no =1;			 
				while($row_get_licence = mysqli_fetch_array($res_get_licence))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_licence['lic_created']));
					$data .='<tr>
							   <td style="text-align:center">'.$lic_no++.'</td>
							   <td style="text-align:center">
							   <input type="text" name="licence_no" value="'.$row_get_licence['lic_number'].'">
							   
							   </td>
							   <td style="text-align:center"> <input type="text" name="lic_exipiry_date" value="'.$row_get_licence['lic_number'].'"></td>
							   <td style="text-align:center">
							   <a href="../idbpanel/documents/licenses/'.$row_get_licence['lic_document'].'" download>'.$row_get_licence['lic_document'].'</a>
							   </td>';
							   
							    if($row_get_licence['lic_type']!="")
								{
									$data .='<td style="text-align:center">'.$row_get_licence['lic_type'].'</td>';
								}
								else
								{
									$data .='<td style="text-align:center">-</td>';
								}
							    
							   
							   $data .='<td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';
			}// LIcence Detail End
			
			
			$sql_get_bank  =" SELECT * FROM tbl_customer_bank_details WHERE  ";
			$sql_get_bank .="  bank_userid='".$cust_id."' ORDER BY bank_created DESC";
			$res_get_bank = mysqli_query($db_con,$sql_get_bank) or die(mysqli_error($db_con));
			$num_get_bank = mysqli_num_rows($res_get_bank);
			
			if($num_get_bank!=0)
			{
				
				$data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Bank Details <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Bank Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Bank Name</th>
							   <th style="text-align:center">Branch Name</th>
							   <th style="text-align:center">Account Number</th>
							   <th style="text-align:center">IFSC</th>
							   <th style="text-align:center">Document</th>
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$bank_no =1;			 
				while($row_get_bank = mysqli_fetch_array($res_get_bank))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_bank['bank_created']));
					$data .='<tr>
							   <td style="text-align:center">'.$bank_no++.'</td>
							   <td style="text-align:center;with:10%">
							   <input type="text" name="bank_name" value="'.$row_get_bank['bank_name'].'">
							   </td>
							   <td style="text-align:center;with:10%"> <input type="text" name="branch_name" value="'.$row_get_bank['bank_branch'].'"></td>
							   <td style="text-align:center">
							   <input type="text" name="acc_number" value="'.$row_get_bank['bank_acc_no'].'">
							   </td>
							   <td style="text-align:center" >
							   	<input type="text" class="input-small" name="ifsc" value="'.$row_get_bank['bank_ifsc'].'">
							   </td>
							   <td style="text-align:center" >
							    <a href="../idbpanel/documents/banks/'.$row_get_bank['bank_image'].'" download>'.$row_get_bank['bank_image'].'</a>
							   	
							   </td>
							   <td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';	
			}///  Bank Detail
			
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Status<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			if($row_get_data['cust_status']==2)
			{
			    $data .='Registered';
			}
			elseif($row_get_data['cust_status']==1)
			{
			    $data .='<input type="button" value="Approved" class="btn-link" id="'.$row_get_data['cust_id'].'" onclick="changeStatus(this.id,0);addMoreCustomers(this.id,\'edit\')">';
			}
			else
			{
				$data .='<input type="button" value="Not Approved" class="btn-link" id="'.$row_get_data['cust_id'].'" onclick="changeStatus(this.id,1);addMoreCustomers(this.id,\'edit\')">';
			}
			$data .= '</div>';
			$data .= '</div>'; // Cust Status
			
			if($req_type=='edit')
			{
				$data .= '<div class="control-group">';
				$data .= '<div class="controls">';
				$data .= '<input '.$disabled.' type="submit"  class="btn-success"  value="Update" />';
				$data .= '</div>';	
				$data .= '</div>';	
			
			}
			
			quit($data,1);
		 }
		 elseif($req_type=='add')
		 {
			$data .= '<input type="hidden" name="insert_buyer" value="1" >';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Type 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<select name="cust_type" id="cust_type" class="select2-me input-large" data-rule-required="true" tabindex="-1">';
			$data .='<option value="">Select Type</option>';
			$data .='<option value="doctors">Doctors</option>';
			$data .='<option value="hospitals">Hospitals</option>';
			$data .='<option value="chemist">Chemist/Retailers</option>';
			
			$data .='</select>';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data.= '<script type="text/javascript">';
			$data.= '$("#cust_type").select2()';
			$data.= '</script>';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Name 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input  type="text" placeholder="Enter Full Name" id="cust_name" name="cust_name" class="input-large" data-rule-required="true" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Email 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input placeholder="Enter Email"  type="email" id="cust_email" name="cust_email" class="input-large" data-rule-required="true" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Mobile 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input  type="text" id="cust_mobile" name="cust_mobile" placeholder="Enter Mobile Number" class="input-large" data-rule-required="true" maxlength="10" minlength="10" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<div class="controls">';
			$data .= '<input type="submit"  class="btn-success"  value="Add Buyer" />';
			$data .= '</div>';	
			$data .= '</div>';	
			
			quit($data,1);	
		 }
		
	}
	else
	{
		quit('Request Type Not Defined');	
	}
}




if((isset($obj->load_customers)) == "1" && isset($obj->load_customers))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= $obj->page;	
	$per_page		= $obj->row_limit_customers;
	$search_text	= $obj->search_text_customers;
	$star_status    = $obj->star_status;	
	
	if($page != "" && $per_page != "")	
	{
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
			
		$sql_load_data  = " SELECT  * ";
		$sql_load_data  .= " FROM `tbl_customer` AS tc  ";
// 		$sql_load_data  .= " INNER JOIN tbl_customer_company as tcc ON tc.cust_id = tcc.comp_user_id "; //  Company
// 		$sql_load_data  .= " INNER JOIN tbl_customer_gst as tcg ON tc.cust_id = tcg.gst_userid ";//  GST 
// 		$sql_load_data  .= " INNER JOIN tbl_customer_pan as tcp ON tc.cust_id = tcp.pan_userid ";//  PAN 
// 		$sql_load_data  .= " INNER JOIN tbl_customer_bank_details as tcb ON tc.cust_id = tcb.bank_userid ";//  BANK 
// 		$sql_load_data  .= " INNER JOIN tbl_customer_licenses as tcl ON tc.cust_id = tcl.lic_custid ";//  Lic 
		
		$sql_load_data  .= " WHERE 1=1 ";
		$sql_load_data  .= " AND IF(`cust_type`='trader',cust_status,cust_id)!=0 ";
		if(strcmp($utype,'1')!==0)
		{
			$sql_load_data  .= " AND cust_created_by='".$uid."' ";
		}
		if($star_status==1)
		{
			$sql_load_data  .= " AND cust_star='".$star_status."' ";
		}
		if($search_text != "")
		{
			$sql_load_data .= " and (cust_name like '%".$search_text."%' or cust_email like '%".$search_text."%'";
			$sql_load_data .= " or cust_mobile like '%".$search_text."%' ";
			$sql_load_data .= "	or cust_created like '%".$search_text."%' or cust_modified like '%".$search_text."%' or cust_comment like '%".$search_text."%') ";	
		}
		$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
		$sql_load_data .=" ORDER BY cust_created DESC LIMIT $start, $per_page ";
		$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
		if(strcmp($data_count,"0") !== 0)
		{		
			$customers_data = "";	
			$customers_data .= '<table id="tbl_user" class="table table-bordered dataTable" style="width:100%;text-align:center">';
    	 	$customers_data .= '<thead>';
    	  	$customers_data .= '<tr>';
         	$customers_data .= '<th style="text-align:center">Sr No.</th>';
			$edit = checkFunctionalityRight("view_buyers.php",1);
			if($edit)
			{
			$customers_data .= '<th style="text-align:center">Star</th>';
			}
			$customers_data .= '<th style="text-align:center">Cust ID</th>';
			$customers_data .= '<th style="text-align:center">Customer Info</th>';
			$customers_data .= '<th style="text-align:center">Mobile</th>';
			$customers_data .= '<th style="text-align:center">Created Date</th>';		
			$dis = checkFunctionalityRight("view_buyers.php",3);
			if($dis)
			{					
				$customers_data .= '<th style="text-align:center">Status</th>';											
			}
			$edit = checkFunctionalityRight("view_buyers.php",1);
			if($edit)
			{					
				$customers_data .= '<th style="text-align:center">Edit</th>';			
			}	
			$delete = checkFunctionalityRight("view_buyers.php",2);
			
			if($delete)
			{					
				$customers_data .= '<th style="text-align:center"><div style="text-align:center"><input type="button"  value="Delete" onclick="multipleDelete();" class="btn-danger"/></div></th>';
			}
			if($edit)
		    {
			$customers_data .= '<th style="text-align:center">Comments</th>';	
			}
          	$customers_data .= '</tr>';
      		$customers_data .= '</thead>';
      		$customers_data .= '<tbody>';
			while($row_load_data = mysqli_fetch_array($result_load_data))
			{
	    	  	$customers_data .= '<tr>';				
				$customers_data .= '<td style="text-align:center">'.++$start_offset.'</td>';
				$edit = checkFunctionalityRight("view_buyers.php",1);
				if($edit)
				{
					$customers_data .= '<td style="text-align:center"><i id="'.$row_load_data['cust_id'].'star_status" ';
					if($row_load_data['cust_star'] == 1)
					{
						$customers_data .= ' onclick="changeStarStatus(this.id,\'0\');" class="icon-star" style="font-size:30px;cursor:pointer;color:#FFD700;padding:5px;margin-top:10px"></i>';
					}
					else
					{
						$customers_data .= ' onclick="changeStarStatus(this.id,\'1\');" class="icon-star-empty" style="font-size:30px;cursor:pointer;padding:5px;margin-top:10px"></i> ';					
					}
					$customers_data .='</td>';
				}				
				$customers_data .= '<td style="text-align:center">'.$row_load_data['cust_id'].'</td>';
				$customers_data .= '<td><input type="button" value="'.ucwords($row_load_data['cust_name']).'" class="btn-link" id="'.$row_load_data['cust_id'].'" onclick="addMoreCustomers(this.id,\'view\');">';
				$customers_data .= '</td>';
				$customers_data .= '<td style="text-align:center">'.$row_load_data['cust_mobile'].'</td>';
				$date = strtotime($row_load_data['cust_created']);
	           
				$customers_data .= '<td style="text-align:center">'.date(' j F, Y',$date).'</td>';
				
				$dis = checkFunctionalityRight("view_buyers.php",3);
				if($dis)
				{					
					$sql_cload_data  = " SELECT  * ";
					$sql_cload_data  .= " FROM `tbl_customer` AS tc  ";
					$sql_cload_data  .= " INNER JOIN tbl_customer_company as tcc ON tc.cust_id = tcc.comp_user_id "; //  Company
					$sql_cload_data  .= " INNER JOIN tbl_customer_gst as tcg ON tc.cust_id = tcg.gst_userid ";//  GST 
					$sql_cload_data  .= " INNER JOIN tbl_customer_pan as tcp ON tc.cust_id = tcp.pan_userid ";//  PAN 
					$sql_cload_data  .= " INNER JOIN tbl_customer_bank_details as tcb ON tc.cust_id = tcb.bank_userid ";//  BANK 
					$sql_cload_data  .= " INNER JOIN tbl_customer_licenses as tcl ON tc.cust_id = tcl.lic_custid ";//  Lic 
					$sql_cload_data  .= " WHERE tc.cust_id ='".$row_load_data['cust_id']."' ";
					$res_cload_data   = mysqli_query($db_con,$sql_cload_data) or die($db_con);
					$num_cload_data   = mysqli_num_rows($res_cload_data);
					
					$customers_data .= '<td style="text-align:center">';	
					
					if($num_cload_data==0)
					{
						$customers_data .='Registered';
					}
					else
					{
						if($row_load_data['cust_status'] == 1)
						{
							$customers_data .= '<input type="button" value="Approved" id="'.$row_load_data['cust_id'].'" class="btn-success" onclick="changeStatus(this.id,0);">';
							
						}
						else
						{
							$customers_data .= '<input type="button" value="Approve" id="'.$row_load_data['cust_id'].'" class="btn-danger" onclick="changeStatus(this.id,1);">';
						}
					}
					
					$customers_data .= '</td>';	
				}
				$edit = checkFunctionalityRight("view_buyers.php",1);
				if($edit)
				{				
						$customers_data .= '<td style="text-align:center">';
						$customers_data .= '<input type="button" value="Edit" id="'.$row_load_data['cust_id'].'" class="btn-warning" onclick="addMoreCustomers(this.id,\'edit\');"></td>';				
				}
				$edit = checkFunctionalityRight("view_buyers.php",1);
				if($edit)
				{					
					$customers_data .= '<td style="text-align:center"><div class="controls" style="text-align:center">';
					$customers_data .= '<input type="checkbox" value="'.$row_load_data['cust_id'].'" id="customers'.$row_load_data['cust_id'].'" name="customers'.$row_load_data['cust_id'].'" class="css-checkbox customers">';
					$customers_data .= '<label for="customers'.$row_load_data['cust_id'].'" class="css-label"></label>';
					$customers_data .= '</div></td>';										
				}
				
				if($edit)
			    {
				$customers_data .= '<td style="text-align:center">
				<textarea name="comment_'.$row_load_data['cust_id'].'" id="comment_'.$row_load_data['cust_id'].'" onchange="comments('.$row_load_data['cust_id'].');">'.$row_load_data['cust_comment'].'</textarea><br>
				
</td>';							
				}
	          	$customers_data .= '</tr>';															
			}	
      		$customers_data .= '</tbody>';
      		$customers_data .= '</table>';	
			$customers_data .= $data_count;
			$response_array = array("Success"=>"Success","resp"=>$customers_data);					
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Data Available in Customers");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
	}
	echo json_encode($response_array);	
}

if((isset($obj->change_status)) == "1" && isset($obj->change_status))
{
	$cust_id				= $obj->cust_id;
	$curr_status			= $obj->curr_status;
	$response_array 		= array();

	$status_flag = 0;
	$sql_check_parent 		= "Select * from tbl_customer where `cust_id` = '".$cust_id."' ";
	$result_check_parent 	= mysqli_query($db_con,$sql_check_parent) or die(mysqli_error($db_con));
	$row_check_parent 		= mysqli_fetch_array($result_check_parent);
	
	if($curr_status==1)
	{
		
	}
	
	$sql_update_status 		= " UPDATE `tbl_customer` SET `cust_status`= '".$curr_status."' ,`cust_modified` = '".$datetime."' ,`cust_modified_by` = '".$uid."' WHERE `cust_id`='".$cust_id."' ";
	$result_update_status 	= mysqli_query($db_con,$sql_update_status) or die(mysqli_error($db_con));
	if($result_update_status)
	{
		quit('Status Updated Successfully.',1);
	}
	else
	{
		quit('Status Update Failed.');
	}				
}

if((isset($obj->delete_customers)) == "1" && isset($obj->delete_customers))
{
	$response_array = array();		
	$ar_customers_id 		= $obj->customers;
	$del_flag 		= 0; 
	foreach($ar_customers_id as $cust_id)	
	{
		$sql_delete_customers		= " DELETE FROM `tbl_customer` WHERE `cust_id` = '".$cust_id."' ";
		$result_delete_customers	= mysqli_query($db_con,$sql_delete_customers) or die(mysqli_error($db_con));			
		if($result_delete_customers)
		{
			$del_flag = 1;	
		}			
	}
	
	if($del_flag == 1)
	{
		$response_array = array("Success"=>"Success","resp"=>"Record Deletion Success.");			
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Record Deletion failed.");
	}		
	echo json_encode($response_array);	
}

if((isset($obj->reset_pass)) == "1" && isset($obj->reset_pass))
{   
    $cust_email 		= $obj->cust_email;
	if($cust_email != "")
	{
		$sql_check_user 		= " SELECT * FROM `tbl_customer` tc WHERE tc.`cust_email` = '".$cust_email."' ";
		$result_check_user		= mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_rows_check_user 	= mysqli_num_rows($result_check_user); 
		if($num_rows_check_user == 0)
		{
			$response_array = array("Success"=>"fail","resp"=>"<b>".$cust_email."</b> this is not registered email id .");
		}
		else
		{
			$row_check_user 	= mysqli_fetch_array($result_check_user);
			$cust_mobile_num	= $row_check_user['cust_mobile_num'];
			$cust_email			= $row_check_user['cust_email'];
			$cust_fname			= $row_check_user['cust_fname'];
			$subject			= "Forgot Password mail";
			$cust_id			= $row_check_user['cust_id'];
			$cust_salt_value	= $row_check_user['cust_salt_value'];			
			$cust_created		= $row_check_user['cust_created'];				
			$cust_modified		= $row_check_user['cust_modified'];					
			$token				= md5($cust_id.$cust_salt_value.$cust_email.$cust_created.$cust_modified);
			$forget_password_url= $BaseFolder."/page-reset-password.php?userid=".$cust_id."&token=".$token;	
			
			$message_body	= '';
			$message_body .= '<table class="" data-module="main Content" height="100" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
				$message_body .= '<tr>';
					$message_body .= '<td>';
						$message_body .= '<table data-bgcolor="BG Color" height="100" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
							$message_body .= '<tr>';
								$message_body .= '<td>';
									$message_body .= '<table data-bgcolor="BG Color 01" height="100" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
										$message_body .= '<tr>';
											$message_body .= '<td>';
												$message_body .= '<table height="100" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td height="100" width="520">';
															$message_body .= '<table align="center" width="520" border="0" cellpadding="0" cellspacing="0">';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center">  Password Recovery <br></td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-size:14px; color:#494949; font-family:\'Open Sans\', sans-serif; align="left"><br>Dear '.ucwords($cust_fname).',<br></td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td>';
																		$message_body .= '<table data-bgcolor="Color Button 01" class="table-button230-center" style="border-radius: 900px; " height="36" width="230" align="center" bgcolor="#5bbc2e" border="0" cellpadding="0" cellspacing="0">';
																			$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; margin-bottom:20px;font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"><a data-color="Text Button 01" data-size="Text Button 01" data-min="6" data-max="20" href="'.$forget_password_url.'" style="font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;">Reset Password</a></td>';//Here\'s the link to change your password as per your request.</a></td>';
																			$message_body .= '</tr>';
																		$message_body .= '</table>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Name" data-size="Name" align="left"> <br>We have received your request for a new password.<br>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
															$message_body .= '</table>';
														$message_body .= '</td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td data-color="Name" data-size="Name" align="left" style="color:#ccc;"><br> You didn\'t request for a new password? Please write to <a href="mailto:support@planeteducate.com">support@planeteducate.com</a> immediately. <br>';
														$message_body .= '</td>';
													$message_body .= '</tr>';			
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';			
												$message_body .= '</table>';
											$message_body .= '</td>';
										$message_body .= '</tr>';
									$message_body .= '</table>';
								$message_body .= '</td>';
							$message_body .= '</tr>';
						$message_body .= '</table>';
					$message_body .= '</td>';
				$message_body .= '</tr>';
			$message_body .= '</table>';			
					
			$message = mail_template_header()."".$message_body."".mail_template_footer();
			//$message 					= mail_template_header()."".$message_body."".mail_template_footer();
			// sendEmail($cust_email,$subject,$message);
			//$email_message		.= "Please <a href='".$forget_password_url."'>click here</a> to reset password.";
			//if(sendEmail($cust_email,$subject,$message))
			if($cust_email)
			{	
				$res_insert_into_tbl_notification	= '';
				//$res_insert_into_tbl_notification	= insertEmailSmsEntryIntoNotification('Email_forgot_password', $message, $cust_email, $cust_mobile_num);
				
				//sendEmail('support@planeteducate.com',$subject,$message);
			//	$res_insert_into_tbl_notification	= insertEmailSmsEntryIntoNotification('Email_forgot_password', $message, 'support@planeteducate.com', '02261572611');
				
				$response_array = array("Success"=>"Success","resp"=>"<div style='color:green;' align='center'><h4>Please Check your email.</h4></div>");
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"Email not sent please try after sometime");
			}
		}
	}
	else
	{			
		$response_array = array("Success"=>"fail","resp"=>"Email Id Blank");
	}
	$response_array = array("Success"=>"Success","resp"=>"Password Changed Successfully");			
	echo json_encode($response_array);	
}


if((isset($obj->get_comments)) == "1" && isset($obj->get_comments))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= $obj->page;	
	$per_page		= $obj->row_limit_customers;
	$search_text	= $obj->search_text_customers;	
	
	if($page != "" && $per_page != "")	
	{
		
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
			
		$comments_data  = "";
	$cust_id =54;
	if($cust_id != "")
	{  
		$sql_get_comments  = ' SELECT * FROM tbl_review_master as trm ';
		$sql_get_comments .= ' INNER JOIN tbl_products_master as tpm ON trm.review_prod_id = tpm.prod_id  ';
		$sql_get_comments .= ' INNER JOIN tbl_customer as tc ON trm.review_cust_id = tc.cust_id  ';
		$sql_get_comments .= ' INNER JOIN tbl_products_images AS tpi ON tpm.prod_id = tpi.prod_img_prodid  ';
		$sql_get_comments .= ' WHERE review_cust_id=\''.$cust_id.'\' AND tpi.prod_img_type = \'main\' ';
		$data_count		   = 	dataPagination($sql_get_comments,$per_page,$start,$cur_page);
		$sql_get_comments .='  LIMIT '.$start.','. $per_page ;
		
		$result_get_comments = mysqli_query($db_con,$sql_get_comments) or die(mysqli_error($db_con));	
		$num_get_comments  =mysqli_num_rows($result_get_comments);
				
		if(strcmp($data_count,"0") !== 0)
		{		
			$comments_data			    .= '<table class="table table-bordered dataTable" style="width:100%;">';
			$comments_data				.= '<thead>';
			$comments_data				.= '<tr>';
			$comments_data				.= '<th align="center"  style="width="30%">Cust Name</th>';
			$comments_data				.= '<th align="center"  style="width="30%">Product</th>';
			$comments_data				.= '<th align="center" style="width="30%">Image</th>';	
			$comments_data				.= '<th align="center"  style="width="15%">Comment</th>';
			$comments_data				.= '<th align="center"  style="width="10%">Date</th>';
			$comments_data				.= '<th align="center"  style="width="15%">Reply</th>';	
			$comments_data				.= '<tr>';
			$comments_data				.= '</thead>';
			$comments_data				.= '<tbody>';
			while($cmt_row = mysqli_fetch_array($result_get_comments))
			{
	    	  	$comments_data				.= '<tr>';
				$comments_data				.= '<td align="center"   align="center">'.$cmt_row['cust_fname'].' '.$cmt_row['cust_lname'].'</td>';
				$comments_data				.= '<td align="center" style="width="30%" >'.$cmt_row['prod_name'].'</td>';
				$comments_data				.= '<td align="center"  style="width="30%">';
				$imagepath 		= '../images/planet/org'.$cmt_row['prod_orgid'].'/prod_id_'.$cmt_row['prod_id'].'/medium/'.$cmt_row['prod_img_file_name'];
				$comments_data				.= '<img style="width:100px; height="100px" src="'.$imagepath.'"';
				$comments_data				.= '</td>';	
				$comments_data				.= '<td align="center"  style="width:15%">'.$cmt_row['review_content'].'</td>';
				$comments_data				.= '<td align="center" style="width="10%">'.$cmt_row['review_created'].'</td>';
				$comments_data				.= '<td align="center" style="width="15%">Reply</td>';	
				$comments_data				.= '<tr>';														
			}	
      		$comments_data .= '</tbody>';
      		$comments_data .= '</table>';	
			$comments_data .= $data_count;
			
			$response_array = array("Success"=>"Success","resp"=>$comments_data);					
		}
		else
		{ 
			$response_array = array("Success"=>"fail","resp"=>"No Data Available");
		}
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
if((isset($obj->update_comments)) == "1" && isset($obj->update_comments))
{
    $comment  = $obj->comment;
	$cust_id  = $obj->cust_id;
	$response_array = array();
	$sql_update_comment = " UPDATE `tbl_customer` SET `cust_comment`='".$comment."' WHERE cust_id ='".$cust_id."' ";
	$res_update_comment = mysqli_query($db_con,$sql_update_comment) or die(mysqli_error($db_con));
	if($res_update_comment)
	{
		$response_array = array("Success"=>"Success","resp"=>$sql_update_comment);
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"");
	}
	echo json_encode($response_array);
}
if((isset($obj->update_starstatus)) == "1" && isset($obj->update_starstatus))
{
    $status  = $obj->status;
	$cust_id  = $obj->cust_id;
	$response_array = array();
	$sql_update_star = " UPDATE `tbl_customer` SET `cust_star`='".$status."' WHERE cust_id ='".$cust_id."' ";
	$res_update_star = mysqli_query($db_con,$sql_update_star) or die(mysqli_error($db_con));
	if($res_update_star)
	{
		$response_array = array("Success"=>"Success","resp"=>$sql_update_comment);
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"");
	}
	echo json_encode($response_array);
}


if(isset($_POST['insert_buyer']) && $_POST['insert_buyer']!='')
{
		$data['cust_type']  	   =  sqlInjection($_POST['cust_type']);
		$data['cust_email']   	   =  sqlInjection($_POST['cust_email']);
		$data['cust_mobile']       =  sqlInjection($_POST['cust_mobile']);
		$data['cust_name']    	   =  sqlInjection($_POST['cust_name']);
		$data['cust_created']      =  $datetime;
		$data['cust_created_by']   =  $uid;
		
		$cust_email_query			= " SELECT * FROM tbl_customer WHERE 1=1 ";
		$cust_email_status		    = randomString($cust_email_query, 'cust_emailstatus', 5, 'email');
		$data['cust_emailstatus']   = $cust_email_status;
		$data['cust_status']   		= 2;
		
		
		
		$salt   					= generateRandomString(5);
		$data['cust_salt']        	= trim($salt);
		$password                   = generateRandomString(8);
		$data['cust_password']   	= trim(md5($password.$salt));
		
		$sql_check_user =" SELECT * FROM tbl_customer WHERE cust_email='".$data['cust_email']."' or cust_mobile='".$data['cust_mobile']."'";
		$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_check_user = mysqli_num_rows($res_check_user);
		if($num_check_user==0)
		{
			insert('tbl_customer',$data);
			// =====================================================================================================
			// START : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
			// =====================================================================================================
			$subject		= 'IDB - Email Verification';
			/* create body for Update mail message */			
			$message_body = '<table class="" data-module="main Content" height="347" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
				$message_body .= '<tr>';
					$message_body .= '<td>';
						$message_body .= '<table data-bgcolor="BG Color" height="347" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
							$message_body .= '<tr>';
								$message_body .= '<td>';
									$message_body .= '<table data-bgcolor="BG Color 01" height="347" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
										$message_body .= '<tr>';
											$message_body .= '<td>';
												$message_body .= '<table height="347" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td height="345" width="520">';
															$message_body .= '<table height="300" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" class="td-pad10" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center">  Email Verification. </td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="font-weight:600; letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="left"> Dear '.ucwords($data[$type.'name']).', <br>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td>';
																		$message_body .= '<table data-bgcolor="Color Button 01" class="table-button230-center" style="border-radius: 900px;" height="36" width="230" align="center" bgcolor="#5bbc2e" border="0" cellpadding="0" cellspacing="0">';
																			$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"><a align="center" data-color="Text Button 01" data-size="Text Button 01" data-min="6" data-max="20" href="'.$BaseFolder.'/verify/'.$cust_email_status.'" style="font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;">Verify your Email</a></td>';
																			$message_body .= '</tr>';
																			
																		$message_body .= '</table>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; font-weight:bold; font-size:15px; color:#; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"> Your Password is '.$password.'</td>';
																$message_body .= '</tr>';
															$message_body .= '</table>';
														$message_body .= '</td>';
													$message_body .= '</tr>';
												$message_body .= '</table>';
											$message_body .= '</td>';
										$message_body .= '</tr>';			
										$message_body .= '<tr style="padding-top:10px;">';
											$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center"> We look forward to make your online shopping a wonderful experience';
											$message_body .= '<br>Please contact us should you have any questions or need further assistance.';
											$message_body .= '</td>';
										$message_body .= '</tr>';
										$message_body .= '<tr>';
											$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
										$message_body .= '</tr>';						
									$message_body .= '</table>';
								$message_body .= '</td>';
							$message_body .= '</tr>';
						$message_body .= '</table>';
					$message_body .= '</td>';
				$message_body .= '</tr>';
			$message_body .= '</table>';
			/* create body for Update mail message */
			/* create a mail template message*/
			$message = mail_template_header()."".$message_body."".mail_template_footer();
			
			
			if(sendEmail($data['cust_email'],$subject,$message))
			{
			  
				$noti['type']			= 'Email_Verification_Mail';
				$noti['message']		= htmlspecialchars($message, ENT_QUOTES);
				$noti['user_email']		= $data['cust_email'];
				$noti['user_mobile_num']= $data['cust_mobile'];
				$noti['created_date']	= $datetime;
				
				$noti_data	= insert('tbl_notification',$noti);
				
				 
			}
			else
			{
				quit('Email not sent please try after sometime');
			}
			quit('Buyer added successfully...!',1);
			// =====================================================================================================
			// END : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
			// =====================================================================================================
		}
		else
		{
			quit('Email or Mobile already Exist...!');
		}
}


?>