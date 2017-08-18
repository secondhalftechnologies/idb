// JavaScript Document
if(location.hostname == 'localhost' || location.hostname == '127.0.0.1' || location.hostname == '192.168.1.249')
{
	//var base_url = window.location.origin+"/planeteducate/";	
	var base_url = "http://192.168.1.249/planeteducate_sm/";
}
else
{
	var base_url = window.location.origin+"/";
}


//var base_url = "http://192.168.1.249/planeteducate_sm/";
function ToggleMyDiv(div_id)
{
	$("#"+div_id).slideToggle();
}
function TogglpayWay(req)
{
	 if(req=="hide")
	 {
	$("#payment_way").slideUp();
	 }
	 else
	 {
	 $("#payment_way").slideDown();
	 }
}
function div_swap(div_open,div_close)
{
	$("#"+div_open).slideDown();
	$("#"+div_close).slideUp();
}

//============================================================================================================
// START : SWAP THE DIV ON CHECKOUT AND PAGE-PROFILE
//============================================================================================================
function div_swap1(div_open,div_close,div_close1)
{
	$("#"+div_open).slideDown();
	$("#"+div_close).slideUp();
	$("#"+div_close1).slideUp();
}
//============================================================================================================
// END : SWAP THE DIV ON CHECKOUT AND PAGE-PROFILE
//============================================================================================================
	
function changePrice(quantity)
{
	actual_recommended_price = parseInt($("#actual_recommended_price").val());
	actual_recommended_new_price = quantity * actual_recommended_price;
	$("#main_recommended_price").html(actual_recommended_new_price);
	
	actual_list_price = parseInt($("#actual_list_price").val());
	if(actual_list_price != 0)
	{
		actual_list_new_price = quantity * actual_list_price;
		$("#main_list_price").html(actual_list_new_price);		
	}
}
function checkBoxStyle(chk_id)
{
	chk_class = $('#'+chk_id).attr('class');
	if(chk_class == "fa fa-check-empty")
	{
		$('#'+chk_id).removeClass('fa fa-check-empty').addClass('fa fa-check');			
	}
	else if(chk_class == "fa fa-check")
	{
		$('#'+chk_id).removeClass('fa fa-check').addClass('fa fa-check-empty');
	}		
}
function loading_show()
{
		document.getElementById('lodermodal').style.display = 'block';
		document.getElementById('loderfade').style.display = 'block';
	}
function loading_hide()
{
		document.getElementById('lodermodal').style.display = 'none';
		document.getElementById('loderfade').style.display = 'none';
	}
function changeClass(this_id)
{
	this_class = $('#'+this_id).attr('class');
	if(this_class == "fa fa-chevron-up")
	{
		$('#'+this_id).removeClass('fa fa-chevron-up').addClass('fa fa-chevron-down');			
	}
	else if(this_class == "fa fa-chevron-down")
	{
		$('#'+this_id).removeClass('fa fa-chevron-down').addClass('fa fa-chevron-up');
	}
}
function isNumberKey(evt) //This is for only numeric value
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	{
		return false;
	}
	return true;
}
function viewCart(cart_id)
{
	loading_show();
	
	var	cust_session	= $("#cust_session").val();
	var sendInfo 		= {"cust_session":cust_session,"cart_id":cart_id,"getCart":1}
	var cart_data 		= JSON.stringify(sendInfo);			
	$.ajax({
		url: base_url+"includes/main.php",
		type: "POST",
		data: cart_data,
		contentType: "application/json; charset=utf-8",						
		async:false,			
		success: function(response) 
		{
			data = JSON.parse(response);
			if(data.Success == "Success")
			{
				//alert(cart_id);
				$("#"+cart_id).html(data.resp);					
				$("#cart-count").html(data.count);
				if(cart_id == "content")
				{
					if(data.checkout == 0)					
					{						
						$("#checkout-process-btn").hide();
					}
				}
				loading_hide();
			} 
			else if(data.Success == "fail")
			{
				$("#"+cart_id).html(data.resp);
				$("#checkout_btn").slideUp();
				$("#cart-count").html(data.count);
				if(cart_id == "content")
				{
					if(data.checkout == 0)					
					{						
						$("#checkout-process-btn").hide();
					}
				}					
				loading_hide();				
			}
		},
		error: function (request, status, error) 
		{
			$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
			$('#error_model').modal({
										backdrop: 'static'
								  });
			loading_hide();				
		},
		complete: function()
		{
			loading_hide();
		}
	});
}
function removeItem(cart_id)
{
		loading_show();
		var sendInfo 	= {"cart_id":cart_id,"deleteFromCart":1}
		var remove_prod = JSON.stringify(sendInfo);			
		$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: remove_prod,
			contentType: "application/json; charset=utf-8",		
			async:false,			
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
					viewCart('content');								
					loading_hide();
				}
				else
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });
				}
			},
			error: function (request, status, error)
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				$('#error_model').modal({
										backdrop: 'static'
								  });
			},
			complete: function()
			{
			}
		});
	}	
function addToCart(prod_id)
{
		loading_show();
		var	cust_session		= $("#cust_session").val();
		var user_prod_quentity 	= $.trim($("#user_prod_quentity"+prod_id).val());
		// done by satish for product quantity validation
		if(user_prod_quentity >10)
		{
			user_prod_quentity = 10;
		}
		/// done by satish end
		if(user_prod_quentity == "" || typeof user_prod_quentity == "undefined")
		{
			user_prod_quentity = 1;
		}
		//var user_coupon_code	= $("#coupon_code").val();
		if(prod_id == "")
		{
			location.href="https://www.planeteducate.com"
		}
		else
		{
			var sendInfo 	= {"addToCart":1,"prod_id":prod_id,"cust_session":cust_session,"user_prod_quentity":user_prod_quentity} 	// ,"user_coupon_code":user_coupon_code
			var cart_plus 	= JSON.stringify(sendInfo);			
			$.ajax({
				url: base_url+"includes/main.php",
				type: "POST",
				data: cart_plus,
				contentType: "application/json; charset=utf-8",						
				async:false,
				success: function(response) 
				{ 
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{						
						$("#my_cart").html(data.resp);
						$("#cart-count").html(data.count);
/*						$("#model_body").html('<span style="style="color:#F00;">Added in Cart</span>');
						$('#error_model').modal('toggle');*/						
						loading_hide();					
					} 
					else 
					{
						$("#cart-count").html(data.count);						
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
						loading_hide();						
					}
				},
				error: function (request, status, error) 
				{
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });
					loading_hide();					
				},
				complete: function()
				{
				}
			});
		}
	}
