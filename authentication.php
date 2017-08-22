<?php
	//include("includes/db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    	<?php
			$page_title			= "Login - Register";
			$meta_title			= "IDB";
			$meta_description	= "IDB";
			$meta_keywords		= "IDB";
			//headIncludes($page_title,$meta_title,$meta_description,$meta_keywords);
		?>
	</head>

	<body>
		<div class="wrapper">
			<!-- ============================================================= TOP NAVIGATION ============================================================= -->
			<?php
            	navigation();
			?>
            <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->

			<!-- ============================================================= HEADER ============================================================= -->
			<?php
            	pageHeader();
			?>
            <!-- ============================================================= HEADER : END ============================================================= -->

            
                <!-- ========================================= BREADCRUMB ========================================= -->
                <?php
                	breadCrumbs('', array('Authentication'));
				?>
                
                <!-- ========================================= BREADCRUMB : END ========================================= -->
            

            <!-- ========================================= MAIN ========================================= -->
            <main id="authentication" class="inner-bottom-md">
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <section class="section sign-in inner-right-xs">
                                <h2 class="bordered">Sign In</h2>
                                <p>Hello, Welcome to your account</p>

                                <div class="social-auth-buttons">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-facebook"></i> Sign In with Facebook</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button>
                                        </div>
                                    </div>
                                </div>

                                <form role="form" class="login-form cf-style-1" id="frm_login" name="frm_login">
                                    <div class="field-row">
                                        <label>Email</label>
                                        <input type="text" class="le-input">
                                    </div><!-- /.field-row -->

                                    <div class="field-row">
                                        <label>Password</label>
                                        <input type="text" class="le-input">
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

                        <div class="col-md-6">
                            <section class="section register inner-left-xs">
                                <h2 class="bordered">Create New Account</h2>
                                <p>Create your own IDB account</p>

                                <form role="form" class="register-form cf-style-1" id="frm_register" name="frm_register">
                                    <div class="field-row">
                                        <label>Name</label>
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

                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </main><!-- /.authentication -->
            <!-- ========================================= MAIN : END ========================================= -->

            <!-- ============================================================= FOOTER ============================================================= -->
            <footer id="footer" class="color-bg">
                <div class="container">
                    <div class="row no-margin widgets-row">
                        <div class="col-xs-12  col-sm-4 no-margin-left">
                            <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>Featured products</h2>
                                <div class="body">
                                    <ul>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">Netbook Acer Travel B113-E-10072</a>.
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-01.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-02.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-03.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.body -->
                            </div> <!-- /.widget -->
                            <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>On-Sale Products</h2>
                                <div class="body">
                                    <ul>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">HP Scanner 2910P</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-04.jpg" />
                                                    </a>
                                                </div>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">Galaxy Tab 3 GT-P5210 16GB, Wi-Fi, 10.1in - White</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-05.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-06.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.body -->
                            </div> <!-- /.widget -->
                            <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                            <div class="widget">
                                <h2>Top Rated Products</h2>
                                <div class="body">
                                    <ul>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">Galaxy Tab GT-P5210, 10" 16GB Wi-Fi</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-07.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">PowerShot Elph 115 16MP Digital Camera</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-08.jpg" />
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-9 no-margin">
                                                    <a href="single-product.html">Surface RT 64GB, Wi-Fi, 10.6in - Dark Titanium</a>
                                                    <div class="price">
                                                        <div class="price-prev">$2000</div>
                                                        <div class="price-current">$1873</div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-3 no-margin">
                                                    <a href="#" class="thumb-holder">
                                                        <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-small-09.jpg" />
                                                    </a>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.body -->
                            </div><!-- /.widget -->
                            <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->
                        </div><!-- /.col -->
                    </div><!-- /.widgets-row-->
                </div><!-- /.container -->

                <div class="sub-form-row">
                    <div class="container">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                            <form role="form">
                                <input placeholder="Subscribe to our newsletter">
                                <button class="le-button">Subscribe</button>
                            </form>
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.sub-form-row -->

                <div class="link-list-row">
                    <div class="container no-padding">
                        <div class="col-xs-12 col-md-4 ">
                            <!-- ============================================================= CONTACT INFO ============================================================= -->
                            <div class="contact-info">
                                <div class="footer-logo">
                                    <svg width="233px" height="54px" viewBox="0 0 233 54" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#f9f9f9" d=" M 0.00 0.00 L 233.00 0.00 L 233.00 54.00 L 0.00 54.00 L 0.00 0.00 Z" />
                                        <path class="logo-svg" d=" M 104.82 6.46 C 107.74 5.13 110.66 3.80 113.58 2.46 C 113.59 18.71 113.59 34.95 113.59 51.20 C 110.65 51.20 107.71 51.20 104.78 51.20 C 104.84 50.67 104.96 49.62 105.02 49.09 C 100.02 53.56 91.66 52.69 87.37 47.67 C 84.80 44.83 83.96 40.97 83.20 37.33 C 75.63 37.37 68.05 37.26 60.47 37.40 C 61.41 39.88 62.49 42.75 65.24 43.71 C 69.03 45.31 73.10 43.58 75.89 40.91 C 77.67 42.73 79.47 44.54 81.22 46.40 C 75.60 52.47 65.66 53.95 58.77 49.23 C 53.06 45.18 51.58 37.52 52.30 30.95 C 52.75 25.29 55.84 19.51 61.29 17.27 C 66.83 15.00 73.85 15.40 78.54 19.37 C 81.58 21.92 82.87 25.85 83.50 29.64 C 84.32 24.24 87.32 18.69 92.71 16.75 C 96.83 15.07 101.64 15.89 104.93 18.89 C 104.77 14.75 104.83 10.60 104.82 6.46 Z" />
                                        <path class="logo-svg" d=" M 118.44 3.44 C 121.37 1.09 126.26 3.21 126.52 6.97 C 127.17 10.89 122.39 14.12 119.00 12.03 C 115.74 10.46 115.39 5.41 118.44 3.44 Z" />
                                        <path class="logo-svg" d=" M 10.22 19.63 C 14.71 14.58 23.51 14.56 27.42 20.34 C 33.58 13.24 48.54 14.42 50.33 24.80 C 51.41 33.54 50.55 42.41 50.82 51.20 C 47.88 51.20 44.94 51.20 42.00 51.20 C 41.92 44.09 42.14 36.97 41.93 29.87 C 41.95 27.41 40.48 24.57 37.76 24.43 C 34.66 23.72 30.88 25.51 30.74 29.01 C 30.35 36.39 30.71 43.80 30.59 51.20 C 27.67 51.20 24.75 51.20 21.82 51.20 C 21.74 44.12 21.98 37.04 21.73 29.96 C 21.79 27.24 19.97 24.22 16.95 24.37 C 13.91 23.84 10.58 25.90 10.49 29.15 C 10.13 36.49 10.47 43.85 10.35 51.20 C 7.43 51.20 4.51 51.20 1.59 51.20 C 1.59 39.69 1.59 28.18 1.59 16.67 C 4.53 16.67 7.47 16.67 10.41 16.67 C 10.36 17.41 10.27 18.89 10.22 19.63 Z" />
                                        <path class="logo-svg" d=" M 129.25 19.84 C 135.49 16.15 143.23 14.75 150.23 16.89 C 154.92 18.35 157.47 23.34 157.42 28.02 C 157.56 35.75 157.42 43.47 157.47 51.20 C 154.57 51.20 151.68 51.20 148.79 51.20 C 148.84 50.65 148.93 49.56 148.98 49.01 C 144.10 52.49 137.26 53.09 132.09 49.91 C 126.05 46.27 125.51 36.43 131.16 32.19 C 136.26 28.22 143.30 28.77 149.13 30.64 C 148.62 28.53 148.91 25.65 146.65 24.49 C 141.77 22.26 136.27 24.40 131.93 26.90 C 131.04 24.55 130.14 22.19 129.25 19.84 Z" />
                                        <path class="logo-svg" d=" M 117.06 16.67 C 119.98 16.67 122.90 16.67 125.82 16.67 C 125.82 28.18 125.82 39.69 125.82 51.20 C 122.90 51.20 119.98 51.20 117.06 51.20 C 117.06 39.69 117.06 28.18 117.06 16.67 Z" />
                                        <path fill="#3a3a3a" d=" M 201.86 17.62 C 202.52 17.30 203.82 16.67 204.48 16.35 C 204.48 18.10 204.48 19.84 204.48 21.59 C 205.23 21.59 206.73 21.60 207.48 21.60 C 207.48 22.17 207.48 23.30 207.48 23.86 C 206.73 23.87 205.22 23.89 204.47 23.91 C 204.49 26.42 204.34 28.95 204.62 31.45 C 205.86 32.02 207.13 32.53 208.42 32.99 C 206.71 34.03 204.25 35.64 202.51 33.72 C 201.29 30.65 202.08 27.15 201.88 23.91 C 201.39 23.89 200.42 23.87 199.94 23.86 C 199.94 23.30 199.94 22.18 199.94 21.62 C 200.43 21.60 201.41 21.57 201.90 21.56 C 201.88 20.24 201.87 18.93 201.86 17.62 Z" />
                                        <path fill="#3a3a3a" d=" M 169.01 34.60 C 161.80 34.48 161.85 21.38 169.03 21.30 C 171.56 20.91 173.24 22.99 174.55 24.80 C 172.38 25.03 170.35 23.99 168.21 24.05 C 165.19 25.78 165.69 32.04 169.72 32.24 C 171.04 30.86 172.68 30.26 174.58 30.81 C 173.29 32.73 171.68 35.03 169.01 34.60 Z" />
                                        <path fill="#3a3a3a" d=" M 176.14 24.15 C 177.71 20.91 182.63 20.34 185.06 22.88 C 186.61 24.47 186.37 26.86 186.72 28.88 C 183.63 28.96 180.54 28.94 177.46 29.07 C 178.33 30.06 178.74 31.71 180.15 32.08 C 182.15 31.99 184.30 31.15 185.94 32.84 C 183.84 33.87 181.50 35.30 179.09 34.28 C 175.09 32.89 174.46 27.52 176.14 24.15 Z" />
                                        <path fill="#3a3a3a" d=" M 188.27 21.67 C 191.44 22.12 195.65 20.04 197.89 23.12 C 199.40 26.61 198.50 30.58 198.71 34.28 C 197.84 34.27 196.97 34.27 196.10 34.26 C 196.04 31.26 196.36 28.21 195.84 25.24 C 195.30 22.95 190.93 23.34 191.03 25.84 C 190.71 28.63 190.93 31.46 190.90 34.27 C 190.25 34.27 188.94 34.27 188.28 34.27 C 188.28 30.07 188.28 25.87 188.27 21.67 Z" />
                                        <path fill="#3a3a3a" d=" M 209.34 24.33 C 210.88 20.80 216.32 20.24 218.67 23.23 C 219.85 24.84 219.70 26.96 220.06 28.84 C 216.93 28.95 213.79 28.96 210.67 29.17 C 211.42 30.17 212.14 31.20 213.03 32.08 C 214.53 32.45 215.99 31.66 217.44 31.37 C 217.81 31.81 218.56 32.68 218.93 33.11 C 216.82 34.02 214.49 35.28 212.18 34.20 C 208.39 32.73 207.86 27.62 209.34 24.33 Z" />
                                        <path fill="#3a3a3a" d=" M 221.57 21.68 C 224.18 22.17 229.35 19.73 229.26 23.99 C 227.69 24.37 225.10 23.31 224.48 25.41 C 223.89 28.32 224.25 31.33 224.17 34.27 C 223.52 34.27 222.23 34.27 221.58 34.27 C 221.58 30.07 221.58 25.88 221.57 21.68 Z" />
                                        <path fill="#f9f9f9" d=" M 177.47 26.72 C 178.35 25.45 179.09 23.45 180.99 23.60 C 182.85 23.48 183.54 25.46 184.45 26.68 C 182.12 26.79 179.79 26.80 177.47 26.72 Z" />
                                        <path fill="#f9f9f9" d=" M 210.63 26.63 C 211.70 25.38 212.59 23.21 214.62 23.63 C 216.40 23.58 216.80 25.59 217.66 26.73 C 215.32 26.80 212.97 26.77 210.63 26.63 Z" />
                                        <path fill="#f9f9f9" d=" M 60.57 29.87 C 61.45 26.41 64.15 23.26 68.04 23.58 C 71.91 23.17 74.23 26.62 75.30 29.84 C 70.39 29.99 65.48 29.97 60.57 29.87 Z" />
                                        <path fill="#f9f9f9" d=" M 96.52 24.70 C 99.50 23.55 102.54 25.02 104.87 26.85 C 104.80 31.61 104.80 36.38 104.86 41.14 C 102.46 43.09 99.18 44.42 96.17 43.02 C 92.82 41.46 91.99 37.36 91.96 34.01 C 91.89 30.51 92.82 26.06 96.52 24.70 Z" />
                                        <path fill="#f9f9f9" d=" M 137.58 37.63 C 141.09 35.82 145.16 36.85 148.82 37.59 C 148.82 38.98 148.80 40.38 148.79 41.78 C 145.51 43.89 141.25 45.34 137.54 43.42 C 135.23 42.33 135.28 38.72 137.58 37.63 Z" />
                                        <path class="logo-svg" d=" M 163.30 39.16 C 165.64 38.00 168.47 38.66 171.01 38.49 C 172.96 38.53 176.17 38.23 176.35 40.94 C 176.51 46.79 170.77 51.96 165.05 51.93 C 161.43 51.79 162.41 47.39 162.23 44.97 C 162.49 43.09 161.71 40.56 163.30 39.16 Z" />
                                    </svg>
                                </div><!-- /.footer-logo -->

                                <p class="regular-bold"> Feel free to contact us via phone,email or just send us mail.</p>

                                <p>
                                    17 Princess Road, London, Greater London NW1 8JR, UK
                                    1-888-8MEDIA (1-888-892-9953)
                                </p>

                                <div class="social-icons">
                                    <h3>Get in touch</h3>
                                    <ul>
                                        <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-pinterest"></a></li>
                                        <li><a href="#" class="fa fa-linkedin"></a></li>
                                        <li><a href="#" class="fa fa-stumbleupon"></a></li>
                                        <li><a href="#" class="fa fa-dribbble"></a></li>
                                        <li><a href="#" class="fa fa-vk"></a></li>
                                    </ul>
                                </div><!-- /.social-icons -->

                            </div>
                            <!-- ============================================================= CONTACT INFO : END ============================================================= -->
                        </div>

                        <div class="col-xs-12 col-md-8 no-margin">
                            <!-- ============================================================= LINKS FOOTER ============================================================= -->
                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Find it fast</h3>
                                    <ul>
                                        <li><a href="category-grid.html">laptops &amp; computers</a></li>
                                        <li><a href="category-grid.html">Cameras &amp; Photography</a></li>
                                        <li><a href="category-grid.html">Smart Phones &amp; Tablets</a></li>
                                        <li><a href="category-grid.html">Video Games &amp; Consoles</a></li>
                                        <li><a href="category-grid.html">TV &amp; Audio</a></li>
                                        <li><a href="category-grid.html">Gadgets</a></li>
                                        <li><a href="category-grid.html">Car Electronic &amp; GPS</a></li>
                                        <li><a href="category-grid.html">Accesories</a></li>
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->

                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Information</h3>
                                    <ul>
                                        <li><a href="category-grid.html">Find a Store</a></li>
                                        <li><a href="category-grid.html">About Us</a></li>
                                        <li><a href="category-grid.html">Contact Us</a></li>
                                        <li><a href="category-grid.html">Weekly Deals</a></li>
                                        <li><a href="category-grid.html">Gift Cards</a></li>
                                        <li><a href="category-grid.html">Recycling Program</a></li>
                                        <li><a href="category-grid.html">Community</a></li>
                                        <li><a href="category-grid.html">Careers</a></li>

                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->

                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Information</h3>
                                    <ul>
                                        <li><a href="category-grid.html">My Account</a></li>
                                        <li><a href="category-grid.html">Order Tracking</a></li>
                                        <li><a href="category-grid.html">Wish List</a></li>
                                        <li><a href="category-grid.html">Customer Service</a></li>
                                        <li><a href="category-grid.html">Returns / Exchange</a></li>
                                        <li><a href="category-grid.html">FAQs</a></li>
                                        <li><a href="category-grid.html">Product Support</a></li>
                                        <li><a href="category-grid.html">Extended Service Plans</a></li>
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->
                            <!-- ============================================================= LINKS FOOTER : END ============================================================= -->
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.link-list-row -->

                <div class="copyright-bar">
                    <div class="container">
                        <div class="col-xs-12 col-sm-6 no-margin">
                            <div class="copyright">
                                &copy; <a href="index-2.html">Media Center</a> - all rights reserved
                            </div><!-- /.copyright -->
                        </div>
                        <div class="col-xs-12 col-sm-6 no-margin">
                            <div class="payment-methods ">
                                <ul>
                                    <li><img alt="" src="assets/images/payments/payment-visa.png"></li>
                                    <li><img alt="" src="assets/images/payments/payment-master.png"></li>
                                    <li><img alt="" src="assets/images/payments/payment-paypal.png"></li>
                                    <li><img alt="" src="assets/images/payments/payment-skrill.png"></li>
                                </ul>
                            </div><!-- /.payment-methods -->
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.copyright-bar -->
            </footer><!-- /#footer -->
            <!-- ============================================================= FOOTER : END ============================================================= -->
        </div><!-- /.wrapper -->
		<?php
        	footerData();
		?>
		<!-- For demo purposes – can be removed on production : End -->
		<script type="text/javascript">
        	$('#frm_register').on('submit', function(e) {
			e.preventDefault();
					
			var txt_name		= $('#txt_name').val();
			var txt_email		= $('#txt_email').val();
			var txt_mobile		= $('#txt_mobile').val();
			var txt_password	= $('#txt_password').val();
			var txt_license_num	= $('#txt_license_num').val();
			
			var reg_customer	= '1';
			
			$('input[name="btn_submit"]').attr('disabled', 'true');
			
			var sendInfo 	= {"txt_name":txt_name, "txt_email":txt_email, "txt_mobile":txt_mobile, "txt_password":txt_password, "txt_license_num":txt_license_num, "reg_customer":1};
			
			var esn_edit	= JSON.stringify(sendInfo);				
			$.ajax({
				url: "load_authentication.php",
				type: "POST",
				data: esn_edit,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						alert('Added Successfully');
						return false;
						//window.location.assign("add_email_sms_notification_content.php?pag=<?php echo $title; ?>");
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
