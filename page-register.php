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
                                <form role="form" class="register-form cf-style-1" id="frm_register" name="frm_register">
                                    <input type="hidden" id="txt_user_type" name="txt_user_type" value="">
                                    <div class="field-row">
                                        <label class="col-md-3  col-xs-12">Usergroup</label>
                                        <select class="col-md-9 col-xs-12 selectpicker" name="txt_usergrp">
                                        	<option value="">Select Usergroup</option>
                                            <option value="doctors">Doctors</option>
                                            <option value="hospitals">Hospitals</option>
                                            <option value="wholesalers">Chemist/Retailers</option>
                                            <option value="trader">Trader</option>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div><!-- User Group -->
                                    
                                    <div class="field-row">
                                    	
                                        <label class="col-md-3  col-xs-12" for="name">Contact Person</label>
                                        <input type="text" class="le-input col-md-9  col-xs-12" id="txt_name" name="txt_name">
                                        <div class="clearfix"></div>
                                    </div><!-- Contact Persone -->
                                    
                                    <div class="field-row">
                                        <label class="col-md-3  col-xs-12">Email</label>
                                        <input type="text" class="le-input col-md-9  col-xs-12" id="txt_email" name="txt_email">
                                    	<div class="clearfix"></div>
                                    </div><!-- Email -->
									
                                    <div class="field-row">
                                        <label class="col-md-3 col-xs-12">Mobile</label>
                                        <input type="text" class="le-input col-md-9 col-xs-12" id="txt_mobile" name="txt_mobile">
                                    	<div class="clearfix"></div>
                                    </div><!-- Mobile -->
                                    
                                    <div class="field-row">
                                        <label class="col-md-3  col-xs-12">Password</label>
                                        <input type="password" class="le-input col-md-9  col-xs-12" id="txt_password" name="txt_password">
                                    	<div class="clearfix"></div>
                                    </div><!-- Password -->
                                    
                                    <div class="field-row">
                                        <label class="col-md-3 col-xs-12" >Confirm Password</label>
                                        <input type="password" class="le-input col-md-9  col-xs-12" id="txt_cpassword" name="txt_cpassword">
                                    	<div class="clearfix"></div>
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
                        
                        <div class="col-md-3">
                           &nbsp;
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main><!-- /.authentication -->
            <!-- ========================================= MAIN : END ========================================= -->

       	<?php include('st-footer.php'); ?>
       	</div><!-- /.wrapper -->

		<?php include('st-javascript.php'); ?>
        
        <script src="assets/js/bootstrap-select.min.js"></script>
        
        <script type="text/javascript">
		$(document).ready(function() 
		{ 	
			var baseurll = '<?php echo $BaseFolder; ?>';
			
		
			
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
							  	location.href	= baseurll + "/success";
							} 
							else 
							{   
							   	alert(data.resp);
							   	location.href	= baseurll + "/error-404";
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