function checkMobileUser(mobile_txt,cust_mobile_num,req_page,mobile_error_span)
{			
			var	cust_session= $("#cust_session").val();
			if(mobile_txt == "" || cust_mobile_num == "" || req_page == "" || mobile_error_span == "")
			{
				$("#"+mobile_txt).css("border-color", "");
				$("#"+mobile_error_span).html("");
				$("#"+mobile_error_span).slideUp();
			}
			else
			{
				var sendInfo 	= {"mobile_check":1,"cust_mobile_num":cust_mobile_num,"req_page":req_page,"cust_session":cust_session};
				var mobile_check = JSON.stringify(sendInfo);			
				$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: mobile_check,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#"+mobile_txt).css("border-color", "#00FF00");
							$("#"+mobile_error_span).html("");							
							$("#"+mobile_error_span).slideUp();							
							loading_hide();
						} 
						else 
						{
							$("#"+mobile_txt).css("border-color", "red");							
							$("#"+mobile_error_span).slideDown();							
							$("#"+mobile_error_span).html(data.resp);
							$("#"+mobile_txt).val("");							
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">Mobile number already exist.</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
							return false;
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
           			}
				});
			}
		}
function updateState(country_id,state_sel_id)
{			
		loading_show();		
		country_val = $("#"+country_id).val();
		if(country_val == "")
		{
			loading_hide();
			location.href="/";
		}
		else
		{
			var sendInfo 		= {"update_state":1,"country_val":country_val}
			var update_state	= JSON.stringify(sendInfo);			
			$.ajax({
				url: base_url+"includes/main.php",
				type: "POST",
				data: update_state,
				contentType: "application/json; charset=utf-8",						
				async:false,				
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						$("#"+state_sel_id).html(data.resp);
						//$("#"+state_sel_id).select2();
						loading_hide();
					} 
					else 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });
				},
				complete: function()
				{
      			}	
	    	});
			}
		}
function updateCity(state_id,city_sel_id)
{
		loading_show();
			state_val = $("#"+state_id).val();
			if(state_val == "")
			{
				//location.href="/";
				loading_hide();
				$('#'+city_sel_id).select2("val","");
				$('#'+city_sel_id).select2('refresh')
				
			
			}
			else
			{
				var sendInfo 	= {"update_city":1,"state_val":state_val}
				var update_city	= JSON.stringify(sendInfo);			
				$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: update_city,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#"+city_sel_id).html(data.resp);
							//$("#"+city_sel_id).select2();
							loading_hide();
						} 
						else 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
           			}
		    	});
			}
		}
function checkEmailUser(email_txt,cust_email,req_page,email_error_span)
{
			var	cust_session= $("#cust_session").val();
			if(cust_email == "" || email_txt == "" || req_page == "" || email_error_span == "")
			{
				$("#"+email_txt).css("border-color", "");
				$("#"+email_error_span).html("");
				$("#"+email_error_span).slideUp();
			}
			else
			{
				var sendInfo 	= {"email_check":1,"cust_email":cust_email,"req_page":req_page,"cust_session":cust_session}
				var email_check = JSON.stringify(sendInfo);			
				
				$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: email_check,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#"+email_txt).css("border-color", "#00FF00");				
							$("#"+email_error_span).html("");										
							$("#"+email_error_span).slideUp();
														
							loading_hide();	
						} 
						else 
						{
							$("#"+email_txt).css("border-color", "red");
							$("#"+email_error_span).slideDown();							
							$("#"+email_error_span).html(data.resp);
							$("#"+email_txt).val("");							
							loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
           			}
		    	});
			}
		}
function chk_password(password_field,confirm_password_field,password_field_error)
{
			var cust_password 			= $.trim($("#"+password_field).val());
			var cust_confirm_password	= $.trim($("#"+confirm_password_field).val());
	
			if(cust_password != "" && cust_confirm_password != "")
			{
				if(cust_password == cust_confirm_password)
				{
					$("#"+password_field_error).html('<span style="color:green;">Password Matched...</span>');
				}
				else
				{
					$("#"+password_field_error).html('<span style="color:red;">Password Not Matched...</span>');
				}				
			}
			else
			{
				$("#"+password_field_error).html('<span style="color:red;">Please fill data</span>');	
			}
		}		
function checkStrength(password_field,password_error_span)
{
		var password = $("#"+password_field).val();
		var strength = 0
		if (password.length = 0) 
		{ 
			$('#'+password_error_span).removeClass()
			$('#'+password_error_span).addClass('short')
			$('#'+password_error_span).html('');
		}		
		if (password.length < 8) 
		{ 
			$('#'+password_error_span).removeClass()
			$('#'+password_error_span).addClass('short')
			$('#'+password_error_span).html('Too short');
		}
		if (password.length < 8) 
		{
			$('#'+ password_error_span).html(" ");
			return false; 
		}		
		if (password.length > 7) strength += 1		
		//If password contains both lower and uppercase characters, increase strength value.
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1

		//If it has numbers and characters, increase strength value.
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//If it has one special character, increase strength value.
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1

		//if it has two special characters, increase strength value.
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1

		//Calculated strength value, we can return messages
		//If value is less than 2
		if (strength < 2 )
		{
			$('#'+password_error_span).removeClass()
			$('#'+password_error_span).addClass('weak')
			$('#'+password_error_span).html('Weak');
		}
		else if (strength == 2 )
		{
			$('#'+password_error_span).removeClass()
			$('#'+password_error_span).addClass('good')
			$('#'+password_error_span).html('Good');
		}
		else
		{
			$('#'+password_error_span).removeClass()
			$('#'+password_error_span).addClass('strong')
			$('#'+password_error_span).html('Strong');
		}
	}		
