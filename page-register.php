<?php
	include("includes/db_con.php");
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="robots" content="all">

	    <title>Register - Indian Dava Bazar</title>

		<?php include('st-head.php'); ?>
        <?php include('st-validator-css.php'); ?>
        <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" title="selectbox">
	</head>

	<body>
		<div class="wrapper">
		<?php  include('st-header.php'); ?>
        <?php  include('st-breadcrumb.php'); ?>
        	<!-- ========================================= MAIN ========================================= -->
            <main id="authentication" class="inner-bottom-md">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3">
                           &nbsp;
                        </div>

                        <div class="col-md-6">
                            <section class="section register">
                                <h2 class="bordered">Create New Account</h2>
                                <form role="form" class="register-form cf-style-1 form-horizontal form-bordered form-validate" id="frm_register" name="frm_register">
                                    <input type="hidden" id="txt_user_type" name="txt_user_type" value="">
                                    <div class="field-row control-group controls">
                                        <label class="col-md-3  col-xs-12">Usergroup<span style="color:#F00">*</span></label>
                                        <select class="col-md-9 col-xs-12 selectpicker" name="txt_usergrp" data-rule-required="true">
                                        	<option value="">Select Usergroup</option>
                                            <option value="doctors">Doctors</option>
                                            <option value="hospitals">Hospitals</option>
                                            <option value="chemist">Chemist/Retailers</option>
                                            <option value="trader">Trader</option>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div><!-- User Group -->
                                    
                                    <div class="field-row  control-group controls">
                                    	
                                        <label class="col-md-3  col-xs-12" for="name">Contact Person<span style="color:#F00">*</span></label>
                                        <input type="text" class="le-input col-md-9  col-xs-12" id="txt_name" name="txt_name" placeholder="Ex. Jhon Deo" data-rule-required="true">
                                        <div class="clearfix"></div>
                                    </div><!-- Contact Persone -->
                                    
                                    <div class="field-row  control-group controls">
                                        <label class="col-md-3  col-xs-12">Email<span style="color:#F00">*</span></label>
                                        <input type="text" class="le-input col-md-9  col-xs-12" id="txt_email" name="txt_email" placeholder="Ex. email@something.com" data-rule-required="true" data-rule-email="true">
                                    	<div class="clearfix"></div>
                                    </div><!-- Email -->
									
                                    <div class="field-row  control-group controls">
                                        <label class="col-md-3 col-xs-12">Mobile<span style="color:#F00">*</span></label>
                                        <input type="text" class="le-input col-md-9 col-xs-12" id="txt_mobile" name="txt_mobile" placeholder="Ex. 1234567890" data-rule-required="true" data-rule-number="true" maxlength="10" size="10" >
                                    	<div class="clearfix"></div>
                                    </div><!-- Mobile -->
                                    
                                    <div class="field-row control-group controls">
                                        <label class="col-md-3  col-xs-12">Password<span style="color:#F00">*</span></label>
                                        <input type="password" class="le-input col-md-9  col-xs-12" id="txt_password" name="txt_password" placeholder="Password" data-rule-required="true" minlength="6" maxlength="15" title="Password length should be minimum 8.It contain special character,upper case and lower case letters and numbers." onkeyup="checkStrength(this.id,'cust_password_error_register');">
                                        <span id="cust_password_error_register"></span>
                                    	<div class="clearfix"></div>
                                    </div><!-- Password -->
                                    
                                    <div class="field-row control-group controls">
                                        <label class="col-md-3 col-xs-12" >Confirm Password<span style="color:#F00">*</span></label>
                                        <input type="password" class="le-input col-md-9  col-xs-12" id="txt_cpassword" name="txt_cpassword" placeholder="Confirm Password" data-rule-required="true" data-rule-equalto="#txt_password">
                                    	<div class="clearfix"></div>
                                    </div><!-- Confirm Password -->
                                    
                                     <div class="field-row clearfix">
                                        <span class="pull-left">
                                            <label class="content-color">
                                             <input id="policy"  type="checkbox" class="le-checbox auto-width inline" data-rule-required="true"> 
                                                <span class="bold">Accept Policy</span>
                                            </label>
                                        </span>
                                       
                                    </div>
                                    
                                    <div class="buttons-holder">
                                        <button type="submit" id="btn_submit" name="btn_submit" class="le-button huge" value="frm-submit" >Sign Up</button>
                                    </div><!-- Submit -->
                                </form>

                                <h2 class="semi-bold">Sign up today and you'll be able to :</h2>

                                <ul class="list-unstyled list-benefits">
                                    <li><i class="fa fa-check primary-color"></i> Speed your way through the checkout</li>
                                    <li><i class="fa fa-check primary-color"></i> Track your orders easily</li>
                                    <li><i class="fa fa-check primary-color"></i> Keep a record of all your purchases</li>
                                </ul>

                            </section><!-- /.register -->
						</div>
                        
                        <div class="col-md-3">
                           &nbsp;
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main><!-- /.authentication -->
            
            <div class="modal fade policy" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Policy</h4>
                  </div>
                  <div class="modal-body">
                    <p>
        In general, an item may be eligible for return within the applicable return window if it fulfils one or more of the following conditions:
        Was delivered in a physically damaged condition </p><p>
        Has missing parts or accessories
       </p><p> Is different from what was ordered
       </p><p> Is no longer needed (not all items may be eligible)
    Products marked as "non-returnable" on the product detail page cannot be returned. View the full list of non-returnable items.
    </p><p>All items must be returned in their original condition, with price tags intact, user manual, warranty cards, original accessories and in the original manufacturer’s box/packaging as delivered to you.
  </p><p>  Only Fulfilled by Amazon (FBA) items may be eligible for replacement. For more details, please refer About Free Replacements.
   </p><p> If you wish to return an electronic device that stores any personal information, please ensure that you have removed all such personal information from the device prior to returning. Amazon shall not be liable in any manner for any misuse or usage of such information."
  </p><p>  Some items may not be eligible for return if you "no longer need it" (including cases of buyer's remorse such as incorrect model or color of product ordered or incorrect product ordered).
</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- ========================================= MAIN : END ========================================= -->
		<?php include('st-footer.php'); ?>
       	</div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
        <?php include('st-validator-js.php'); ?>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript">
			var baseurll = '<?php echo $BaseFolder; ?>';
			
			$(document).ready(function() 
			{ 	
				$("select[name = txt_usergrp]").change(function()
				{
					var selected = $("option:selected", this).text().trim();
					
					if(selected == "Doctors")
					{
						$("label[for = name]").html('Doctor\'s Name<span style="color:#F00">*</span>');
						$('#txt_user_type').val('buyer');
					}
					else if(selected == "Hospitals")
					{
						$("label[for = name]").html('Hospital\'s Name<span style="color:#F00">*</span>');
						$('#txt_user_type').val('buyer');  
					} 
					else if(selected == "Chemist/Retailers")
					{
						$("label[for = name]").html('Chemist\'s Name<span style="color:#F00">*</span>'); 
						$('#txt_user_type').val('buyer');
					}
					else if(selected == "Trader")
					{
						$("label[for = name]").html('Trader\'s Name<span style="color:#F00">*</span>');	
						$('#txt_user_type').val('vendor');
					}
	
				});
			})
			
			$('#frm_register').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_register').valid())
				{
					$.ajax({
						url: "includes/common.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,						
							success: function(response) 
							{   data = JSON.parse(response);
								if(data.Success == "Success") 
								{  
									//alert(baseurll);
									//location.reload();
									location.href	= baseurll + "/success";
								} 
								else 
								{   
									alert(data.resp);
									return false;
							        //location.href	= baseurll + "/error-404";
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
								//alert("complete");
								loading_hide();
							}
						});
				}
			});
			
			function checkStrength(password_field,password_error_span)
			{
				var password = $("#"+password_field).val();
				var strength = 0
				if (password.length < 6) 
				{
					$('#'+password_error_span).html(" ");
					return false; 
				}
				
				if (password.length = 0) 
				{ 
					$('#'+password_error_span).removeClass()
					$('#'+password_error_span).addClass('short')
					$('#'+password_error_span).html('');
				}		
				if (password.length < 6) 
				{ 
					$('#'+password_error_span).removeClass()
					$('#'+password_error_span).addClass('short')
					$('#'+password_error_span).html('Too short');
				}		
				if (password.length > 5) strength += 1		
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
			
			$(document).on('change', '#policy', function() {
				
				if($("#policy").attr("checked")) 
				{
					$('.policy').modal({
										backdrop: 'static'
								  });
				}
			});
		</script>
    </body>
</html>