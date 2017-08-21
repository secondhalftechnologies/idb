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
                                    <div class="field-row">
                                        <label>Usergroup</label>
                                        <select class="le-input" name="txt_usergrp">
                                        	<option value="">Select Usergroup</option>
                                            <option value="doctors">Doctors</option>
                                            <option value="hospitals">Hospitals</option>
                                            <option value="wholesalers">Wholesalers/Retailers</option>
                                            
                                        </select>
                                        
                                    </div><!-- /.field-row -->
                                    
                                    <div class="field-row">
                                        <label for="name">Name</label>
                                        <input type="text" class="le-input" id="txt_name" name="txt_name">
                                    </div><!-- /.field-row -->
                                    
                                    <div class="field-row">
                                        <label>Email</label>
                                        <input type="text" class="le-input" id="txt_email" name="txt_email">
                                    </div><!-- /.field-row -->
									
                                    <div class="field-row">
                                        <label>Mobile</label>
                                        <input type="text" class="le-input" id="txt_mobile" name="txt_mobile">
                                    </div><!-- /.field-row -->
                                    
                                    <div class="field-row">
                                        <label>Password</label>
                                        <input type="text" class="le-input" id="txt_password" name="txt_password">
                                    </div><!-- /.field-row -->
                                    
                                    <div class="field-row">
                                        <label>Confirm Password</label>
                                        <input type="text" class="le-input" id="txt_password" name="txt_password">
                                    </div><!-- /.field-row -->
                                    
                                    <div class="field-row">
                                        <label>License number</label>
                                        <input type="text" class="le-input" id="txt_license_num" name="txt_license_num">
                                    </div><!-- /.field-row -->
                                    
                                    <div class="buttons-holder">
                                        <button type="submit" id="btn_submit" name="btn_submit" class="le-button huge" >Sign Up</button>
                                    </div><!-- /.buttons-holder -->
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
				}
				else if(selected == "Hospitals")
				{
					$("label[for = name]").text("Hospital's Name");  
				} 
				else if(selected == "Wholesalers/Retailers")
				{
					$("label[for = name]").text("Wholesaler's Name");  
				} 

		  	});
		})
		</script>

    </body>

</html>