$('#user_register').on('submit', function(e) 
{
			e.preventDefault();
			if ($('#user_register').valid())
			{
				loading_show();
				var cust_fname 			= $.trim($("#cust_fname_register").val());
				var cust_lname 			= $.trim($("#cust_lname_register").val());
				var cust_email 			= $.trim($("#cust_email_register").val());
				var cust_mobile_num	 	= $.trim($("#cust_mobile_num_register").val());
				
				var cust_address 		= $.trim($("#cust_address_register").val());
				var cust_country		= $.trim($("#cust_country_register").val());
				var cust_state 			= $.trim($("#cust_state_register").val());
				var cust_city 			= $.trim($("#cust_city_register").val());
				var cust_pincode 		= $.trim($("#cust_pincode_register").val());
		
				var cust_password 		= $.trim($("#cust_password_register").val());
				var cust_cpassword 		= $.trim($("#cust_cpassword_register").val());
				
				var cust_type 			= $('input:radio[name=cust_type]:checked').val();
				var cust_Agreement 		= $('input:checkbox[name=Agreement]:checked').val();
				
				/*alert('hi : '+cust_Agreement);
				return false;*/
				
				var cli_browser_info	= navigator.userAgent;
				var cli_ip_address		= "";
				//IPINFO DOES NOT SUPPORT SSL FOR FREE
				//$.get("https://ipinfo.io", function(response) 
				//{
        		//	cli_ip_address		= response.ip ;
        			cli_ip_address		= "0.0.0.0";
				//}, "jsonp");
				
				
				
				if(cust_fname == "" || cust_lname == "" || cust_email == "" || cust_mobile_num =="" || cust_password == "" || cust_cpassword == "" || typeof cust_type == "undefined" || typeof cust_Agreement == "undefined")
				{		
					$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');									
					$('#error_model').modal({
										backdrop: 'static'
								  });
					loading_hide();			
				}
				else
				{
					
					
					$('input[name="reg_submit_reg"]').attr('disabled', 'true');
					var sendInfo 		= {"cust_fname":cust_fname,"cust_lname":cust_lname,"cust_email":cust_email,"cust_mobile_num":cust_mobile_num,"cust_address":cust_address,"cust_country":cust_country,"cust_state":cust_state,"cust_city":cust_city,"cust_pincode":cust_pincode,"cust_password":cust_password, "cust_type":cust_type, "cli_browser_info":cli_browser_info,"cli_ip_address":cli_ip_address,"user_register":1}
					var user_reg 	= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: user_reg,
						async:false,						
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								//$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								//$('#error_model').modal('toggle');								
								loading_hide();
								//$('button.close-popup').on('click', function() 
								//{
									var redirect_to = $("#redirect_to").val();
									if(redirect_to != "")
									{
										window.location.href = base_url+redirect_to;										
									}
									else
									{
										//window.location.href = base_url+"page-profile";
										window.location.href = base_url+"user-mobile-verify";
									}
								//});	
							} 
							else 
							{	
								loading_hide();
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal({
										backdrop: 'static'
								  });
							}
						},
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						},
						complete: function()
						{
           				}
		    		});
				}
			}
		});
		
function logout_session(session_value)
{
		loading_show();
		if(session_value == "")
		{
			location.href = "/";
		}
		else
		{
			var sendInfo 	= {"logout_this":1,"session_value":session_value}
			var user_logout = JSON.stringify(sendInfo);			
			$.ajax({
				url: base_url+"includes/main.php",
				type: "POST",
				data: user_logout,
				async:false,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						//setTimeout("",10000);
						window.location.href="/";
					} 
					else 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });
				},
				complete: function()
				{
           		}
		    });			
		}
	}	
$('#user_login').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#user_login').valid())
			{
				loading_show();
				var cust_email 			= $.trim($("#cust_email_login").val());
				var cust_password 		= $.trim($("#cust_password_login").val());
				var cli_browser_info	= navigator.userAgent;
				var cli_ip_address		= "";
				$.getJSON("http://jsonip.com/?callback=?", function (data) 
				{
        			console.log(data);
        			cli_ip_address		= data.ip;
    			});			
				if(cust_email == "" || cust_password == "")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });
				}
				else
				{
					$('input[name="reg_submit_reg"]').attr('disabled', 'true');
					var sendInfo 	= {"cust_email":cust_email,"cust_password":cust_password,"cli_browser_info":cli_browser_info,"cli_ip_address":cli_ip_address,"user_login":1}
					var userlogin 	= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: userlogin,
						contentType: "application/json; charset=utf-8",						
						async:false,						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								var redirect_to = $("#redirect_to").val();
								
							
								if(redirect_to != "")
								{
									window.location.href = base_url+redirect_to;										
								}
								//  start : done by satish 12042017
								else if(data.redirect_url !="")
								{  	
								   window.location.href =base_url+data.redirect_url;
								}
								else
								{
									window.location.href = base_url+"page-profile";
								}//  end : done by satish 12042017
								return false;								
								/*$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');								
								loading_hide();
								$('button.close-popup').on('click', function() 
								{
									var redirect_to = $("#redirect_to").val();
									if(redirect_to != "")
									{
										window.location.href = base_url+redirect_to;										
									}
									else
									{
										window.location.href = base_url+"page-profile";																				
									}
									return false;
								});	*/
							} 
							else 
							{
								loading_hide();
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal({
										backdrop: 'static'
								  });
							}
						},
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						},
						complete: function()
						{							
           				}
		    		});
				}
			}
		});	
$('#forget_pass').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#forget_pass').valid())
			{
				loading_show();
				var cust_email			= $.trim($("#cust_email_fpass").val());
				if(cust_email == "")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">Please enter email id.</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });									
				}
				else
				{
					$('input[name="forget_pass_submit"]').attr('disabled', 'true');
					var sendInfo 	= {"cust_email":cust_email,"forget_pass_mail_send":1}
					var fpass 		= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: fpass,
						contentType: "application/json; charset=utf-8",						
						async:false,						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#forget_email_error").html(data.resp);
								$("#forget_email_error").show().fadeOut(5000);
								$('#cust_email_fpass').val('');
								loading_hide();
							} 
							else 
							{
								$("#forget_email_error").html(data.resp);	
								$("#forget_email_error").show().fadeOut(5000);															
								loading_hide();
							}
						  },
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						  	$('#error_model').modal({
										backdrop: 'static'
								  });
						},
						complete: function()
						{
						}
					});
				}
			}
		});
$.validator.setDefaults({
    		highlight: function(element) 
			{
    	    	$(element).closest('.form-group').addClass('has-error');
    		},
    		unhighlight: function(element) 
			{
    	    	$(element).closest('.form-group').removeClass('has-error');
    		},
    		errorElement: 'span',
    		errorClass: 'help-block',
    		errorPlacement: function(error, element) 
			{
    	    	if(element.parent('.input-group').length) 
				{
    	        	error.insertAfter(element.parent());
		        } 
				else 
				{
    	        	error.insertAfter(element);
				}
			}
		});		
