			
			<header>
    			<div class="container-fluid no-padding">
					<div class="col-xs-12 col-md-3 logo-holder">
						<!-- ============================================================= LOGO ============================================================= -->
						<div class="logo">
							<a href="index.php">
								<img src="assets/images/logo.png" >
							</a>
						</div><!-- /.logo -->
					</div><!-- /.logo-holder -->

					<div class="col-xs-12 col-md-6 top-search-holder no-margin">
						
						<div class="search-area">
						    <form>
						        <div class="control-group">
						            <ul class="categories-filter animate-dropdown">
						                <li class="dropdown">

						                    <?php
						                	$resCatName = 'All';
						                	if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'])
						                	{
						                		$reqCatId =$_REQUEST['cat_id'];
						                		$setCatRes = checkExist('tbl_category' ,array('cat_id'=>$reqCatId));
						                		if($setCatRes)
						                		{
						                			$resCatName = ucwords($setCatRes['cat_name']);
						                		}
						                	}
						                	
						                	?>
						                    <a class="dropdown-toggle"  data-toggle="dropdown" href="javascript:void(0);"><?php echo $resCatName; ?></a>
						                    <ul class="dropdown-menu" role="menu" >
						                    <?php
                            					$result = getRecord('tbl_category',array('cat_type'=>'parent','cat_status'=>1));

                            					while($row = mysqli_fetch_array($result))
                            					{?>
                            						<li role="presentation">
                            							<a  role="menuitem" tabindex="-1" href="product-list.php?cat_id=<?php echo $row['cat_id']; ?>"><?php echo ucwords($row['cat_name']); ?></a>
                            						</li>

												<?php
												}
                            				    ?>
						                        
						                    </ul>
						                </li>
						            </ul>
                                    <input class="search-field" placeholder="Search for item" />
						            <a class="search-button" href="#" ></a>

						        </div>
						    </form>
						</div><!-- /.search-area -->
						<!-- ============================================================= SEARCH AREA : END ============================================================= -->
					</div><!-- /.top-search-holder -->

					<div class="col-xs-12 col-md-3 top-cart-row no-margin">
						<div class="top-cart-row-container">
							<div class="wishlist-compare-holder">
								<img src="assets/images/app-download.png" /> 
							</div>
						    
						    <div class="top-cart-holder dropdown animate-dropdown">
						        <div class="basket" id="cartDetail">
						        	<?php

						        	if(isset($_SESSION['front_panel']))
									{
										$cart_ids  = array();
										$cust_id   = $_SESSION['front_panel']['cust_id'];
										$cres = getRecord('tbl_cart' ,array('cart_custid'=>$cust_id,'cart_status'=>0));
										if($cres)
										{
											while($crow = mysqli_fetch_array($cres))
											{
												array_push($cart_ids,$crow['cart_batchid']);
											}
										}
										
									}
									else
									{
										$batch_array   				= array_unique($_SESSION['offline_cart']);
										$_SESSION['offline_cart']	= $batch_array;
										$cart_ids              		= array_unique($batch_array);
									}
										
						        	?>
						            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                <div class="basket-item-count">
						                    <span class="count" id="cartCount"><?php echo count($cart_ids); ?></span>
						                    <img src="<?php echo $BaseFolder; ?>/assets/images/icon-cart.png" alt="" />
						                </div>

						                <div class="total-price-basket">
						                    <span class="lbl">your cart:</span>
						                    <span class="total-price">
						                        <span class="sign">$</span><span class="value">3219,00</span>
						                    </span>
						                </div>
						            </a>

						              
						             <?php 
 
										if(!empty($cart_ids) && isset($_SESSION['front_panel']) && $_SESSION['front_panel']['cust_id']==1)
										{
										    
										   
											$sql            = " SELECT * FROM tbl_batches as tb ";
											$sql           .= " INNER JOIN tbl_products as tp ON tb.prod_id = tp.id";
											$sql           .= " INNER JOIN tbl_product_images as ti ON tp.id = ti.prod_id";
											$sql           .= " WHERE batch_id IN (".implode(',',$cart_ids).") AND batch_status = 1 GROUP BY batch_id ";
											$sql 		   .=" ORDER BY find_in_set(tb.batch_id,'".implode(',',$cart_ids)."') DESC LIMIT 3";
											$res            = query($sql);
										//	$res            = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
											

										    $num   			= mysqli_num_rows($res);

											echo '<ul class="dropdown-menu cartBatches" id="cartCountBatches">';
								                
											while($row = mysqli_fetch_array($res))
											{
														echo '<li>
												                    <div class="basket-item">
												                        <div class="row">
												                            <div class="col-xs-4 col-sm-4 no-margin text-center">
												                                <div class="thumb">
												                                    <img alt="" src="'.$BaseFolder.'/images/products/prodid_'.$row['id'].'/small/'.$row['image_name'].'" width="70px" height="70px" />
												                                </div>
												                            </div>
												                            <div class="col-xs-8 col-sm-8 no-margin">
												                                <div class="title">
												                                	'.ucwords($row['prod_name']).'
												                                </div>
												                                <div class="price">'.$row['prod_price'].'</div>
												                            </div>
												                        </div>
												                        <a class="close-btn rbtn" id="rbtn_'.$row['batch_id'].'" href="#"></a>
												                    </div>
												                </li>';
													}

											echo '<li class="checkout">
						                    <div class="basket-item">
						                        <div class="row">
						                            <div class="col-xs-12 col-sm-6">
						                                <a href="page-cart.php" class="le-button inverse">View cart</a>
						                            </div>
						                            <div class="col-xs-12 col-sm-6">
						                                <a href="page-checkout.php" class="le-button">Checkout</a>
						                            </div>
						                        </div>
						                    </div>
						                </li>';

								        echo  '</ul>';

								        
										}
											
								           
											
										
									  ?>
						                

						            </ul>
						        </div><!-- /.basket -->
						    </div><!-- /.top-cart-holder -->
						</div><!-- /.top-cart-row-container -->
					</div><!-- /.top-cart-row -->
				</div><!-- /.container -->
                
                <div class="container-fluid no-padding">
               

                  	<div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder" >
                        <!-- ================================== TOP NAVIGATION ================================== -->
                        <div class="side-menu animate-dropdown">
                            <div id="btnshopbycat" class="head" style="cursor: pointer;"><i class="fa fa-list"></i> Shop by Category</div>
                            <nav id="shopbycategory" class="yamm megamenu-horizontal" role="navigation" style="position: absolute;z-index: 9999">
                            	<?php
                            	$result = getRecord('tbl_category',array('cat_type'=>'parent','cat_status'=>1));
                            	?>

                            	<ul class="nav">
                            		<?php 
                            		while($row = mysqli_fetch_array($result))
                            		{?>
										<li class="dropdown menu-item">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        	<?php echo ucwords($row['cat_name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                        <?php
		                            	$childresult = getRecord('tbl_attribute',array('cat_id'=>$row['cat_id'],'status'=>1));

		                            	$childNum  = mysqli_num_rows($childresult);
		                            	$child_arr = array();
		                            	if($childNum !=0)
		                            	{
		                            		while($child_row = mysqli_fetch_array($childresult))
		                            		{
		                            			array_push($child_arr,$child_row);
		                            		}
		                            	  
									      $no_of_part = $childNum/3;
									      $no_of_part = round($no_of_part);
									      $j        = ($no_of_part * 2);
									      $k        = $childNum - $j;

		                            	?>
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                                <div class="row">
                                                    <div class="col-xs-12 col-lg-4">
                                                        <ul>
                                                        	<?php 
                                                        	for($i=0;$i<$j;$i++)
                                                        	{?>
                                                        		 <li><a href="product-list.php?cat_id=<?php echo $child_arr[$i]['id']; ?>"><?php echo ucwords($child_arr[$i]['attribute_name']); ?></a></li>
                                                        	<?php 
                                                        	}
                                                        	?>
                                                        </ul>
                                                    </div>


                                                    <?php if($k !=0) 
                                                    {?>
                                                    <div class="col-xs-12 col-lg-4">
                                                        <ul>
                                                            <?php 
                                                            for($i=$i;$i<$childNum;$i++)
                                                        	{?>
                                                        		 <li><a href="product-list.php?cat_id=<?php echo $child_arr[$i]['id']; ?>"><?php echo ucwords($child_arr[$i]['attribute_name']); ?></a></li>
                                                        	<?php 
                                                        	}
                                                        	?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                     }
                                                     ?>

                                                    <div class="dropdown-banner-holder">
                                                        <a href="#"><img alt="" src="assets/images/banners/banner-side.png" /></a>
                                                    </div> 
                                                    <div style="clear: both"></div>
                                                </div>
                                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                            </li>
                                        </ul>
                                        <?php } ?>
                                    </li><!-- /.menu-item -->

                            		<?php
                            		}
                            		?>
                                </ul><!-- /.nav -->
								</ul><!-- /.nav -->
                            </nav><!-- /.megamenu-horizontal -->
                        </div><!-- /.side-menu -->
                        <!-- ================================== TOP NAVIGATION : END ================================== -->
                    </div><!-- /.sidemenu-holder -->

                	<div class="col-xs-12 col-md-9 no-padding" id="topmenutogggle" >
	                  	<nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
						    <div class="yamm navbar" style="min-height:0px;">
						            <div class="navbar-header">
						                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
						                    <span class="sr-only">Toggle navigation</span>
						                    <span class="icon-bar"></span>
						                    <span class="icon-bar"></span>
						                    <span class="icon-bar"></span>
						                </button>
						            </div><!-- /.navbar-header -->
						            <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
						                <ul class="nav navbar-nav">
						                    <li><a href="javascript:void(0)">Today's Deals</a></li>
						                    <li><a href="javascript:void(0)">Sell</a></li>
						                    <li><a href="javascript:void(0)">Customer Service</a></li>
						                    <li><a href="javascript:void(0)">Track Your Order</a></li>
                                            
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
                                                <li><a href="<?php echo $BaseFolder; ?>/page-register">Register</a></li>
                                            <?php
											}?>
                                            <!--=================End : Check Login Dn by Satish 06112017====================-->
                                            
                                            
						                </ul><!-- /.navbar-nav -->
					            </div><!-- /.navbar-collapse -->
						           
						    </div>
						</nav>
                  	</div>
                </div>
            </header>
