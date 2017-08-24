<?php

include('db_con.php');
$json 				= file_get_contents('php://input'); // get json request
$obj 				= json_decode($json); // general object which converts json request to php object

////////////////==Start : Registration Satish:21082017================//////
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
////////////////==End : Registration Satish:21082017================//////

////////////////==Start : Login Satish:21082017================//////
if((isset($obj->login_customer)) == "1" && isset($obj->login_customer))// user login
{
	$cust_email 		 = trim(mysqli_real_escape_string($db_con,$obj->txt_email));
	$cust_password_login = trim($obj->txt_password);
	$cli_browser_info	 = trim(mysqli_real_escape_string($db_con,$obj->cli_browser_info));
	$cli_ip_address 	 = trim(mysqli_real_escape_string($db_con,$obj->cli_ip_address));	
	
	if($cust_email == "" || $cust_password_login == "" )
	{
		quit("Please Provide Email and Password.");
	}
	else
	{
		$sql_get_user_login 	= "SELECT * FROM `tbl_customer` WHERE `cust_email` like '".$cust_email."' ";
		$result_get_user_login	= mysqli_query($db_con,$sql_get_user_login) or die(mysqli_error($db_con));
		$num_rows_get_user_login= mysqli_num_rows($result_get_user_login);
		//
		if($num_rows_get_user_login == 1)
		{
			$row_get_user_login			= mysqli_fetch_array($result_get_user_login);
			if($row_get_user_login['cust_status']==0)
			{
				quit('Something went wrong...!');
			}
			/* data base password */
			$cust_password_db_login		= trim($row_get_user_login['cust_password']);
			/* data base password */
			/* database salt*/
			$cust_salt_value_db_login	= trim($row_get_user_login['cust_salt']);
			/* database salt*/
			/*md5(old pwd + salt )*/
			$cust_password_user_login	= trim(md5($cust_salt_value_db_login.$cust_password_login));
			/*md5(old pwd + salt )*/	
			
			if($cust_password_user_login == $cust_password_db_login)
			{
				$cust_id				= $row_get_user_login['cust_id'];
				
				$data['cli_custid']       = $cust_id;	
				$data['cli_browser_info'] = $cli_browser_info;	
				$data['cli_ip_address']   = $cli_ip_address;	
				$data['cli_created']      = $datetime;	
				
				insert('tbl_customer_login_info',$data);		
				
				$cust_mobile_status	= $row_get_user_login['cust_mobilestatus'];
				
				$_SESSION['front_panel'] = $row_get_user_login;
				quit('Success',1);
				if($cust_mobile_status != 1)
				{
					//quit('Mobile Number not Verified..');
				}
				
				quit('Success',1);
			}				
			else
			{
				quit("Incorrect Login Details.");
			}
		}
		else
		{
			quit('Incorrect Login Details.');
		}
	}
}
////////////////==End : Login Satish:21082017================//////

?>