function updateCoupon()
{
	loading_show();
	
	var user_coupon_code	= $("#coupon_code").val();	
	var cust_session 		= $("#cust_session").val();	
	
	//alert(user_coupon_code+'<==>'+cust_session);
	//return false;

	if(cust_session == "")
	{
		window.location.href	= "/page-profile";
	}
	else if(user_coupon_code == "")
	{
		$("#model_body").html('<span style="style="color:#F00;">Coupon Code empty.</span>');
		$('#error_model').modal({
										backdrop: 'static'
								  });
		loading_hide();
	}
	else
	{					
		var sendInfo 		= {"user_coupon_code":user_coupon_code,"cust_session":cust_session,"update_coupon":1,}
		var update_coupon 	= JSON.stringify(sendInfo);			
		$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: update_coupon,
			contentType: "application/json; charset=utf-8",						
			async:false,						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{	
				   		
				   	get_cart_detail();						
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
					$('#coupon_code1').css('pointer-events','none');
						$('#coupon_code1').css('opacity','0.5');
						$('#div_before_appied').css('display','none');
						$('#div_after_appied').css('display','block');
						 $("#coupon_code1").val(user_coupon_code);
					loading_hide();
					$('button.close-popup').on('click', function()
					{	
													
						//viewCart('cart_page');
						viewCart('content');
					});	
													
					//$("#cart_page").slideUp();
					//viewCart('cart_page');
					//$("#cart_page").slideDown();
				
				} 
				else 
				{		loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});	
	}				
}		
function getAddressData(address_data,page_type)
{	
	//alert(page_type);
	loading_show();
	  cust_session		= $("#cust_session").val();
	  if(cust_session == "")
	  {
		  window.location.href= "/";
	  }
	  else
	  {
		  var sendInfo 	= {"loadAddress":1,"page_type":page_type,"cust_session":cust_session}
		  var loadAddress = JSON.stringify(sendInfo);			
		  $.ajax({
			url: "includes/main.php",
			type: "POST",
			data: loadAddress,
			contentType: "application/json; charset=utf-8",						
			async:false,			
			success: function(response) 
			{
				data = JSON.parse(response);
				//alert(data.resp);
				if(data.Success == "Success") 
				{
					$("#"+address_data).slideDown();							
					$("#"+address_data).html(data.resp);
					loading_hide();
				} 
				else 
				{							
					$("#"+address_data).slideDown();							
					$("#"+address_data).html(data.resp);
					loading_hide();
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
			},
			complete: function()
			{
			}
		});
	}}
function placeOrder()
{
		loading_show();
		var cust_session		= $("#cust_session").val();		// Customer Email ID will be fetched
		var add_id 				= "";
		$('.my-address-box').each(function () 
		{
			if(!($("#"+this.id).hasClass('alt'))) 
			{
				add_id	= this.id;
			}
		});		
		var payment_mode 		= $("input[name=payment_mode]:checked").val();		// "Cash on Delivery" OR "Pay Online"
		var pay_online_mode		= '';
		if(payment_mode == 'Pay Online')
		{
			pay_online_mode		= $("input[name=pay_online_mode]:checked").val();	// Check for payment gateway options i.e. "PayU" OR "Instamojo"
		}
		else
		{
			pay_online_mode		= 0;	
		}
		var ord_comment 		= $.trim($("textarea#ord_comment").val());
		if(cust_session == "" || add_id == "")
		{			
			loading_hide();
			$("#model_body").html('<span style="style="color:#F00;">Please select Address.</span>');
			$('#error_model').modal({
										backdrop: 'static'
								  });
		}
		else if(payment_mode == "" )
		{
			loading_hide();
			$("#model_body").html('<span style="style="color:#F00;">Please Select palyment Mode</span>');
			$('#error_model').modal({
										backdrop: 'static'
								  });
		}
		else
		{
			var sendInfo 	= {"cust_session":cust_session,"add_id":add_id,"payment_mode":payment_mode,"pay_online_mode":pay_online_mode,"ord_comment":ord_comment,"placeOrder":1}
			var order_gen	= JSON.stringify(sendInfo);			
			$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: order_gen,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							loading_hide();	
							if(data.url=="payu")
							{
								$("#payment_info").html(data.paymentData);
								document.getElementById("payuPayment").submit();
							}
							else if(data.url=="instamojo")
							{
								window.location.href = ""+data.paymentData;									
							}
							else if(data.url=="paytm")
							{   
								$("#payment_info").html(data.paymentData);
								document.getElementById("frm_paytm").submit();
							}
							else
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal({
										backdrop: 'static'
								  });														
								loading_hide();
								$('button.close-popup').on('click', function() 
								{
									window.location.href = "/page-profile";
									return false;
								});								
							}	
						} 
						else if(data.Success == "fail")
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						}
						else if(data.Success == 'couponExpired')
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
							
							$('button.close-popup').on('click', function() 
							{
								location.reload();
								return false;
							});		
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
	           		}
			    });
		}}	
$('#add_form').on('submit', function(e) 
{
		e.preventDefault();
		if ($('#add_form').valid())
		{
			
			loading_show();
			var	cust_session		= $.trim($("#cust_session").val());
			var add_address_type 	= $.trim($("#add_address_type_new_address").val());
			var cust_address 		= $.trim($("#cust_address_new_address").val());
			var cust_country		= $.trim($("#cust_country_new_address").val());
			var cust_state 			= $.trim($("#cust_state_new_address").val());
			var cust_city 			= $.trim($("#cust_city_new_address").val());
			var cust_pincode 		= $.trim($("#cust_pincode_new_address").val());
			if(cust_address == "" || cust_country == "" || cust_state == "" || cust_city =="" || cust_pincode == "" || add_address_type == "")
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');							
				$('#error_model').modal({
										backdrop: 'static'
								  });									
			}
			else
			{
				$('input[name="reg_submit_new_address"]').attr('disabled', 'true');
				var sendInfo 		= {"cust_session":cust_session,"add_address_type":add_address_type,"cust_address":cust_address,"cust_country":cust_country,"cust_state":cust_state,"cust_city":cust_city,"cust_pincode":cust_pincode,"add_new_address":1}
				var user_reg 	= JSON.stringify(sendInfo);				
				$.ajax({
					url: "includes/main.php",
					type: "POST",
					data: user_reg,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{   
					     
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							var sPath = window.location.pathname;
							var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
							//alert(sPage);
							if(sPage == "page-profile")
							{
								//$("#add_form").removeClass('form-validate');
								
								
								$("#new-address-block").slideUp();
								$("#address_data").slideDown();
								$('input[name="check"]').prop('checked', false);
								$('#select-an-address').prop('checked', true);
								//getAddressData('address_data');	// Commented By Prathamesh on 24102016 [PageType is not defined]
								getAddressData('address_data',1);
								/*$( '#add_form' ).each(function(){
									this.reset();
								});*/
								 
							}
							else
							{
								//
								$("#new-address-block").slideUp();
								$("#select-address-block").slideDown();
								//getAddressData('select-address-main');
								getAddressData('select-address-main',0);
							}
						} 
						else 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });							
					},
					complete: function()
					{
    	       		}
			    });
			}
		}
	});		
