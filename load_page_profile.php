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
		$data['cust_name']		= $_POST['txt_name'];
		$data['cust_email']		= $_POST['txt_email'];
		$data['cust_mobile']	= $_POST['txt_mobile'];
		
		$where_arr['cust_id']	= $_POST['hid_userid'];
		
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

	if((isset($obj->getStatesCity)) == '1' && (isset($obj->getStatesCity)))
	{
		$state_id	= $obj->state_id;
		$data    	= '';
		if($state_id != '')
		{
			$data 	= getStatesCity($state_id);

			quit(utf8_encode($data), 1);
		}
		else
		{
			quit('Ooppsss, Something went wrong', 0);
		}
	}
?>