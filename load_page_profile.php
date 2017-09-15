<?php
	include("includes/db_con.php");
	include('includes/query-helper.php');
	include('includes/random-helper.php');
	include('includes/email-helper.php');
	include('includes/city-state-country-helper.php');
	
	// ===============================================================================
	// START : From Profile Dn By Prathamesh On 05-Sep-2017
	// ===============================================================================
	if((isset($_POST['hid_frm_profile']))== '1' && (isset($_POST['hid_frm_profile'])))
	{
		$data['cust_name']		= mysqli_real_escape_string($db_con,$_POST['txt_name']);
		$data['cust_email']		= mysqli_real_escape_string($db_con,$_POST['txt_email']);
		$data['cust_mobile']	= mysqli_real_escape_string($db_con,$_POST['txt_mobile']);
		
		$where_arr['cust_id']	= mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		
		if($where_arr['cust_id'] != '' && $data['cust_name'] != '' && $data['cust_email'] != '' && $data['cust_mobile'] != '')
		{
			// Query for checking the duplicate email id
			$num_duplicate_email_id	= isExist('tbl_customer', array("cust_email"=>$data['cust_email']), array("cust_id"=>$where_arr['cust_id']));
			
			// Query for checking the duplicate Mobile Number
			$num_duplicate_mobile	= isExist('tbl_customer', array("cust_mobile"=>$data['cust_mobile']), array("cust_id"=>$where_arr['cust_id']));
			
			if($num_duplicate_email_id)
			{
				quit('Ooppsss, Email already exist in system please another email-id!');	
			}
			if($num_duplicate_mobile)
			{
				quit('Ooppsss, Mobile Number already exist in system please another mobile number!');	
			}
			
			$data['cust_status']		= '2';
			$data['cust_modified']		= $datetime;
			$data['cust_modified_by']	= '';
			
			// Query For update the User's Basic Information
			$res_update_user_profile	= update('tbl_customer', $data, $where_arr);
			
			if(!$res_update_user_profile)
			{
				quit('Ooppsss, Something went wrong!', 0);
			}

			if($_SESSION['front_panel']['cust_email'] != $data['cust_email'])
			{
				$_SESSION['front_panel']	= array();
				// remove all session variables
				session_unset();
				// destroy the session
				session_destroy(); 
				
				$cust_email_query	= " SELECT * FROM tbl_customer WHERE 1=1 ";
				$cust_email_status	= randomString($cust_email_query, 'cust_emailstatus', 5, 'email');
				
				// Query for updating the user email verification code
				$res_update_user_email_verification_code	= update('tbl_customer', array('cust_emailstatus' => $cust_email_status, "cust_modified"=>$datetime), $where_arr);

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
																		$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="font-weight:600; letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="left"> Dear '.ucwords($data['cust_name']).', <br>';
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
				//quit($message);
				
				/*if(sendEmail($data['cust_email'],$subject,$message))
				{*/
					$noti['type']			= 'Email_Verification_Mail';
					$noti['message']		= htmlspecialchars($message, ENT_QUOTES);
					$noti['user_email']		= $data['cust_email'];
					$noti['user_mobile_num']= $data['cust_mobile'];
					$noti['created_date']	= $datetime;
					
					$noti_data	= insert('tbl_notification',$noti);
				/*}
				else
				{
					quit('Email not sent please try after sometime');
				}*/
				// =====================================================================================================
				// END : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
				// =====================================================================================================
				
				quit('email_verufication', 1);
			}
			else
			{
				$_SESSION['front_panel']	= array();
				
				// Query For setting the session again through user id
				$sql_get_user_info	= " SELECT * FROM `tbl_customer` WHERE `cust_id`='".$where_arr['cust_id']."' ";
				$res_get_user_info	= mysqli_query($db_con, $sql_get_user_info) or die(mysqli_error($db_con));
				$num_get_user_info	= mysqli_num_rows($res_get_user_info);
				
				if($num_get_user_info != 0)
				{
					$row_get_user_info			= mysqli_fetch_array($res_get_user_info);
					$_SESSION['front_panel']	= $row_get_user_info;
					quit('Update Successfully', 1);
				}
				else
				{
					quit('Ooppsss, Something went wrong!', 0);
				}
			}
		}
		else
		{
			quit("All fields must be required!", 0);	
		}
	}
	// ===============================================================================
	// END : From Profile Dn By Prathamesh On 05-Sep-2017
	// ===============================================================================


	// ===============================================================================
	// START : From Company Information Dn By Prathamesh On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['hid_frm_comp_info']))== '1' && (isset($_POST['hid_frm_comp_info'])))
	{
		$data['comp_pri_email']		= mysqli_real_escape_string($db_con,$_POST['txt_pri_email']);
		$data['comp_pri_phone']		= mysqli_real_escape_string($db_con,$_POST['txt_pri_phone']);
		
		$data['comp_name']			= mysqli_real_escape_string($db_con,$_POST['txt_comp_name']);
		$data['comp_sec_email']		= mysqli_real_escape_string($db_con,$_POST['txt_sec_email']);
		$data['comp_sec_phone']		= mysqli_real_escape_string($db_con,$_POST['txt_alt_phone']);
		$data['comp_website']		= mysqli_real_escape_string($db_con,$_POST['txt_website']);
		$data['comp_bill_address']	= mysqli_real_escape_string($db_con,$_POST['txt_billing_address']);
		$data['comp_bill_state']	= mysqli_real_escape_string($db_con,$_POST['txt_bill_state']);
		$data['comp_bill_city']		= mysqli_real_escape_string($db_con,$_POST['txt_bill_city']);
		$data['comp_bill_pincode']	= mysqli_real_escape_string($db_con,$_POST['txt_bill_pincode']);
		$data['comp_ship_address']	= mysqli_real_escape_string($db_con,$_POST['txt_shipping_address']);
		$data['comp_ship_state']	= mysqli_real_escape_string($db_con,$_POST['txt_shipping_state']);
		$data['comp_ship_city']		= mysqli_real_escape_string($db_con,$_POST['txt_shipping_city']);
		$data['comp_ship_pincode']	= mysqli_real_escape_string($db_con,$_POST['txt_shipping_pincode']);
		$data['comp_descp']			= mysqli_real_escape_string($db_con,$_POST['txt_description']);
		$data['comp_user_id']		= mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		
		$where_arr['comp_user_id']	= mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		
		if($data['comp_pri_email'] != '' && $data['comp_pri_phone'] != '' && $data['comp_name'] != '' && $data['comp_website'] != '' && $data['comp_bill_address'] != '' && $data['comp_bill_state'] != '' && $data['comp_bill_city'] != '' && $data['comp_bill_pincode'] != '' && $data['comp_ship_address'] != '' && $data['comp_ship_state'] != '' && $data['comp_ship_city'] != '' && $data['comp_ship_pincode'] != '' && $data['comp_descp'] != '' && $data['comp_user_id'] != '')
		{
			// Query for checking the duplicate email id

			$num_duplicate_email_id	= isExist('tbl_customer', array("cust_email"=>$data['comp_pri_email']), array("cust_id"=>$where_arr['comp_user_id']));
			
			// Query for checking the duplicate Mobile Number
			$num_duplicate_mobile	= isExist('tbl_customer', array("cust_mobile"=>$data['comp_pri_phone']), array("cust_id"=>$where_arr['comp_user_id']));

			$num_duplicate_email_id	= isExist('tbl_customer', array("cust_email"=>$data['cust_email']), array("cust_id"=>$where_arr['cust_id']));
			
			// Query for checking the duplicate Mobile Number
			$num_duplicate_mobile	= isExist('tbl_customer', array("cust_mobile"=>$data['cust_mobile']), array("cust_id"=>$where_arr['cust_id']));

			
			if($num_duplicate_email_id)
			{
				quit('Ooppsss, Email already exist in system please another email-id!');	
			}
			if($num_duplicate_mobile)
			{
				quit('Ooppsss, Mobile Number already exist in system please another mobile number!');	
			}
			
			// Query for Getting all the information of the company for respective user-id
			$sql_get_comp_info	= " SELECT * FROM `tbl_customer_company` WHERE `comp_user_id`='".$where_arr['comp_user_id']."' ";
			$res_get_comp_info	= mysqli_query($db_con, $sql_get_comp_info) or die(mysqli_error($db_con));
			$num_get_comp_info	= mysqli_num_rows($res_get_comp_info);
			
			if($num_get_comp_info != 0)
			{

				$data['comp_status']		= '2';
				$data['comp_modified_date']	= $datetime;
				$data['comp_modified_by']	= '';
				
				// Update Query
				// Query For update the User's Basic Information
				$res_update_user_company	= update('tbl_customer_company', $data, $where_arr);
				
				if($res_update_user_company)
				{
					if($_SESSION['front_panel']['cust_email'] != $data['cust_email'])
					{
						$_SESSION['front_panel']	= array();
						// remove all session variables
						session_unset();
						// destroy the session
						session_destroy(); 
						
						$cust_email_query	= " SELECT * FROM tbl_customer WHERE 1=1 ";
						$cust_email_status	= randomString($cust_email_query, 'cust_emailstatus', 5, 'email');
						
						// Query for updating the user email verification code
						$res_update_user_email_verification_code	= update('tbl_customer', array('cust_emailstatus' => $cust_email_status, "cust_modified"=>$datetime), $where_arr);
						$res_update_user_email_verification_code	= update('tbl_customer', array('cust_emailstatus' => $cust_email_status), $where_arr);
		
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
																				$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="font-weight:600; letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="left"> Dear '.ucwords($data['cust_name']).', <br>';
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
						//quit($message);
						
						/*if(sendEmail($data['cust_email'],$subject,$message))
						{*/
							$noti['type']			= 'Email_Verification_Mail';
							$noti['message']		= htmlspecialchars($message, ENT_QUOTES);
							$noti['user_email']		= $data['cust_email'];
							$noti['user_mobile_num']= $data['cust_mobile'];
							$noti['created_date']	= $datetime;
							
							$noti_data	= insert('tbl_notification',$noti);
						/*}
						else
						{
							quit('Email not sent please try after sometime');
						}*/
						// =====================================================================================================
						// END : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
						// =====================================================================================================
						
						quit('email_verufication', 1);	
					}
					else
					{
						$_SESSION['front_panel']	= array();
				
						// Query For setting the session again through user id
						$sql_get_user_info	= " SELECT * FROM `tbl_customer` WHERE `cust_id`='".$where_arr['cust_id']."' ";
						$res_get_user_info	= mysqli_query($db_con, $sql_get_user_info) or die(mysqli_error($db_con));
						$num_get_user_info	= mysqli_num_rows($res_get_user_info);
						
						if($num_get_user_info != 0)
						{
							$row_get_user_info			= mysqli_fetch_array($res_get_user_info);
							$_SESSION['front_panel']	= $row_get_user_info;
							quit('Update Successfully!', 1);
						}
						else
						{
							quit('Ooppsss, Something went wrong!', 0);
						}			
					}
				}
				else
				{
					quit('Updation Failed!', 0);
				}
			}
			else
			{
				$data['comp_status']		= '2';
				$data['comp_created_date']	= $datetime;
				$data['comp_created_by']	= '';
				
				// Insert Query
				// Query For update the User's Basic Information
				$res_update_user_company	= insert('tbl_customer_company', $data);
				
				if($res_update_user_company)
				{
					quit('Insert Successfully!', 1);
				}
				else
				{
					quit('Insertion Failed!', 0);
				}
			}
		}
		else
		{
			quit("Please fill the required fields!", 0);
		}
	}
	// ===============================================================================
	// END : From Company Information Dn By Prathamesh On 06-Sep-2017
	// ===============================================================================

	if((isset($obj->getStatesCity)) == '1' && (isset($obj->getStatesCity)))
	{
		$state_id	= $obj->state_id;
		$city_select_id	= $obj->city_select_id;
		$data    	= '';
		if($state_id != '')
		{
			$data 	= getStatesCity($state_id, $city_select_id);

			quit(utf8_encode($data), 1);
		}
		else
		{
			quit('Ooppsss, Something went wrong', 0);
		}
	}
	
	// ===============================================================================
	// START : Pan Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_pan_req']))== '1' && (isset($_POST['add_pan_req'])))
	{
		$data['pan_userid']  = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['pan_no']      = mysqli_real_escape_string($db_con,$_POST['txt_pan_no']);
		$data['pan_created'] = $datetime;
		
		if($data['pan_no']=="" || !isset($_FILES['file_pan_image']['name']))
		{
			quit('Pan Number and Image is required...!');
		}
		
		$pan_image_size      = $_FILES['file_pan_image']['size'];
		if($pan_image_size > 5242880 &&  $pan_image_size !=0) // file size
		{
			quit('Image size should be less than 5 MB');
		}
		
		$pan_image_name               = explode('.',$_FILES['file_pan_image']['name']);
		$pan_image_name               = date('dhyhis').'_'.$data['pan_userid'].'.'.$pan_image_name[1];
		$data['pan_image']            = $pan_image_name;
		
		$dir                          = 'idbpanel/documents/pan/'.$pan_image_name;
		
		if(move_uploaded_file($_FILES['file_pan_image']['tmp_name'],$dir))
		{
			$res                          = insert('tbl_customer_pan',$data);
			
			if($res)
			{
				quit('Added Successfully...!',1);
			}
			else
			{
				quit('fail');
			}
		}
		
	}
	
	
	if((isset($_POST['update_pan_req']))== '1' && (isset($_POST['update_pan_req'])))
	{
		$where_arr['pan_userid']  = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['pan_no']           = mysqli_real_escape_string($db_con,$_POST['txt_pan_no']);
		$data['pan_modified']     = $datetime;
		$data['pan_status']       = 0;
		if($data['pan_no']=="")
		{
			quit('Pan Number is required...!');
		}
		
		$panRow = checkExist('tbl_customer_pan',array('pan_userid'=>$where_arr['pan_userid']));
		
		if(isset($_FILES['file_pan_image']['name']) && $_FILES['file_pan_image']['name']!="")
		{
			$pan_image_size      = $_FILES['file_pan_image']['size'];
			if($pan_image_size > 5242880 &&  $pan_image_size !=0) // file size
			{
				quit('Image size should be less than 5 MB');
			}
			
			$pan_image_name               = explode('.',$_FILES['file_pan_image']['name']);
			$pan_image_name               = date('dhyhis').'_'.$where_arr['pan_userid'].'.'.$pan_image_name[1];
			$data['pan_image']            = $pan_image_name;
			
			$dir                          = 'idbpanel/documents/pan/'.$pan_image_name;
			if(move_uploaded_file($_FILES['file_pan_image']['tmp_name'],$dir))
			{
				unlink('idbpanel/documents/pan/'.$panRow['pan_image']);
				$res                          = update('tbl_customer_pan',$data,$where_arr);
				
				if($res)
				{
					quit('Update Successfully...!',1);
				}
				else
				{
					quit('fail');
				}
			}
			
		}
		else
		{
			 update('tbl_customer_pan',$data,$where_arr);
			 quit('Update Successfully...!',1);
		}
		
		
	}
	
	// ===============================================================================
	// End : Pan Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
	
	// ===============================================================================
	// START : GST Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_gst_req']))== '1' && (isset($_POST['add_gst_req'])))
	{
		$data['gst_userid']  = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['gst_no']      = mysqli_real_escape_string($db_con,$_POST['txt_gst_no']);
		$data['gst_created'] = $datetime;
		
		if($data['gst_no']=="" || !isset($_FILES['file_gst_image']['name']) || !isset($_FILES['file_gst_ack_image']['name']))
		{
			quit('GST Number and Image is required...!');
		}
		
		if($_FILES['file_gst_image']['name']=="" || $_FILES['file_gst_ack_image']['name']=="")
		{
			quit('Image is required...!');
		}
		$gst_image_size      = $_FILES['file_gst_image']['size'];
		$gst_ack_image_size  = $_FILES['file_gst_ack_image']['size'];
		if($gst_image_size > 5242880 &&  $gst_image_size !=0) // file size
		{
			quit('GST Image size should be less than 5 MB');
		}
		
		
		if($gst_ack_image_size > 5242880 &&  $gst_ack_image_size !=0) // file size
		{
			quit('GST Acknowledgement size should be less than 5 MB');
		}
		
		$gst_image_name               = explode('.',$_FILES['file_gst_image']['name']);
		$gst_image_name               = date('dhyhis').'_'.$data['gst_userid'].'.'.$gst_image_name[1];
		$data['gst_image']            = $gst_image_name;
		
		$gst_ack_image_name           = explode('.',$_FILES['file_gst_ack_image']['name']);
		$gst_ack_image_name           = date('dhyhis').'_ACK'.$data['gst_userid'].'.'.$gst_ack_image_name[1];
		$data['gst_ack_image']            = $gst_ack_image_name;
		
		$dir                          = 'idbpanel/documents/gst/'.$gst_image_name;
		$dir1                         = 'idbpanel/documents/gst/'.$gst_ack_image_name;
		
		if(move_uploaded_file($_FILES['file_gst_image']['tmp_name'],$dir))
		{
			if(move_uploaded_file($_FILES['file_gst_ack_image']['tmp_name'],$dir1))
		    {
				$res                          = insert('tbl_customer_gst',$data);
			    if($res)
				{
					quit('Success',1);
				}
				else
				{
					quit('Something went wrong...!');
				}
			}
			else
			{
				quit('Something went wrong...!');
			}
			
		}
		else
		{
			quit('Something went wrong...!');
		}
	}
	
	if((isset($_POST['update_gst_req']))== '1' && (isset($_POST['update_gst_req'])))
	{
		$where_arr['gst_userid']  = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['gst_no']           = mysqli_real_escape_string($db_con,$_POST['txt_gst_no']);
		$data['gst_modified']     = $datetime;
		$data['gst_status']       = 0;
		if($data['gst_no']=="")
		{
			quit('GST Number is required...!');
		}
		
		$gstRow = checkExist('tbl_customer_gst',array('gst_userid'=>$where_arr['gst_userid']));
		
		if($_FILES['file_gst_image']['name']!="")
		{
			$gst_image_size      = $_FILES['file_gst_image']['size'];
			if($gst_image_size > 5242880 &&  $gst_image_size !=0) // file size
			{
				quit('GST Image size should be less than 5 MB');
			}
			
			$gst_image_name               = explode('.',$_FILES['file_gst_image']['name']);
			$gst_image_name               = date('dhyhis').'_'.$where_arr['gst_userid'].'.'.$gst_image_name[1];
			$dir                          = 'idbpanel/documents/gst/'.$gst_image_name;
			
			if(move_uploaded_file($_FILES['file_gst_image']['tmp_name'],$dir))
		    {
				unlink('idbpanel/documents/gst/'.$gstRow['gst_image']);
				$data['gst_image']            = $gst_image_name;
			}
		}
		
		if($_FILES['file_gst_ack_image']['name']!="")
		{
			$gst_image_size      = $_FILES['file_gst_ack_image']['size'];
			if($gst_image_size > 5242880 &&  $gst_image_size !=0) // file size
			{
				quit('GST Image size should be less than 5 MB');
			}
			
			$file_gst_ack_image               = explode('.',$_FILES['file_gst_ack_image']['name']);
			$file_gst_ack_image               = date('dhyhis').'_ACL'.$where_arr['gst_userid'].'.'.$file_gst_ack_image[1];
			$dir1                             = 'idbpanel/documents/gst/'.$file_gst_ack_image;
			
			if(move_uploaded_file($_FILES['file_gst_ack_image']['tmp_name'],$dir1))
		    {
				unlink('idbpanel/documents/gst/'.$gstRow['gst_ack_image']);
				$data['gst_ack_image']        = $file_gst_ack_image;
			}
		}
		
		$res                          = update('tbl_customer_gst',$data,$where_arr);
		if($res)
		{
		 	quit('Update Successfully...!',1);
		}
		else
		{
			quit('Something went wrong...!');
		}
	}
	
	// ===============================================================================
	// End : GST Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
	// ===============================================================================
	// START : Bank Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_bank_req']))== '1' && (isset($_POST['add_bank_req'])))
	{
		$data['bank_userid']   = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['bank_name']     = mysqli_real_escape_string($db_con,$_POST['txt_bank_name']);
		$data['bank_username'] = mysqli_real_escape_string($db_con,$_POST['txt_bank_username']);
		$data['bank_branch']   = mysqli_real_escape_string($db_con,$_POST['txt_bank_address']);
		$data['bank_acc_no']   = mysqli_real_escape_string($db_con,$_POST['txt_bank_accno']);
		$data['bank_ifsc']     = mysqli_real_escape_string($db_con,$_POST['txt_ifsc_code']);
		$data['bank_created']  = $datetime;
		
		if($data['bank_userid']=="" || $data['bank_acc_no']=="" ||  $data['bank_ifsc']=="" || $data['bank_name']=="" || $_FILES['file_bank_image']['name']=="")
		{
			quit('All fields are mandotory...!');
		}
		
		if($_FILES['file_bank_image']['name']=="" || $_FILES['file_bank_image']['name']=="")
		{
			quit('Image is required...!');
		}
		
		$bank_image_size      = $_FILES['file_bank_image']['size'];
		
		if($bank_image_size > 5242880 &&  $bank_image_size !=0) // file size
		{
			quit('GST Image size should be less than 5 MB');
		}
		
		$bank_image_name               = explode('.',$_FILES['file_bank_image']['name']);
		$bank_image_name               = date('dhyhis').'_'.$data['bank_userid'].'.'.$bank_image_name[1];
		$data['bank_image']            = $bank_image_name;
		
		$dir                          = 'idbpanel/documents/banks/'.$bank_image_name;
		
		if(move_uploaded_file($_FILES['file_bank_image']['tmp_name'],$dir))
		{
			$res                          = insert('tbl_customer_bank_details',$data);
			if($res)
			{
				quit('Added Successfully...!',1);
			}
			else
			{
				quit('Something went wrong...!');
			}
		}
		else
		{
			quit('Something went wrong...!');
		}
	}
	
	
	if((isset($_POST['update_bank_req']))== '1' && (isset($_POST['update_bank_req'])))
	{
		$where_arr['bank_userid']   = mysqli_real_escape_string($db_con,$_POST['hid_userid']);
		$data['bank_name']     = mysqli_real_escape_string($db_con,$_POST['txt_bank_name']);
		$data['bank_username'] = mysqli_real_escape_string($db_con,$_POST['txt_bank_username']);
		$data['bank_branch']   = mysqli_real_escape_string($db_con,$_POST['txt_bank_address']);
		$data['bank_acc_no']   = mysqli_real_escape_string($db_con,$_POST['txt_bank_accno']);
		$data['bank_ifsc']     = mysqli_real_escape_string($db_con,$_POST['txt_ifsc_code']);
		$data['bank_created']  = $datetime;
		
		if($where_arr['bank_userid']=="" || $data['bank_acc_no']=="" ||  $data['bank_ifsc']=="" || $data['bank_name']=="" )
		{
			quit('All fields are mandotory...!');
		}
		
		$bankRow = checkExist('tbl_customer_bank_details',array('bank_userid'=>$where_arr['bank_userid']));
		
		if(isset($_FILES['file_bank_image']['name']) && $_FILES['file_bank_image']['name']!="")
		{
			$bank_image_size      = $_FILES['file_bank_image']['size'];
			if($bank_image_size > 5242880 &&  $bank_image_size !=0) // file size
			{
				quit('Image size should be less than 5 MB');
			}
			
			$bank_image_name               = explode('.',$_FILES['file_bank_images']['name']);
			$bank_image_name               = date('dhyhis').'_'.$where_arr['bank_userid'].'.'.$bank_image_name[1];
			$data['bank_image']             = $bank_image_name;
			
			$dir                          = 'idbpanel/documents/bank/'.$bank_image_name;
			if(move_uploaded_file($_FILES['file_bank_image']['tmp_name'],$dir))
			{
				$res                          = update('tbl_customer_bank_details',$data,$where_arr);
				
				if($res)
				{
					quit('Update Successfully...!',1);
				}
				else
				{
					quit('Something went wrong...!');
				}
			}
			
		}
		else
		{
			 update('tbl_customer_bank_details',$data,$where_arr);
			 quit('Update Successfully...!',1);
		}
	}
	
	// ===============================================================================
	// End : Bank Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
	// ===============================================================================
	// START : Doctor License Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_doctor_lic_req']))== '1' && (isset($_POST['add_doctor_lic_req'])))
	{
		$data['lic_number']        = mysqli_real_escape_string($db_con,$_POST['txt_lic_no']);
		$data['lic_custid']        = $_SESSION['front_panel']['cust_id'];
		$data['lic_created']     = $datetime;
		
		if($data['lic_number']=="" || !isset($_FILES['file_lic_image']['name']))
		{
			quit('License Number and Image is required...!');
		}
		
		$lic_image_size      = $_FILES['file_lic_image']['size'];
		if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
		{
			quit('Image size should be less than 5 MB');
		}
		
		$lic_image_name               = explode('.',$_FILES['file_lic_image']['name']);
		$lic_image_name               = date('dhyhis').'_'.$data['lic_custid'].'.'.$lic_image_name[1];
		$data['lic_document']            = $lic_image_name;
		
		$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
		
		if(move_uploaded_file($_FILES['file_lic_image']['tmp_name'],$dir))
		{
			$res                          = insert('tbl_licenses',$data);
			
			if($res)
			{
				quit('Added Successfully...!',1);
			}
			else
			{
				quit('Something went wrong...!');
			}
		}
		
	}
	
	
	if((isset($_POST['update_doctor_lic_req']))== '1' && (isset($_POST['update_doctor_lic_req'])))
	{
		$where_arr['lic_custid']  = $_SESSION['front_panel']['cust_id'];
		$data['lic_number']       = mysqli_real_escape_string($db_con,$_POST['txt_lic_no']);
		$data['lic_modified']     = $datetime;
		$data['lic_status']       = 2;
		if($data['lic_number']=="")
		{
			quit('License Number is required...!');
		}
		
		$licRow = checkExist('tbl_licenses',array('lic_custid'=>$where_arr['lic_custid']));
		
		if(isset($_FILES['file_lic_image']['name']) && $_FILES['file_lic_image']['name']!="")
		{
			$lic_image_size      = $_FILES['file_lic_image']['size'];
			if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
			{
				quit('Image size should be less than 5 MB');
			}
			
			$lic_image_name               = explode('.',$_FILES['file_lic_image']['name']);
			$lic_image_name               = date('dhyhis').'_'.$where_arr['lic_custid'].'.'.$lic_image_name[1];
			$data['lic_image']            = $lic_image_name;
			
			$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
			if(move_uploaded_file($_FILES['file_lic_image']['tmp_name'],$dir))
			{
				unlink('idbpanel/documents/licenses/'.$licRow['lic_image']);
				$res                          = update('tbl_licenses',$data,$where_arr);
				
				if($res)
				{
					quit('Update Successfully...!',1);
				}
				else
				{
					quit('Something went wrong...!');
				}
			}
			else
			{
				quit('Something went wrong...!');
			}
			
		}
		else
		{
			 update('tbl_licenses',$data,$where_arr);
			 quit('Update Successfully...!',1);
		}
    }
	
	// ===============================================================================
	// End : Doctor LIcense Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
	// ===============================================================================
	// START : Doctor License Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_hospital_lic_req']))== '1' && (isset($_POST['add_hospital_lic_req'])))
	{
		$data['lic_custid']      = $_SESSION['front_panel']['cust_id'];
		$data['lic_created']     = $datetime;
		$data['lic_type']        = 'New';
		
		
		$data['lic_number']      = mysqli_real_escape_string($db_con,$_POST['txt_hospital_lic_no']);
		$data['lic_exipiry_date'] = mysqli_real_escape_string($db_con,$_POST['lic_hospital_date']);
		
	  
		
		if($data['lic_number']=="" || $data['lic_exipiry_date']=="") 
		{
			quit("All filed ae required...!");
		}
		
		if(!isset($_FILES['file_lic_image'])) 
		{
			quit('Document is required...!');
		}
		
		$lic_image_size      = $_FILES['file_lic_image']['size'];
		if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
		{
			quit('Hospital License Document size should be less than 5 MB');
		}
		
		$lic_image_name               = explode('.',$_FILES['file_lic_image']['name']);
		$lic_image_name               = date('dhyhis').'_1_'.$data['lic_custid'].'.'.$lic_image_name[1];
		$data['lic_document']         = $lic_image_name;
		
		$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
		
		if(move_uploaded_file($_FILES['file_lic_image']['tmp_name'],$dir))
		{
			$res                          = insert('tbl_licenses',$data);
			if($res)
			{
				quit('Added Successfully...!',1);
			}
			else
			{
				quit('Something went wrong...!');
			}
		}
		else
		{
			quit('Something went wrong...!');
		}
		
	}
	
	
	if((isset($_POST['update_hospital_lic_req']))== '1' && (isset($_POST['update_hospital_lic_req'])))
	{
		$renewal_count  		   = mysqli_real_escape_string($db_con,$_POST['renewal_count']);
		$where_arr['lic_custid']   = $_SESSION['front_panel']['cust_id'];
		$data['lic_status']		   = 2;
		
		$data['lic_number']        = mysqli_real_escape_string($db_con,$_POST['txt_hospital_lic_no']);
		$data['lic_exipiry_date']  = mysqli_real_escape_string($db_con,$_POST['lic_hospital_date']);
		
		if($data['lic_number']=="" && $data['lic_exipiry_date']=="") 
		{
			//quit('All fields are required...!');
			quit("License Number are required...");
		}
		
		$licRow = checkExist('tbl_licenses',array('lic_custid'=>$where_arr['lic_custid']));
		
		if(isset($_FILES['file_lic_image']['name']) && $_FILES['file_lic_image']['name']!="")
		{
			$lic_image_size      = $_FILES['file_lic_image']['size'];
			if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
			{
				quit('Hospital License Document size should be less than 5 MB');
			}
			
			$lic_image_name               = explode('.',$_FILES['file_lic_image']['name']);
			$lic_image_name               = date('dhyhis').'_1_'.$where_arr['lic_custid'].'.'.$lic_image_name[1];
			$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
			if(move_uploaded_file($_FILES['file_lic_image']['tmp_name'],$dir))
		    {
				$data['lic_document']   = $lic_image_name;
				unlink('idbpanel/documents/licenses/'.$licRow['lic_document']);
			}
		}
		$where_arr['lic_type']	      = "New";
		$res                          = update('tbl_licenses',$data,$where_arr);
		if($renewal_count > 0)
		{
			for($i=1; $i <=$renewal_count;$i++)
			{   
				$data['lic_number']        = mysqli_real_escape_string($db_con,$_POST['txt_hospital_lic_no'.$i]);
		        $data['lic_exipiry_date']  = mysqli_real_escape_string($db_con,$_POST['lic_hospital_date'.$i]);
				$data['lic_type']  		   = 'Renewal'.$i;
				$licRow = checkExist('tbl_licenses',array('lic_custid'=>$where_arr['lic_custid'],"lic_type"=>"Renewal".$i));
				if(!$licRow) // Start Insertion of Renewal
				{
					$data['lic_custid'] =   $_SESSION['front_panel']['cust_id'];
					if($data['lic_number']=="" || $data['lic_exipiry_date']=="") 
					{
						quit("All filed ae required...!");
					}
					
					if(!isset($_FILES['file_lic_image'.$i])) 
					{
						quit('Document is required...!');
					}
					
					$lic_image_size      = $_FILES['file_lic_image'.$i]['size'];
					if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
					{
						quit('Hospital License Document size should be less than 5 MB');
					}
					
					$lic_image_name               = explode('.',$_FILES['file_lic_image'.$i]['name']);
					$lic_image_name               = date('dhyhis').$i.$data['lic_custid'].'.'.$lic_image_name[1];
					$data['lic_document']         = $lic_image_name;
					
					$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
					
					if(move_uploaded_file($_FILES['file_lic_image'.$i]['tmp_name'],$dir))
					{
						$res                          = insert('tbl_licenses',$data);
						if(!$res)
						{
							quit('Something went wrong...!');
						}
					}
					else
					{
						quit('Something went wrong...!');
					}
				}////////Start Updatetion of Renewal
				else
				{
					if($data['lic_number']=="" && $data['lic_exipiry_date']=="") 
					{
						//quit('All fields are required...!');
						quit("License Number are required...");
					}
					
					$licRow = checkExist('tbl_licenses',array('lic_custid'=>$where_arr['lic_custid'],'lic_type'=>"Renewal".$i));
					
					if(isset($_FILES['file_lic_image'.$i]['name']) && $_FILES['file_lic_image'.$i]['name']!="")
					{
						$lic_image_size      = $_FILES['file_lic_image'.$i]['size'];
						if($lic_image_size > 5242880 &&  $lic_image_size !=0) // file size
						{
							quit('Hospital License Document size should be less than 5 MB');
						}
						
						$lic_image_name               = explode('.',$_FILES['file_lic_image'.$i]['name']);
						$lic_image_name               = date('dhyhis').$i.$where_arr['lic_custid'].'.'.$lic_image_name[1];
						$dir                          = 'idbpanel/documents/licenses/'.$lic_image_name;
						if(move_uploaded_file($_FILES['file_lic_image'.$i]['tmp_name'],$dir))
						{
							$data['lic_document']   = $lic_image_name;
							unlink('idbpanel/documents/licenses/'.$licRow['lic_document']);
						}
					}
					$where_arr['lic_type']	      = "Renewal".$i;
					$res                          = update('tbl_licenses',$data,$where_arr);
				}
			}
			
		}
	    if($res)
		{
			quit('Update Successfully...!',1);
		}
		else
		{
			quit('Something went wrong...!');
		}
		
	}
	
	// ===============================================================================
	// End : Doctor LIcense Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
	
	// ===============================================================================
	// START : Chemist License Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	if((isset($_POST['add_chemist_lic_req']))== '1' && (isset($_POST['add_chemist_lic_req'])))
	{
		$data20B['lic_number']      = mysqli_real_escape_string($db_con,$_POST['txt_20b_lic_no']);
		$data21B['lic_number']      = mysqli_real_escape_string($db_con,$_POST['txt_21b_lic_no']);
		$data20B['lic_type']        = '20B';
		$data21B['lic_type']        = '21B';
		$data21B['lic_exipiry_date']				= mysqli_real_escape_string($db_con,$_POST['lic_21Bexpiry_date']);
		$data20B['lic_exipiry_date']				= mysqli_real_escape_string($db_con,$_POST['lic_20Bexpiry_date']);
		
		$data21B['lic_custid']             = $_SESSION['front_panel']['cust_id'];
		$data21B['lic_created']            = $datetime;
		$data20B['lic_custid']             = $_SESSION['front_panel']['cust_id'];
		$data20B['lic_created']            = $datetime;
		
		if($data20B['lic_number']!="" || $data21B['lic_number']!="")
		{
			if(!isset($_FILES['file_lic_20b_image']['size']) && $_FILES['file_lic_20b_image']['size']=="" || !isset($_FILES['file_lic_21b_image']['size']) && $_FILES['file_lic_21b_image']['size']=="")
			{
				  quit('20B and 21B Document are required...!');
			}
			
			$file_20b_image_size      = $_FILES['file_lic_20b_image']['size'];
			if($file_20b_image_size > 5242880 &&  $file_20b_image_size !=0) // file size
			{
				quit('20B License Document size should be less than 5 MB');
			}
			
			$file_21b_image_size      = $_FILES['file_lic_21b_image']['size'];
			if($file_21b_image_size > 5242880 &&  $file_21b_image_size !=0) // file size
			{
				quit('21B License Document size should be less than 5 MB');
			}
			
			$lic_20b_image               = explode('.',$_FILES['file_lic_20b_image']['name']);
			$lic_20b_image               = date('dhyhis').'_20B_'.$data20B['lic_custid'].'.'.$lic_20b_image[1];
			$data20B['lic_document']       = $lic_20b_image;
			
			$lic_21b_image               = explode('.',$_FILES['file_lic_21b_image']['name']);
			$lic_21b_image               = date('dhyhis').'_21B_'.$data21B['lic_custid'].'.'.$lic_21b_image[1];
			$data21B['lic_document']       = $lic_21b_image;
			
			$dir                          = 'idbpanel/documents/licenses/'.$lic_20b_image;
		    $dir1                         = 'idbpanel/documents/licenses/'.$lic_21b_image;
			
			if(move_uploaded_file($_FILES['file_lic_20b_image']['tmp_name'],$dir))
		    {
				insert('tbl_licenses',$data20B);
				
				if(move_uploaded_file($_FILES['file_lic_21b_image']['tmp_name'],$dir1))
				{
					insert('tbl_licenses',$data21B);
					quit('Added Successfully...!');
				}
				else
				{
					quit('Something went wrong...!');
				}
			}
			else
			{
				quit('Something went wrong...!');
			}
			
		}
		
		if($_POST['txt_20c_lic_no'] !="")
		{
			$data['lic_number']       = mysqli_real_escape_string($db_con,$_POST['txt_20c_lic_no']);
			$file_20c_image_size      = $_FILES['file_lic_20c_image']['size'];
			$data['lic_custid']       = $_SESSION['front_panel']['cust_id'];
			$data['lic_created']      = $datetime;
			$data['lic_exipiry_date'] = mysqli_real_escape_string($db_con,$_POST['lic_20Cexpiry_date']);
			if($file_20c_image_size > 5242880 &&  $file_20c_image_size !=0) // file size
			{
				quit('21C License Document size should be less than 5 MB');
			}
			
			$lic_20c_image               = explode('.',$_FILES['file_lic_20c_image']['name']);
			$lic_20c_image               = date('dhyhis').'_20C_'.$data['lic_custid'].'.'.$lic_20c_image[1];
			$data['lic_document']        = $lic_20c_image;
			$data['lic_type'	]        = '20C';
			$dir2                        = 'idbpanel/documents/licenses/'.$lic_20c_image;
			if(move_uploaded_file($_FILES['file_lic_20c_image']['tmp_name'],$dir2))
		    {
				insert('tbl_licenses',$data);
				quit('Added Successfully...!',1);
			}
			else
			{
				quit('Something went wrong...!');
			}
			
		}
	}
	
	
	if((isset($_POST['update_chemist_lic_req']))== '1' && (isset($_POST['update_chemist_lic_req'])))
	{
		$data20B['lic_number']      = mysqli_real_escape_string($db_con,$_POST['txt_20b_lic_no']);
		$data21B['lic_number']      = mysqli_real_escape_string($db_con,$_POST['txt_21b_lic_no']);
		$data20B['lic_type']        = '20B';
		$data21B['lic_type']        = '21B';
		
		$where_21B['lic_custid']   = $_SESSION['front_panel']['cust_id'];
		$data21B['lic_created']    = $datetime;
		$where_20B['lic_custid']   = $_SESSION['front_panel']['cust_id'];
		$data20B['lic_created']    = $datetime;
		
		if($data20B['lic_number']!="" || $data21B['lic_number']!="")
		{
			if(isset($_FILES['file_lic_20b_image']['size']) && $_FILES['file_lic_20b_image']['size'] !="")
			{
				$file_20b_image_size      = $_FILES['file_lic_20b_image']['size'];
				if($file_20b_image_size > 5242880 &&  $file_20b_image_size !=0) // file size
				{
					quit('20B License Document size should be less than 5 MB');
				}
				$lic_20b_image               = explode('.',$_FILES['file_lic_20b_image']['name']);
				$lic_20b_image               = date('dhyhis').'_20B_'.$data20B['lic_custid'].'.'.$lic_20b_image[1];
				$dir                         = 'idbpanel/documents/licenses/'.$lic_20b_image;
				if(move_uploaded_file($_FILES['file_lic_20b_image']['tmp_name'],$dir))
		 		{
					$data20B['lic_document']       = $lic_20b_image;
				}
				
			}
			
			if(isset($_FILES['file_lic_21b_image']['size']) && $_FILES['file_lic_21b_image']['size'] !="")
			{
				$file_20b_image_size      = $_FILES['file_lic_21b_image']['size'];
				if($file_20b_image_size > 5242880 &&  $file_20b_image_size !=0) // file size
				{
					quit('20B License Document size should be less than 5 MB');
				}
				$lic_21b_image               = explode('.',$_FILES['file_lic_21b_image']['name']);
				$lic_21b_image               = date('dhyhis').'_21B_'.$data21B['lic_custid'].'.'.$lic_21b_image[1];
				$dir                         = 'idbpanel/documents/licenses/'.$lic_21b_image;
				if(move_uploaded_file($_FILES['file_lic_21b_image']['tmp_name'],$dir))
		 		{
					$$data21B['lic_document']     = $lic_21b_image;
				}
				
			}
			$where_21B['lic_type'] ="21B";
			$where_20B['lic_type'] ="20B";
			$res = update('tbl_licenses',$data20B,$where_20B);
			$res = update('tbl_licenses',$data21B,$where_21B);
		}
		///================Insertion And Updation Start here Satish 15092017============//
		if($_POST['lic_id'])
		{
			//quit($_POST['lic_id']);
			for($i=0;$i<sizeof($_POST['lic_id']);$i++)
			{
				if($_POST['lic_id'][$i]=="")
				{
					$data['lic_number']       = mysqli_real_escape_string($db_con,$_POST['txt_20c_lic_no'][$i]);
					$file_20c_image_size      = $_FILES['file_lic_20c_image']['size'][$i];
					$data['lic_custid']       = $_SESSION['front_panel']['cust_id'];
					$data['lic_created']      = $datetime;
					$data['lic_exipiry_date'] = mysqli_real_escape_string($db_con,$_POST['lic_20Cexpiry_date'][$i]);
					if($file_20c_image_size > 5242880 &&  $file_20c_image_size !=0) // file size
					{
						quit('21C License Document size should be less than 5 MB');
					}
					
					$lic_20c_image               = explode('.',$_FILES['file_lic_20c_image']['name'][$i]);
					$lic_20c_image               = date('dhyhis').'_20C_'.$data['lic_custid'].'.'.$lic_20c_image[1];
					$data['lic_document']        = $lic_20c_image;
					$data['lic_type'	]        = '20C';
					$dir2                        = 'idbpanel/documents/licenses/'.$lic_20c_image;
					if(move_uploaded_file($_FILES['file_lic_20c_image']['tmp_name'][$i],$dir2))
					{
						insert('tbl_licenses',$data);
						quit('Added Successfully...!',1);
					}
					else
					{
						quit('Something went wrong...!');
					}
				}
				else
				{
					$data['lic_number']       = mysqli_real_escape_string($db_con,$_POST['txt_20c_lic_no'][$i]);
					$data['lic_exipiry_date'] = mysqli_real_escape_string($db_con,$_POST['lic_20Cexpiry_date'][$i]);
					$data['lic_custid']       = $_SESSION['front_panel']['cust_id'];
					$data['lic_created']      = $datetime;
					if(isset($_FILES['file_lic_20c_image']['size'][$i]) && $_FILES['file_lic_20c_image']['size'][$i] !="")
					{
						$file_20c_image_size      = $_FILES['file_lic_20c_image']['size'][$i];
						if($file_20c_image_size > 5242880 &&  $file_20c_image_size !=0) // file size
						{
							quit('21C License Document size should be less than 5 MB');
						}
						$lic_20c_image               = explode('.',$_FILES['file_lic_20c_image']['name'][$i]);
						$lic_20c_image               = date('dhyhis').'_20C_'.$data['lic_custid'].'.'.$lic_20c_image[1];
						$dir2                        = 'idbpanel/documents/licenses/'.$lic_20c_image;
						if(move_uploaded_file($_FILES['file_lic_20c_image']['tmp_name'][$i],$dir2))
					    {
							$data['lic_document']        = $lic_20c_image;
						}
					}
					
					$data['lic_type'	]        = '20C';
					//quit($_POST['lic_id'][$i]);
					
					$res = update('tbl_licenses',$data,array("license_id"=>$_POST['lic_id'][$i]));
				}
				
			}// for end
			quit("Update Successfully...!",1);
		}// if end
	}
	
	// ===============================================================================
	// End : Doctor LIcense Information Dn By Satish On 06-Sep-2017
	// ===============================================================================
	
?>