function showOrders(order_id)
{
			loading_show();
			var cust_session		= $("#cust_session").val();
			if(cust_session == "")
			{
				location.href="/";
			}
			else
			{
				$('input[name="reg_submit_pass"]').attr('disabled', 'true');
				var sendInfo 		= {"cust_session":cust_session,"order_id":order_id,"show_orders":1}
				var users_orders 	= JSON.stringify(sendInfo);				
				$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: users_orders,
					async:false,					
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#order_data").html(data.resp);							
							loading_hide();
						} 
						else 
						{	
							$("#order_data").html(data.resp);
							loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
					}
				});				
			}
		}	
function getOrdersList()
{
			loading_show();
			var cust_session		= $("#cust_session").val();
			if(cust_session == "")
			{
				location.href="/";
			}
			else
			{
				var sendInfo 		= {"cust_session":cust_session,"get_orders":1}
				var users_orders 	= JSON.stringify(sendInfo);				
				$.ajax({
					url:"includes/main.php",
					type: "POST",
					data: users_orders,
					contentType: "application/json; charset=utf-8",						
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$("#order_list").html(data.resp);
							$("#users_orders").slideDown();							
							loading_hide();
						} 
						else 
						{	
						    $("#order_list").html(data.resp);
							$("#users_orders").slideDown();	
							loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					},
					complete: function()
					{
					}
				});				
			}			
		}
$('#change_pass').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#change_pass').valid())
			{
				loading_show();
				var cust_session		= $("#cust_session").val();
				var cust_password_old	= $.trim($("#cust_password_old_change_pass").val());
				var cust_password_new	= $.trim($("#cust_password_new_change_pass").val());
				if(cust_password_old == "" || cust_password_new == "" || cust_session == "")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });									
				}
				else
				{
					$('input[name="reg_submit_pass"]').attr('disabled', 'true');
					var sendInfo 	= {"cust_password_old":cust_password_old,"cust_password_new":cust_password_new,"cust_session":cust_session,"change_password":1}
					var cpass 	= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: cpass,
						contentType: "application/json; charset=utf-8",		
						async:false,
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal({
								backdrop: 'static'
								});							
								loading_hide();
								$('button.close-popup').on('click', function() 
								{
									location.reload();
						    		return false;
								});	
							} 
							else 
							{
								loading_hide();
								$("#cust_password_old_change_pass").val("");
$("#cust_password_old_error").html(" ");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal({
										backdrop: 'static'
								  });
							  }
						  },
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						  	$('#error_model').modal({
										backdrop: 'static'
								  });
						},
						complete: function()
						{
						}
					});
				}
			}
		});
$('#user_update_info').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#user_update_info').valid())
			{  
				loading_show();
				$.ajax({
					url:base_url+"includes/main.php",
					type: "POST",
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					async:true,
					success: function(response) 
					{   
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{ $('html, body').animate({scrollTop: 0}, 1500);	
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
							//$('#error_model').modal('toggle');								
							$('#error_model').modal({
								backdrop: 'static'
							});
							
							loading_hide();
							$('button.close-popup').on('click', function() 
							{
								//location.reload();
								//window.location.href=base_url+'page-profile';
location.reload();$('html, body').animate({scrollTop: 0}, 1500);	
					    		return false;
							});	
						} 
						else 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
						  }
					  },
					error: function (request, status, error) 
					{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						  	$('#error_model').modal({
										backdrop: 'static'
								  });
						},
					complete: function()
					{
					}
				});
			}
		});
/*$('#mobile_verify').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#mobile_verify').valid())
			{
				loading_show();
				var cust_session		= $("#cust_session").val();
				var cust_mobile_status	= $.trim($("#cust_mobile_status").val());
				if(cust_mobile_status == "" && cust_session == "")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">Please enter your OTP.</span>');							
					$('#error_model').modal('toggle');									
				}
				else
				{
					$('input[name="reg_submit_mob_verify"]').attr('disabled', 'true');
					var sendInfo 	= {"cust_session":cust_session,"cust_mobile_status":cust_mobile_status,"cust_mobile_verify":1}
					var mob_status 		= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: mob_status,
						contentType: "application/json; charset=utf-8",						
						async:false,						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');								
								loading_hide();
								$('button.close-popup').on('click', function() 
								{
									location.reload();
						    		return false;
								});								
							} 
							else 
							{
								loading_hide();
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							  	$('#error_model').modal('toggle');								
							}
						  },
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						  	$('#error_model').modal('toggle');
						},
						complete: function()
						{
						}
					});
				}
			}
		});*/
function addressSelect(address_id, city_id)
{
			var idArray = [];
			$('.my-address-box').each(function () 
			{
				if(this.id == address_id)
				{
					$("#"+address_id).removeClass("alt");
					$("#"+address_id).html('<i class="fa fa-check"></i>Delivery will be on this address');

var losd_setSession	= '1';
					
					var sendInfo	= {"losd_setSession":losd_setSession,"address_id":address_id, "city_id":city_id};
					var set_session	= JSON.stringify(sendInfo);
					
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: set_session,
						contentType: "application/json; charset=utf-8",						
						async:false,			
						success: function(response) 
						{  
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$('#div_cod').html(data.resp);
								loading_hide();
							} 
							else if(data.Success == "fail") 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal({
									backdrop: 'static'
								});
								loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							  loading_hide();
						},
						complete: function()
						{
							loading_hide();
						}
					});

				}
				else
				{
					if($("#"+this.id).hasClass('alt')) 
					{
					}
					else
					{
						$("#"+this.id).addClass("alt");
						$("#"+this.id).html('Deliver to this address');						
					}
				}
			});
		}
function orderSelect(order_id)
{
			var idArray = [];
			$('.order_btns').each(function () 
			{
				if(this.id == order_id)
				{
					$("#"+order_id).removeClass("alt");
				}
				else
				{
					if($("#"+this.id).hasClass('alt')) 
					{
					}
					else
					{
						$("#"+this.id).addClass("alt");
					}
				}
			});
		}
