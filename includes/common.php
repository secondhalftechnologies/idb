<?php

include('db_con.php');


if(isset($_POST['txt_usergrp']) && $_POST['txt_usergrp'] !='')
{
	$response_array      = array();
	$txt_user_type       = mysqli_real_escape_string($db_con,$_POST['txt_user_type']);
	
	if($txt_user_type=='buyer')
	{  
		$type                = "cust_";
		$table_name          = 'tbl_customer';
		$data['	cust_type']  = mysqli_real_escape_string($db_con,$_POST['txt_usergrp']);
		//quit($table_name);
	}
	else
	{
		$type       ="vendor_";
		$table_name = 'tbl_vendor';
	}
	
	$data[$type.'name']            = mysqli_real_escape_string($db_con,$_POST['txt_name']);
	$data[$type.'email']           = mysqli_real_escape_string($db_con,$_POST['txt_email']);
	$data[$type.'mobile']          = mysqli_real_escape_string($db_con,$_POST['txt_mobile']);
	$data[$type.'password']        = mysqli_real_escape_string($db_con,$_POST['txt_password']);
	$confirm_password              = mysqli_real_escape_string($db_con,$_POST['txt_cpassword']);
	$data[$type.'pan']             = mysqli_real_escape_string($db_con,$_POST['txt_pan_num']);
	$data[$type.'gst']             = mysqli_real_escape_string($db_con,$_POST['txt_gst_num']);
	
	$data[$type.'created']         = $datetime;
	if($data[$type.'password']!=$confirm_password)
	{
		quit('Password and Confirm Password not matched...!');
	}
	
	$salt   = generateRandomString(6);
	$data[$type.'salt']        = $salt;
	$data[$type.'password']   = md5($data[$type.'password'].$salt);
	
	 
	 
	//====================Start : Licence Data=====================================================// 
	$ldata['lic_number']           = mysqli_real_escape_string($db_con,$_POST['txt_license_num']);
	$file_size =$_FILES['file_license_pdf']['size'];
	if($file_size > 5242880 &&  $file_size !=0) // file size
	{
		quit('Image size should be less than 5 MB');
	}
	$file_name                    = explode('.',$_FILES['file_license_pdf']['name']);
	$file_name                    = date('dhyhis').'.'.$file_name[1];
	$ldata['lic_document']        = $file_name;
	$ldata['lic_cust_type']       = $txt_user_type;
	$ldata['lic_created']         = $datetime;
	$ldata['lic_exipiry_date']                    =  mysqli_real_escape_string($db_con,$_POST['txt_expiry_date']);
	//====================End : Licence Data=====================================================// 
	
	
	
	//====================Start : Bank Data=====================================================// 
	
	$bdata['bank_name']            = mysqli_real_escape_string($db_con,$_POST['txt_bank_name']);
	$bdata['branch_name']          = mysqli_real_escape_string($db_con,$_POST['txt_branch_name']);
	$bdata['acc_number']           = mysqli_real_escape_string($db_con,$_POST['txt_acc_num']);
	$bdata['ifsc']                 = mysqli_real_escape_string($db_con,$_POST['txt_ifsc']);
	$bdata['micr']                 = mysqli_real_escape_string($db_con,$_POST['txt_micr']);
	$bdata['bank_created']         =$datetime;
	$bdata['bcust_type']           =$txt_user_type;
	
	//====================End : Bank Data=====================================================// 
	
	
	//====================Start :  Data=====================================================// 
	
	$adata['add_country']          = mysqli_real_escape_string($db_con,$_POST['txt_country']);
	$adata['add_state']            = mysqli_real_escape_string($db_con,$_POST['txt_state']);
	$adata['add_pincode']          = mysqli_real_escape_string($db_con,$_POST['txt_pincode']);
	$adata['add_area']             = mysqli_real_escape_string($db_con,$_POST['txt_area']);
	$adata['add_created']          = $datetime;
	$adata['add_usertype']         = $txt_user_type;
	
	//====================End : Address Data=====================================================// 
	
	
	$sql_check_user =" SELECT * FROM ".$table_name." WHERE ".$type."email='".$data[$type.'email']."' or ".$type."mobile='".$data[$type.'mobile']."'";
 	$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
	$num_check_user = mysqli_num_rows($res_check_user);
	if($num_check_user==0)
	{
		$dir                          = '../'.$type.'document/'.$file_name;
		
		if(move_uploaded_file($_FILES['file_license_pdf']['tmp_name'],$dir))
		{
			$res                          = insert($table_name,$data);
			$cust_id 					  = mysqli_insert_id($db_con);
			$ldata['lic_custid']          = $cust_id;
			$bdata['bank_custid']         = $cust_id;
			$adata['add_custid']		  = $cust_id;
			
			if($res)
			{
				$res     = insert('tbl_licenses',$ldata);
				$res     = insert('tbl_bank_details',$bdata);
				$res     = insert('tbl_address',$adata);
				quit('Success',1);
			}
			else
			{
				quit('fail');
			}
		}
		else
		{
			quit('Please try letter...!');
		}
	}
	else
	{
		quit('Mobile Number or Email already registered...!');
	}
}
?>