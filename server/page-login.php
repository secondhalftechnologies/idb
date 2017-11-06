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
        <?php include('st-validator-css.php'); ?>
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
                                
                                <!--To Validate the form, 
                                		---add 2 files (st-validator-css.php,st-validator-js.php)
                                        ---In form element, Add class(form-horizontal form-bordered form-validate)
                                        ---In input div element, Add class(control-group controls) 
                                        ---In input element, data-rule-validation
                                -->

                                <form role="form" class="login-form cf-style-1 form-horizontal form-bordered form-validate" id="frm_login" name="frm_login" >
                                    <div class="field-row control-group controls">
                                        <label>Email</label>
                                        <input autocomplete="off" type="email" name="txt_email" id="txt_email" class=" le-input col-md-12 col-xs-12"  data-rule-required="true">
                                    </div><!-- /.field-row -->

                                    <div class="field-row control-group controls">
                                        <label>Password</label>
                                        <input type="password" name="txt_password" id="txt_password" class="le-input col-md-12 col-xs-12" data-rule-required="true">
                                    </div><!-- /.field-row -->

                                    <div class="field-row control-group controls">
                                        <label> <?php $a =rand(1,11); 
                                        		      $b =rand(1,11); ?> 
                                         <?php echo $a.' + '.$b ; ?> = ?</label>


                                        <input type="text" data-rule-number="true" maxlength="2" size="2" name="captcha" id="captcha" class="le-input col-md-3 col-xs-3" data-rule-required="true">
                                    </div><!-- /.field-row -->
                                    <div class="clearfix"></div>
                                      <input type="hidden" name="captcha_val" id="captcha_val" value="<?php echo ($a+$b)?>">

                                    <div class="field-row clearfix">
                                        <span class="pull-left">
                                            <label class="content-color"><input type="checkbox" class="le-checbox auto-width inline"> <span class="bold">Remember me</span></label>
                                        </span>
                                        <span class="pull-right">
                                            <a href="#"  data-toggle="modal" data-target=".forgot_password" data-backdrop="static" class="content-color bold">Forgotten Password ?</a>
                                        </span>
                                    </div>

                                    <div class="buttons-holder form-actions">
                                        <button id="Submit" name="Submit" type="submit" class="le-button huge">Secure Sign In</button>
                                    </div><!-- /.buttons-holder -->
                                </form><!-- /.cf-style-1 -->

                            </section><!-- /.sign-in -->
                        </div><!-- /.col -->
                        
                        <div class="col-md-3">
                        &nbsp;
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main><!-- /.authentication -->
            <!-- ========================================= MAIN : END ========================================= -->

           <?php include('st-footer.php'); ?>
       	</div><!-- /.wrapper -->



            <div class="modal fade forgot_password" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Forgot Password</h4>
                  </div>
                  <div class="modal-body">
                    <p style="color: red;display: none;" id="resetFail"></p>
                    <p style="color: green;display: none;" id="resetSuccess"></p>
                    <form role="form" class="login-form cf-style-1 form-horizontal form-bordered form-validate" id="frm_forgot_password" name="frm_login" novalidate>
                                    <div class="field-row control-group controls success">
                                       
                                        <input placeholder="Enter your registered email address" autocomplete="off" type="email" name="txt_femail" id="txt_femail" class="le-input col-md-12 col-xs-12 valid" data-rule-required="true">
                                    <span for="txt_femail"  class="help-block error valid"></span></div><!-- /.field-row -->
 <br>
                                    <div class="buttons-holder form-actions">
                                    <br>
                                        <button id="Submit"  name="Submit" type="button" onclick="resetPassword()" class="le-button ">Submit</button>
                                    </div><!-- /.buttons-holder -->
                                </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

		<?php include('st-javascript.php'); ?>
        <?php include('st-validator-js.php'); ?>
		<script type="text/javascript">
        	var baseurll = '<?php echo $BaseFolder; ?>';
			
			$('#frm_login').on('submit', function(e) {
				if($('#frm_login').valid())
				{
					e.preventDefault();
					var txt_email		= $('#txt_email').val();
					var txt_password	= $('#txt_password').val();
					var captcha		    = $('#captcha').val();
					var captcha_val	    = $('#captcha_val').val();
					var sendInfo 	= {"captcha_val":captcha_val,"captcha":captcha,"txt_email":txt_email, "txt_password":txt_password, "login_customer":1};
					
					var esn_edit	= JSON.stringify(sendInfo);				
					$.ajax({
						url: "includes/common.php",
						type: "POST",
						data: esn_edit,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								location.href	= baseurll + "/page-profile";
							} 
							else 
							{
								if(data.resp == 'verification_fail')
								{
									alert('Please do your Email Verification first');		
								}
								else
								{
									alert(data.resp);	
								}
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
						
			
		
				}
		});


			function resetPassword()
			{
					
				var txt_email		= $('#txt_femail').val();
				
				var sendInfo 	= {"txt_email":txt_email, "forgot_password":1};
				
				var esn_edit	= JSON.stringify(sendInfo);				
				$.ajax({
					url: "includes/common.php",
					type: "POST",
					data: esn_edit,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$('#resetSuccess').css('display','block');
							$('#resetFail').css('display','none');
							$('#resetSuccess').html(data.resp);
						} 
						else 
						{
							$('#resetSuccess').css('display','none');
							$('#resetFail').css('display','block');
							$('#resetFail').html(data.resp);
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
			
		}
        </script>
    </body>
</html>