function changeQuantity(cart_id,flag)
{		
	loading_show();
	var cart_id = parseInt(cart_id);
	
	var sendInfo 	= {"cart_id":cart_id,"flag":flag,"update_prod_quentity":1}
	var cpass 	= JSON.stringify(sendInfo);				
	$.ajax({
		url: base_url+"includes/main.php",
		type: "POST",
		data: cpass,
		contentType: "application/json; charset=utf-8",						
		async:false,			
		success: function(response) 
		{  
			data = JSON.parse(response);
			if(data.Success == "Success") 
			{
				viewCart('content');
				loading_hide();
			} 
			else 
			{
				$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
				$('#error_model').modal({
					backdrop: 'static'
				});
				loading_hide();
				viewCart('content');
			}
		},
		error: function (request, status, error) 
		{
			  loading_hide();
			  viewCart('content');
		},
		complete: function()
		{
		}
	});			
}
$('#reset_password').on('submit', function(e) 
{			
			e.preventDefault();
			if ($('#reset_password').valid())
			{
				loading_show();
				var cust_session		= $("#cust_session_1").val();			
				var cust_password_new	= $.trim($("#cust_password_new_reset").val());
				
				
				if(cust_session == "")
				{
					$("#model_body").html('<span style="style="color:#F00;">Url expired...</span>');
					$('#error_model').modal({
					backdrop: 'static'
				});
					loading_hide();											
					window.location.href = "/"
				}
				else if(cust_password_new == "")
				{
					$("#model_body").html('<span style="style="color:#F00;">Please provide Password...</span>');
					$('#error_model').modal({
					backdrop: 'static'
				});
					loading_hide();
				}
				else
				{
					$('input[name="reg_submit_password_reset"]').attr('disabled', 'true');
					var sendInfo 	= {"cust_password_new":cust_password_new,"cust_session":cust_session,"reset_password":1}
					var cpass 	= JSON.stringify(sendInfo);				
					$.ajax({
						url: base_url+"includes/main.php",
						type: "POST",
						data: cpass,
						contentType: "application/json; charset=utf-8",		
						async:false,										
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								  $("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								  $('#error_model').modal({
					backdrop: 'static'
				});								
								  loading_hide();
								  $('button.close-popup').on('click', function() 
								  {
									  window.location.href="/page-profile";											
									  return false;
								  });
							} 
							else 
							{
								loading_hide();
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal({
					backdrop: 'static'
				});
							}
						},
						error: function (request, status, error) 
						{
							loading_hide();
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
							$('#error_model').modal({
					backdrop: 'static'
				});
						},
						complete: function()
						{							
						}
					});
				}
			}
		});								
/* Buy Now Function call*/
function buyNow(prod_id)
{
	//alert('Hi');
	loading_show();
	addToCart(prod_id); // product add to cart 
	cust_session = $.trim($("#cust_session").val());
	if(cust_session == "")
	{
		window.location.href=base_url+'page-cart.php';//add planeteducate in url by Tariq-22-09-2016		
	}
	else
	{
		window.location.href=base_url+'page-checkout.php';//add planeteducate in url by Tariq-22-09-2016		
	}
	loading_hide();
}
/* Buy Now Function call*/								
$('#user_contact').on('submit', function(e) 
{
		e.preventDefault();
		if ($('#user_contact').valid())
		{
			loading_show();
			var conct_name 			= $.trim($("#conct_name").val());
			var conct_email 		= $.trim($("#conct_email").val());
			var conct_mobile_num 	= $.trim($("#conct_mobile_num").val());		
			var conct_sub 			= "Planet Educate";
			var conct_msg 			= $.trim($('textarea#conct_msg').val());
			var conct_web_info		= navigator.userAgent;
			var conct_user_ip		= "";
			//IPINFO DOES NOT SUPPORT SSL FOR FREE
				//$.get("https://ipinfo.io", function(response) 
				//{
        		//	cli_ip_address		= response.ip ;
        			cli_ip_address		= "0.0.0.0";
				//}, "jsonp");			
			if(conct_name == "" || conct_email == "" || conct_mobile_num == "" || conct_sub == "" || conct_msg == "")
			{
				$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');							
				$('#error_model').modal({
										backdrop: 'static'
								  });
				loading_hide();			
			}
			else
			{
				$('input[name="reg_submit_contact"]').attr('disabled', 'true');
				var sendInfo 	= {"conct_name":conct_name,"conct_email":conct_email,"conct_sub":conct_sub,"conct_mobile_num":conct_mobile_num,"conct_msg":conct_msg,"conct_user_ip":conct_user_ip,"conct_web_info":conct_web_info,"user_contact_us":1}
				var user_contact= JSON.stringify(sendInfo);				
				$.ajax({
					url: base_url+"includes/main.php",
					type: "POST",
					data: user_contact,
					contentType: "application/json; charset=utf-8",	
					async:false,					
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
							$('button.close-popup').on('click', function() 
							{
								location.reload();
								return false;
							});
							loading_hide();
						} 
						else 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
							$('#error_model').modal({
										backdrop: 'static'
								  });
							loading_hide();						
						}
					},
					error: function (request, status, error) 
					{
	
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
						loading_hide();					
					},
					complete: function()
					{						
					}
				});
			}
		}
	});
$('#comment-form').on('submit', function(e) 
{			
	e.preventDefault();
	if ($('#comment-form').valid())
	{
		loading_show();
		var cust_session			= $.trim($("#cust_session").val());
		var rating					= $.trim($("#rating").val());
		var review_content			= $.trim($("textarea#review_content").val());
		var review_prod_id			= $.trim($("#review_prod_id").val());
		var review_title			= $.trim($("#review_title").val());
		//var review_cust_id			= $.trim($("#review_cust_id").val());
		if(cust_session == "")
		{
			loading_hide();
			$("#model_body").html('<span style="style="color:#F00;">Please Login.</span>');							
			$('#error_model').modal({
										backdrop: 'static'
								  });									
		}
		else
		{
			$('input[name="submit_review"]').attr('disabled', 'true');
			var sendInfo 	= {"cust_session":cust_session,"rating":rating,"review_content":review_content,"review_prod_id":review_prod_id,"review_title":review_title,"insert_user_review":1}
			var u_review 		= JSON.stringify(sendInfo);				
			$.ajax({
				url: "includes/main.php",
				type: "POST",
				data: u_review,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						location.reload();
						loading_hide();
					} 
					else 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
				  		$('#error_model').modal({
										backdrop: 'static'
								  });													
						loading_hide();
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				  	$('#error_model').modal({
										backdrop: 'static'
								  });
				},
				complete: function()
				{
				}
			});
		}
	}
});
function submitThreadReview(review_id)
{
	loading_show();
	var thread_reply			= $.trim($("#thread_reply"+review_id).val());
	var cust_session			= $.trim($("#cust_session").val());
	if(thread_reply == "")
	{
		loading_hide();
		$("#model_body").html('<span style="style="color:#F00;">Please Comment first </span>');							
		$('#error_model').modal({
										backdrop: 'static'
								  });								
	}
	else
	{
		var sendInfo 	= {"review_id":review_id,"thread_reply":thread_reply,"cust_session":cust_session,"insert_thread_review":1}
		var u_review 		= JSON.stringify(sendInfo);				
		$.ajax({
			url: "includes/main.php",
			type: "POST",
			data: u_review,
			contentType: "application/json; charset=utf-8",						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
					location.reload();
					loading_hide();
				} 
				else 
				{
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
			  		$('#error_model').modal({
										backdrop: 'static'
								  });											
					loading_hide();
				}
		  	},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
			  	$('#error_model').modal({
										backdrop: 'static'
								  });
			},
			complete: function()
			{
			}
		});
	}	
}
function getSuggestion(search_text)
{
	if($.trim(search_text) == "")
	{
		$("#search_suggestion").html("");
		$("#search_suggestion").slideUp();		
	}
	else
	{
		var sendInfo 	= {"search_text":search_text,"search_on_front":1}
		var search_data	= JSON.stringify(sendInfo);				
		$.ajax({
				url: "includes/main.php",
				type: "POST",
				data: search_data,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						$("#search_suggestion").html(data.resp);
						$("#search_suggestion").slideDown();						
					} 
					else 
					{
						$("#search_suggestion").html("");
						$("#search_suggestion").slideUp();
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				  	$('#error_model').modal({
										backdrop: 'static'
								  });
				},
				complete: function()
				{
					
				}
			});			
	}
}
function clearSearch()
{
	$("#search_suggestion").html("");
	$("#search_suggestion").slideUp();	
}		

