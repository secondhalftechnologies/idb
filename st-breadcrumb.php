 
 
 <div class="animate-dropdown">
                <!-- ========================================= BREADCRUMB ========================================= -->
                <div id="top-mega-nav">
                    <div class="container">
                        <nav>
                            <ul class="inline">
                              <!--  <li class="dropdown le-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list"></i> shop by department
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Computer Cases & Accessories</a></li>
                                        <li><a href="#">CPUs, Processors</a></li>
                                        <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
                                        <li><a href="#">Graphics, Video Cards</a></li>
                                        <li><a href="#">Interface, Add-On Cards</a></li>
                                        <li><a href="#">Laptop Replacement Parts</a></li>
                                        <li><a href="#">Memory (RAM)</a></li>
                                        <li><a href="#">Motherboards</a></li>
                                        <li><a href="#">Motherboard &amp; CPU Combos</a></li>
                                        <li><a href="#">Motherboard Components</a></li>
                                    </ul>
                                </li>-->

                                <li class="breadcrumb-nav-holder">
                                    <ul>
                                        <li class="breadcrumb-item">
                                            <a href="index-2.html">Home</a>
                                        </li>
                                        <li class="breadcrumb-item current gray">
                                            <a href="about.html">Authentication</a>
                                        </li>
                                    </ul>
                                </li><!-- /.breadcrumb-nav-holder -->
                                
                                
                            </ul>
                            <!--======================Start : Done By satish 03112017===========================-->
                            <?php
								
								$sql_check_status= "SELECT cust_status  FROM tbl_customer WHERE cust_id ='".$logged_uid."' AND cust_type='trader'";
								$res_check_status = mysqli_query($db_con,$sql_check_status) or die(mysqli_error($db_con));
								$row_check_status = mysqli_fetch_array($res_check_status);
								if($row_check_status['cust_status']==1)
								{?>
                                 <div class="fright padding20">
                                    <a target="_blank" href="idbpanel/redirect.php">Go to Admin</a>
                                </div>
						  <?php }
							
							?>
                            <!--======================End : Done By satish 03112017===========================-->
                            
                        </nav>
                        <a>dhdsf</a>
                    </div><!-- /.container -->
                </div><!-- /#top-mega-nav -->
                <!-- ========================================= BREADCRUMB : END ========================================= -->
 </div>
