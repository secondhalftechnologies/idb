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
	</head>

	<body>
		<div class="wrapper">
		<?php  include('st-header.php'); ?>
        
        <?php  include('st-breadcrumb.php'); ?>
        
            <!-- ========================================= MAIN ========================================= -->
            <main id="authentication" class="inner-bottom-md">
                <div class="container">
                    <div class="row">

                        <div class="col-md-2">
                           &nbsp;
                        </div>

                        <div class="col-md-8">
                            <section class="section register">
                                <h2 class="bordered">Create New Account</h2>
                                <form role="form" class="register-form cf-style-1" id="frm_register" name="frm_register">
                                    <input type="hidden" id="txt_user_type" name="txt_user_type" value="">
                                    <div class="field-row">
                                        <label>Usergroup</label>
                                        <select class="le-input" name="txt_usergrp">
                                        	<option value="">Select Usergroup</option>
                                            <option value="doctors">Doctors</option>
                                            <option value="hospitals">Hospitals</option>
                                            <option value="wholesalers">Chemist/Retailers</option>
                                            <option value="trader">Trader</option>
                                        </select>
                                    </div><!-- User Group -->
                                    
                                    <!-- ===================================================================================== -->
                                    <!-- START : Comment this part according to the requirments [dn by Prathamesh on 28082017] -->
                                    <!-- ===================================================================================== -->
                                    
                                    <!--<div class="field-row">
                                         <div class="payment-method-option">
                                        <input class="le-radio" name="txt_user_type" value="buyer" type="radio"><i class="fake-box"></i>
                                        <div class="radio-label bold ">Buyer</div>
                                        
                                         &nbsp;&nbsp;<input class="le-radio" name="txt_user_type" value="vendor" type="radio"><i class="fake-box"></i>
                                        <div class="radio-label bold ">Vendor</div>
                                        </div>
                                    </div>-->
                                    
                                    <!-- ===================================================================================== -->
                                    <!-- END : Comment this part according to the requirments [dn by Prathamesh on 28082017] -->
                                    <!-- ===================================================================================== -->
                                    
                                    <div class="field-row">
                                        <label for="name">Contact Persone</label>
                                        <input type="text" class="le-input" id="txt_name" name="txt_name">
                                    </div><!-- Contact Persone -->
                                    
                                    <div class="field-row">
                                        <label>Email</label>
                                        <input type="text" class="le-input" id="txt_email" name="txt_email">
                                    </div><!-- Email -->
									
                                    <div class="field-row">
                                        <label>Mobile</label>
                                        <input type="text" class="le-input" id="txt_mobile" name="txt_mobile">
                                    </div><!-- Mobile -->
                                    
                                    <div class="field-row">
                                        <label>Password</label>
                                        <input type="password" class="le-input" id="txt_password" name="txt_password">
                                    </div><!-- Password -->
                                    
                                    <div class="field-row">
                                        <label>Confirm Password</label>
                                        <input type="password" class="le-input" id="txt_cpassword" name="txt_cpassword">
                                    </div><!-- Confirm Password -->
                                    
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
                        
                        <div class="col-md-2">
                           &nbsp;
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main><!-- /.authentication -->
            <!-- ========================================= MAIN : END ========================================= -->

       	<?php include('st-footer.php'); ?>
       	</div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
        
        <script type="text/javascript">
		$(document).ready(function() 
		{ 	
		
			$("select[name = txt_usergrp]").change(function()
			{
				var selected = $("option:selected", this).text().trim();
				
				if(selected == "Doctors")
				{
					$("label[for = name]").text("Doctor's Name");
					$('#txt_user_type').val('buyer');
				}
				else if(selected == "Hospitals")
				{
					$("label[for = name]").text("Hospital's Name");
					$('#txt_user_type').val('buyer');  
				} 
				else if(selected == "Chemist/Retailers")
				{
					$("label[for = name]").text("Wholesaler's Name"); 
					$('#txt_user_type').val('buyer');
				}
				else if(selected == "Trader")
				{
					$("label[for = name]").text("Trader's Name");	
					$('#txt_user_type').val('vendor');
				}

		  	});
		})
		
		
		$('#frm_register').on('submit', function(e) 
        {
        	e.preventDefault();
			/*if ($('#frm_register').valid())
			{*/
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
					        alert(data.Success);
							if(data.Success == "Success") 
							{  
							  	alert(data.resp);
							  	//location.reload();
							  	location.href	= "http://localhost/idb/success";
							} 
							else 
							{   
							   	alert(data.resp);
							   	location.href	= "http://localhost/idb/error-404";
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
			/*}*/
		});
		

		</script>

    </body>

</html>