// ================================================================================================================
// START : Mobile Verification Code [DN by Prathamesh ON 06-10-2016]
// ================================================================================================================
$('#user_mobile_verification').on('submit', function(e) 
{
	e.preventDefault();
	if ($('#user_mobile_verification').valid())
	{
		loading_show();
		var cust_mobile_verify 		= $.trim($("#cust_mobile_verify").val());
		var hid_cust_mobile_num		= $('#hid_cust_mobile_num').val();
		var hid_cust_email			= $('#hid_cust_email').val();
		var hid_cust_mobile_status	= $('#hid_cust_mobile_status').val();	
		
		var cli_browser_info	= navigator.userAgent;
		var cli_ip_address		= "";
		//IPINFO DOES NOT SUPPORT SSL FOR FREE
		//$.get("https://ipinfo.io", function(response) 
		//{
		//	cli_ip_address		= response.ip ;
			cli_ip_address		= "0.0.0.0";
		//}, "jsonp");
		if(cust_mobile_verify == "")
		{		
			$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');									
			//$('#error_model').modal('toggle');
			$('#error_model').modal({
				backdrop: 'static'
			});
			loading_hide();			
		}
		else
		{
			$('input[name="reg_submit_reg"]').attr('disabled', 'true');
			var sendInfo 		= {"cust_mobile_verify":cust_mobile_verify, "hid_cust_mobile_num":hid_cust_mobile_num, "hid_cust_email":hid_cust_email, "hid_cust_mobile_status":hid_cust_mobile_status,"user_verify_mobile":1}
			var user_reg 	= JSON.stringify(sendInfo);				
			$.ajax({
				url: base_url+"includes/main.php",
				type: "POST",
				data: user_reg,
				async:false,						
				contentType: "application/json; charset=utf-8",				
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
						//$('#error_model').modal('toggle'); 	
						$('#error_model').modal({
							backdrop: 'static'
						});
						
						loading_hide();
						$('button.close-popup').on('click', function() 
						{
							var redirect_to = $("#redirect_to").val();
							
							if(typeof redirect_to == 'undefined')
							{
								redirect_to	= '';	
							}
							
							if(redirect_to != "")
							{
								window.location.href = base_url+redirect_to;
							}
							else
							{
								window.location.href = base_url+"page-profile";
							}
						});	
					} 
					else if(data.Success == "fail")
					{	
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
						//$('#error_model').modal('toggle');
						$('#error_model').modal({
							backdrop: 'static'
						});
						$('button.close-popup').on('click', function() 
						{
							$('#cust_mobile_verify').val('');	
						});
						
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				},
				complete: function()
				{
				}
			});
		}
	}
});
// ================================================================================================================
// END : Mobile Verification Code [DN by Prathamesh ON 06-10-2016]
// ================================================================================================================

// ================================================================================================================
// START : Send Verification Code for mobile and link for the email [DN by Prathamesh on 12-10-2016]
// ================================================================================================================
function sendVerificationCode_m(userEmail, verifyType)
{
	//alert(userEmail+'<==>'+verifyType);
	//return false;
	var sendVerificationCode	= '1';
	
	var sendInfo	= {"userEmail":userEmail, "verifyType":verifyType, "sendVerificationCode":sendVerificationCode};
	var send_code	= JSON.stringify(sendInfo);
	
	$.ajax({
			url: "includes/main.php",
			type: "POST",
			data: send_code,
			async:false,						
			contentType: "application/json; charset=utf-8",						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
					$('#error_model').modal({
						backdrop: 'static'
					});	
												
				} 
				else if(data.Success == "fail")
				{	
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
				else if(data.Success == "Mobile")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
					window.location.href = base_url+"user-mobile-verify";	
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});
}
// ================================================================================================================
// END : Send Verification Code for mobile and link for the email [DN by Prathamesh on 12-10-2016]
// ================================================================================================================

// ================================================================================================================
// START : Delete Address from table [DN by Prathamesh on 24-10-2016]
// ================================================================================================================
function removeAddress(addressID, custSession)
{
	//alert(addressID+'<==>'+custSession);
	//return false;
	loading_show();
	var deleteAddress		= '1';
	var sendInfo			= {"addressID":addressID, "custSession":custSession, "deleteAddress":deleteAddress};
	var loadDeleteAddress	= JSON.stringify(sendInfo);
	
	$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: loadDeleteAddress,
			async:false,						
			contentType: "application/json; charset=utf-8",						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
					var sPath = window.location.pathname;
					var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
					//alert(sPage);
					if(sPage == "page-profile")
					{
						$("#new-address-block").slideUp();
						$("#address_data").slideDown();
						getAddressData('address_data',1);															
					}
					else
					{
						$("#new-address-block").slideUp();
						$("#select-address-block").slideDown();
						getAddressData('select-address-main',0);															
					}						
				} 
				else if(data.Success == "fail")
				{	
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
				else if(data.Success == "Mobile")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
					window.location.href = base_url+"user-mobile-verify";	
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});
}
// ================================================================================================================
// END : Delete Address from table [DN by Prathamesh on 24-10-2016]
// ================================================================================================================

