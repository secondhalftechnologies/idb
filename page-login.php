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

	    <title>Login - Indian Dava Bazar</title>

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
                            <section class="section sign-in inner-right-xs">
                                <h2 class="bordered">Sign In</h2>
                                <p>Hello, Welcome to your account</p>

                                <!--<div class="social-auth-buttons">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-facebook"></i> Sign In with Facebook</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button>
                                        </div>
                                    </div>
                                </div>-->

                                <form role="form" class="login-form cf-style-1" id="frm_login" name="frm_login">
                                    <div class="field-row">
                                        <label>Email</label>
                                        <input type="email" name="txt_email" id="txt_email" class="le-input" required>
                                    </div><!-- /.field-row -->

                                    <div class="field-row">
                                    <label>Password</label>
                                    <input type="password" name="txt_password" id="txt_password" class="le-input"required>
                                    </div><!-- /.field-row -->

                                    <div class="field-row clearfix">
                                        <span class="pull-left">
                                            <label class="content-color"><input type="checkbox" class="le-checbox auto-width inline"> <span class="bold">Remember me</span></label>
                                        </span>
                                        <span class="pull-right">
                                            <a href="#" class="content-color bold">Forgotten Password ?</a>
                                        </span>
                                    </div>

                                    <div class="buttons-holder">
                                        <button type="submit" class="le-button huge">Secure Sign In</button>
                                    </div><!-- /.buttons-holder -->
                                </form><!-- /.cf-style-1 -->

                            </section><!-- /.sign-in -->
                        </div><!-- /.col -->
                        
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
		<!-- For demo purposes – can be removed on production : End -->
		<script type="text/javascript">
        	$('#frm_login').on('submit', function(e) {
			e.preventDefault();
			var txt_email		= $('#txt_email').val();
			var txt_password	= $('#txt_password').val();
			var cli_browser_info	= navigator.userAgent;
			var cli_ip_address		= "";
			$.getJSON("http://jsonip.com/?callback=?", function (data) 
			{
				console.log(data);
				cli_ip_address		= data.ip;
			});	
			
			
			var sendInfo 	= {"cli_browser_info":cli_browser_info,"cli_ip_address":cli_ip_address,"txt_email":txt_email, "txt_password":txt_password, "login_customer":1};
			
			var esn_edit	= JSON.stringify(sendInfo);				
			$.ajax({
				url: "includes/common.php",
				type: "POST",
				data: esn_edit,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					
					data = JSON.parse(response);
					alert(data);
					if(data.Success == "Success") 
					{
						 window.location.href="index.php?";
						return false;
					} 
					else 
					{
						alert(data.resp);
					}
				},
				error: function (request, status, error) 
				{
					alert(request.responseText);
				},
				complete: function()
				{
					//loading_hide();	
				}
			});
				
			
		});
        </script>
    </body>
</html>
