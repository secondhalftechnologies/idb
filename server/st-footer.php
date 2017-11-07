<!-- ============================================================= FOOTER ============================================================= -->
            <footer id="footer" class="color-bg">
                <div class="container">
                    <div class="row no-margin widgets-row">
                        <div class="col-xs-12  col-sm-4 no-margin-left">
                           
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-4 ">
                            
                        </div><!-- /.col -->
                    </div><!-- /.widgets-row-->
                </div><!-- /.container -->

                

                <div class="link-list-row">
                    <div class="container no-padding">
                        <div class="col-xs-12 col-md-4 ">
                           
                            <div class="contact-info">
                                <div class="footer-logo">
                                   <img src="assets/images/logo_p.png" class="img-responsive"  />
                                </div><!-- /.footer-logo -->

                                <p class="regular-bold">Stepping Stone In Making Indian Generics Affordable At Cheapest Price And Doorstep Delivery To The Medical Fraternity.</p>

                               

                                <div class="social-icons">
                                    <h3>Get in touch</h3>
                                    <ul>
                                        <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-pinterest"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-stumbleupon"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-dribbble"></a></li>
                                        <li><a href="javascript:void(0);" class="fa fa-vk"></a></li>
                                    </ul>
                                </div><!-- /.social-icons -->

                            </div>
                            
                        </div>

                        <div class="col-xs-12 col-md-8 no-margin">
                            <!-- ============================================================= LINKS FOOTER ============================================================= -->
                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Know IDB</h3>
                                    <ul>
                                        <li><a href="<?php echo $BaseFolder; ?>/page-about">About IDB</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/page-contact">Contact Us</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/terms-and-conditions">Terms &amp; Conditions</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/page-disclaimer">Disclaimer</a></li>
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->


                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Your Order</h3>
                                    <ul>
                                    	<!--=================Start : Check Login Dn by Satish 06112017====================-->
										<?php
                                        if(isset($_SESSION['front_panel']))
                                        {?>
                                             <li><a href="<?php echo $BaseFolder; ?>/page-profile">My Account</a></li>
                                            
                                        <?php
                                        }
                                        else
                                        {?>
                                            <li><a href="<?php echo $BaseFolder; ?>/page-login">Login</a></li>
                                        <?php
                                        }?>
                                         <li><a href="javascript:void(0);">Order History</a></li>
                                         <li><a href="<?php echo $BaseFolder; ?>/track-order">Track Order</a></li>
                                          <li><a href="<?php echo $BaseFolder; ?>/search-list.php">Search Product</a></li>
                                         <li><a href="<?php echo $BaseFolder; ?>/product-list.php">Product List</a></li>
                                          <li><a href="<?php echo $BaseFolder; ?>/product-detail.php">Product Detail</a></li>
                                        
                                        <!--=================End : Check Login Dn by Satish 06112017====================-->
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->

                            <div class="link-widget">
                                <div class="widget">
                                    <h3>Information</h3>
                                    <ul>
                                        <li><a href="<?php echo $BaseFolder; ?>/vendor-policy">Vendor Policy</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/buyer-policy">Buyer Policy</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/shipping-policy">Shipping Policy</a></li>
                                        <li><a href="<?php echo $BaseFolder; ?>/page-faqs">FAQs</a></li>
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.link-widget -->
                            
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.link-list-row -->

                <div class="copyright-bar">
                    <div class="container">
                        <div class="col-xs-12 col-sm-6 no-margin">
                            <div class="copyright">
                                &copy; <a href="<?php echo $BaseFolder; ?>">Indian Dava Bazar</a> - all rights reserved
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