// ================================================================================================================
// START : Edit Address from table [DN by Prathamesh on 25-10-2016]
// ================================================================================================================
function editAddress(addrsID, custSession)
{
	//alert(addrsID+'<==>'+custSession);
	loading_show();
	var editAddress			= '1';
	var sendInfo			= {"addrsID":addrsID, "custSession":custSession, "editAddress":editAddress};
	var loadEditAddress		= JSON.stringify(sendInfo);
	
	$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: loadEditAddress,
			async:false,						
			contentType: "application/json; charset=utf-8",						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
					$('#edit-address-block').slideDown();
					$('#select-address-block').slideUp();
					$('#address_data').slideUp();
					$('#div_edit_addrs_frm').html(data.resp);					
					$('#cust_country_edit_address').select2();
					$('#cust_state_edit_address').select2();
					$('#cust_city_edit_address').select2();
					loading_hide();
				} 
				else if(data.Success == "fail")
				{	
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
				else if(data.Success == "Mobile")
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
					window.location.href = base_url+"user-mobile-verify";	
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});
}

$('#edit_form').on('submit', function(e) 
{
	e.preventDefault();
	if ($('#edit_form').valid())
	{
		loading_show();
		var	cust_session		= $.trim($("#cust_session").val());
		var add_address_type 	= $.trim($("#edit_address_type_edit_address").val());
		var cust_address 		= $.trim($("#cust_address_edit_address").val());
		var cust_country		= $.trim($("#cust_country_edit_address").val());
		var cust_state 			= $.trim($("#cust_state_edit_address").val());
		var cust_city 			= $.trim($("#cust_city_edit_address").val());
		var cust_pincode 		= $.trim($("#cust_pincode_edit_address").val());
		var hid_edit_addrs		= $.trim($('#hid_edit_addrs').val());
		//alert(cust_session+'<==>'+add_address_type+'<==>'+cust_address+'<==>'+cust_country+'<==>'+cust_state+'<==>'+cust_city+'<==>'+cust_pincode);
		//return false;
		
		if(hid_edit_addrs == "" || cust_address == "" || cust_country == "" || cust_state == "" || cust_city =="" || cust_pincode == "" || add_address_type == "")
		{
			loading_hide();
			$("#model_body").html('<span style="style="color:#F00;">Please fill all data.</span>');							
			$('#error_model').modal({
										backdrop: 'static'
								  });								
		}
		else
		{
			$('input[name="reg_submit_new_address"]').attr('disabled', 'true');
			var sendInfo 	= {"hid_edit_addrs":hid_edit_addrs,"cust_session":cust_session,"add_address_type":add_address_type,"cust_address":cust_address,"cust_country":cust_country,"cust_state":cust_state,"cust_city":cust_city,"cust_pincode":cust_pincode,"edit_new_address":1}
			var user_reg 	= JSON.stringify(sendInfo);				
			$.ajax({
				url: "includes/main.php",
				type: "POST",
				data: user_reg,
				contentType: "application/json; charset=utf-8",						
				async:false,					
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						var sPath = window.location.pathname;
						var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
						//alert(sPage);
						if(sPage == "page-profile")
						{
							$("#edit-address-block").slideUp();
							$("#address_data").slideDown();
							//getAddressData('address_data');	// Commented By Prathamesh on 24102016 [PageType is not defined]
							getAddressData('address_data',1);
						}
						else
						{
							$("#edit-address-block").slideUp();
							$("#select-address-block").slideDown();
							//getAddressData('select-address-main');
							getAddressData('select-address-main',0);
						}
					} 
					else 
					{
						loading_hide();
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
						$('#error_model').modal({
										backdrop: 'static'
								  });
					}
				},
				error: function (request, status, error) 
				{
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
					$('#error_model').modal({
										backdrop: 'static'
								  });							
				},
				complete: function()
				{
				}
			});
		}
	}
});	
// ================================================================================================================
// EDIT : Edit Address from table [DN by Prathamesh on 25-10-2016]
// ================================================================================================================
// ================================================================================================================
// START : Remove Avatar [DN by satish on 21-12-2016]
// ================================================================================================================
function remove_avatar(cust_id)
{
	
	loading_show();
	
	var sendInfo			= {"cust_id":cust_id, "remove_avatar":1};
	var loadEditAddress		= JSON.stringify(sendInfo);
	
	$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: loadEditAddress,
			async:false,						
			contentType: "application/json; charset=utf-8",						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{
				location.reload();
				return false;
				
				} 
				else if(data.Success == "fail")
				{	
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
			
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});
}
// ================================================================================================================
// END: Remove Avatar [DN by satish on 21-12-2016]
// ================================================================================================================

//////////////////////-------------added by satish 18-01-2017----------------///////////////
function removeCoupon()
{  
       
	loading_show();
	
	var user_coupon_code	= $("#coupon_code1").val();	
	var cust_session 		= $("#cust_session").val();	
	
	//alert(user_coupon_code+'<==>'+cust_session);
	//return false;

	if(cust_session == "")
	{
		window.location.href	= "/page-profile";
	}
	else if(user_coupon_code == "")
	{
		$("#model_body").html('<span style="style="color:#F00;">Coupon Code empty.</span>');
		$('#error_model').modal('toggle');
		loading_hide();
	}
	else
	{					
		var sendInfo 		= {"user_coupon_code":user_coupon_code,"cust_session":cust_session,"remove_coupon":1,}
		var update_coupon 	= JSON.stringify(sendInfo);			
		$.ajax({
			url: base_url+"includes/main.php",
			type: "POST",
			data: update_coupon,
			contentType: "application/json; charset=utf-8",						
			async:false,						
			success: function(response) 
			{
				data = JSON.parse(response);
				if(data.Success == "Success") 
				{	
				   	get_cart_detail();						
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
					$('#div_before_appied').css('display','block');
					$('#div_after_appied').css('display','none');
					$("#coupon_code").val("");	
					loading_hide();
					$('button.close-popup').on('click', function()
					{	
												
						//viewCart('cart_page');
						viewCart('content');
											});	
													
					//$("#cart_page").slideUp();
					//viewCart('cart_page');
					//$("#cart_page").slideDown();
				} 
				else 
				{						
					loading_hide();
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
					//$('#error_model').modal('toggle');
					$('#error_model').modal({
						backdrop: 'static'
					});
				}
			},
			error: function (request, status, error) 
			{
				loading_hide();
				$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
				//$('#error_model').modal('toggle');
				$('#error_model').modal({
					backdrop: 'static'
				});
			},
			complete: function()
			{
			}
		});	
	}				
}
////////////////////---------------------added by satish ---------------------------------////////////////	

