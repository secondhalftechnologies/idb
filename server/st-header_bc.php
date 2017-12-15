			<?php
				function getChild($parent_id,$html)
				{
					$childresult = getRecord('tbl_category',array('cat_type'=>$parent_id,'cat_status'=>1));

	            	$childNum  = mysqli_num_rows($childresult);
	            	$child_arr = array();
	            	
            		while($child_row = mysqli_fetch_array($childresult))
	            	{
	            		array_push($child_arr,$child_row);
	            	}
	            	  
				      $no_of_part = $childNum/3;
				      $no_of_part = round($no_of_part);
				      $j        = ($no_of_part * 2);
				      $k        = $childNum - $j;

	            	
	                
	                $html .='<ul class="dropdown-menu mega-menu">
	                    <li class="yamm-content">
	                        <div class="row">
	                            <div class="col-xs-12 col-lg-6">
	                                <ul>';

	                                for($i=0;$i<$j;$i++)
	                                {
	                                  
	                                  	$html .='<li><a href="product-list.php?cat_id='.$child_arr[$i]['cat_id'].'">'.ucwords($child_arr[$i]['cat_name']).'</a></li>';
	                                }
	                                	
	                             $html .='    </ul>
	                            </div>';


	                            if($k !=0) 
	                            {
	                             $html .='<div class="col-xs-12 col-lg-6">
	                                <ul>';
	                                   
	                                    for($i=$i;$i<$childNum;$i++)
	                                   {
	                                 $html .='		 <li><a href="#">'.ucwords($child_arr[$i]['cat_name']).'</a></li>';
	                                	 
	                                	}
	                                
	                             $html .='	   </ul>
	                            </div>';
	                            
	                             }
	                             

	                          $html .='	 <!--  <div class="dropdown-banner-holder">
	                                <a href="#"><img alt="" src="assets/images/banners/banner-side.png" /></a>
	                            </div> -->
	                        </div>
	                        <!-- ================================== MEGAMENU VERTICAL ================================== -->
	                    </li>
	                </ul>';
	                
			return $html;
			}
			?>

			<header>
    			<div class="container-fluid no-padding">
					<div class="col-xs-12 col-md-3 logo-holder">
						<!-- ============================================================= LOGO ============================================================= -->
						<div class="logo">
							<a href="index.php">
								<img src="assets/images/logo.png" style="width: 90%;">
							</a>
						</div><!-- /.logo -->
					</div><!-- /.logo-holder -->

					<div class="col-xs-12 col-md-6 top-search-holder no-margin">
						
						<div class="search-area">
						    <form>
						        <div class="control-group">
						            <ul class="categories-filter animate-dropdown">
						                <li class="dropdown">

						                    <a class="dropdown-toggle"  data-toggle="dropdown" href="javascript:void(0);">all</a>

						                    <ul class="dropdown-menu" role="menu" >
						                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);">Raw</a></li>
						                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);">Formulation</a></li>
						                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);">Surgical</a></li>
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
						        <div class="basket">

						            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                <div class="basket-item-count">
						                    <span class="count">3</span>
						                    <img src="<?php echo $BaseFolder; ?>/assets/images/icon-cart.png" alt="" />
						                </div>

						                <div class="total-price-basket">
						                    <span class="lbl">your cart:</span>
						                    <span class="total-price">
						                        <span class="sign">$</span><span class="value">3219,00</span>
						                    </span>
						                </div>
						            </a>

						            <ul class="dropdown-menu">
						                <li>
						                    <div class="basket-item">
						                        <div class="row">
						                            <div class="col-xs-4 col-sm-4 no-margin text-center">
						                                <div class="thumb">
						                                    <img alt="" src="<?php echo $BaseFolder; ?>/assets/images/products/product-small-01.jpg" />
						                                </div>
						                            </div>
						                            <div class="col-xs-8 col-sm-8 no-margin">
						                                <div class="title">Blueberry</div>
						                                <div class="price">$270.00</div>
						                            </div>
						                        </div>
						                        <a class="close-btn" href="#"></a>
						                    </div>
						                </li>

						                <li>
						                    <div class="basket-item">
						                        <div class="row">
						                            <div class="col-xs-4 col-sm-4 no-margin text-center">
						                                <div class="thumb">
						                                    <img alt="" src="<?php echo $BaseFolder; ?>/assets/images/products/product-small-01.jpg" />
						                                </div>
						                            </div>
						                            <div class="col-xs-8 col-sm-8 no-margin">
						                                <div class="title">Blueberry</div>
						                                <div class="price">$270.00</div>
						                            </div>
						                        </div>
						                        <a class="close-btn" href="#"></a>
						                    </div>
						                </li>

						                <li>
						                    <div class="basket-item">
						                        <div class="row">
						                            <div class="col-xs-4 col-sm-4 no-margin text-center">
						                                <div class="thumb">
						                                    <img alt="" src="<?php echo $BaseFolder; ?>/assets/images/products/product-small-01.jpg" />
						                                </div>
						                            </div>
						                            <div class="col-xs-8 col-sm-8 no-margin">
						                                <div class="title">Blueberry</div>
						                                <div class="price">$270.00</div>
						                            </div>
						                        </div>
						                        <a class="close-btn" href="#"></a>
						                    </div>
						                </li>

						                <li class="checkout">
						                    <div class="basket-item">
						                        <div class="row">
						                            <div class="col-xs-12 col-sm-6">
						                                <a href="cart.html" class="le-button inverse">View cart</a>
						                            </div>
						                            <div class="col-xs-12 col-sm-6">
						                                <a href="checkout.html" class="le-button">Checkout</a>
						                            </div>
						                        </div>
						                    </div>
						                </li>

						            </ul>
						        </div><!-- /.basket -->
						    </div><!-- /.top-cart-holder -->
						</div><!-- /.top-cart-row-container -->
					</div><!-- /.top-cart-row -->
				</div><!-- /.container -->
                
                <div class="container-fluid no-padding">
                	<!-- <div class="col-xs-12 col-md-3 no-padding">
	                  	<li class="dropdown le-dropdown">
	                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                                        <i class="fa fa-list"></i> Shop by Category
	                                </a>
	                                 <ul class="dropdown-menu">
                                        <li><a href="#">Raw</a></li>
                                        <li><a href="#">Formulation</a></li>
                                        <li><a href="#">Surgical</a></li>
                                        
                                    </ul>
	                                
	                            <nav class="yamm megamenu-horizontal" role="navigation">
                                	<ul class="nav">

		                                <li class="dropdown menu-item">
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Value of the Day</a>
	                                        <ul class="dropdown-menu mega-menu">
	                                            <li class="yamm-content">
	                                                
	                                                <div class="row">
	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Computer Cases &amp; Accessories</a></li>
	                                                            <li><a href="#">CPUs, Processors</a></li>
	                                                            <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
	                                                            <li><a href="#">Graphics, Video Cards</a></li>
	                                                            <li><a href="#">Interface, Add-On Cards</a></li>
	                                                            <li><a href="#">Laptop Replacement Parts</a></li>
	                                                            <li><a href="#">Memory (RAM)</a></li>
	                                                            <li><a href="#">Motherboards</a></li>
	                                                            <li><a href="#">Motherboard &amp; CPU Combos</a></li>
	                                                            <li><a href="#">Motherboard Components &amp; Accs</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Power Supplies Power</a></li>
	                                                            <li><a href="#">Power Supply Testers Sound</a></li>
	                                                            <li><a href="#">Sound Cards (Internal)</a></li>
	                                                            <li><a href="#">Video Capture &amp; TV Tuner Cards</a></li>
	                                                            <li><a href="#">Other</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="dropdown-banner-holder">
	                                                        <a href="#"><img alt="" src="assets/images/banners/banner-side.png" /></a>
	                                                    </div>
	                                                </div>
	                                                
	                                            </li>
	                                        </ul>
	                                    </li>
	                                    <li class="dropdown menu-item">
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laptops &amp; Computers</a>
	                                        <ul class="dropdown-menu mega-menu">
	                                            <li class="yamm-content">
	                                               
	                                                <div class="row">
	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Computer Cases &amp; Accessories</a></li>
	                                                            <li><a href="#">CPUs, Processors</a></li>
	                                                            <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
	                                                            <li><a href="#">Graphics, Video Cards</a></li>
	                                                            <li><a href="#">Interface, Add-On Cards</a></li>
	                                                            <li><a href="#">Laptop Replacement Parts</a></li>
	                                                            <li><a href="#">Memory (RAM)</a></li>
	                                                            <li><a href="#">Motherboards</a></li>
	                                                            <li><a href="#">Motherboard &amp; CPU Combos</a></li>
	                                                            <li><a href="#">Motherboard Components &amp; Accs</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Power Supplies Power</a></li>
	                                                            <li><a href="#">Power Supply Testers Sound</a></li>
	                                                            <li><a href="#">Sound Cards (Internal)</a></li>
	                                                            <li><a href="#">Video Capture &amp; TV Tuner Cards</a></li>
	                                                            <li><a href="#">Other</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="dropdown-banner-holder">
	                                                        <a href="#"><img alt="" src="assets/images/banners/banner-side.png" /></a>
	                                                    </div>
	                                                </div>
	                                               
	                                            </li>
	                                        </ul>
	                                    </li>
	                                    <li class="dropdown menu-item">
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cameras &amp; Photography</a>
	                                        <ul class="dropdown-menu mega-menu">
	                                            <li class="yamm-content">
	                                               
	                                                <div class="row">
	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Computer Cases &amp; Accessories</a></li>
	                                                            <li><a href="#">CPUs, Processors</a></li>
	                                                            <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
	                                                            <li><a href="#">Graphics, Video Cards</a></li>
	                                                            <li><a href="#">Interface, Add-On Cards</a></li>
	                                                            <li><a href="#">Laptop Replacement Parts</a></li>
	                                                            <li><a href="#">Memory (RAM)</a></li>
	                                                            <li><a href="#">Motherboards</a></li>
	                                                            <li><a href="#">Motherboard &amp; CPU Combos</a></li>
	                                                            <li><a href="#">Motherboard Components &amp; Accs</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="col-xs-12 col-lg-4">
	                                                        <ul>
	                                                            <li><a href="#">Power Supplies Power</a></li>
	                                                            <li><a href="#">Power Supply Testers Sound</a></li>
	                                                            <li><a href="#">Sound Cards (Internal)</a></li>
	                                                            <li><a href="#">Video Capture &amp; TV Tuner Cards</a></li>
	                                                            <li><a href="#">Other</a></li>
	                                                        </ul>
	                                                    </div>

	                                                    <div class="dropdown-banner-holder">
	                                                        <a href="#"><img alt="" src="assets/images/banners/banner-side.png" /></a>
	                                                    </div>
	                                                </div>
	                                            </li>
	                                        </ul>
	                                    </li>
	                                </ul>
	                            </nav>
	                    </li>
                  	</div> -->

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
                            	{
                            		if(isExist('tbl_category',array('cat_type'=>$row['cat_id'],'cat_status'=>1)));
                            		{?>
                            			<li class="dropdown menu-item">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords($row['cat_name']); ?></a>
                                        <?php echo getChild($row['cat_id'],$html=""); ?>
                            		<?php
                            		}
                            		?>
									</li><!-- /.menu-item -->

                            		<?php
                            		}
                            		?>
                                    
								</ul><!-- /.nav -->


                                <?php
                            	$result = getRecord('tbl_category',array('cat_type'=>'parent','cat_status'=>1));
                            	?>

                            	<ul class="nav">
                            		<?php 
                            		while($row = mysqli_fetch_array($result))
                            		{?>
										<li class="dropdown menu-item">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords($row['cat_name']); ?></a>
                                        <?php
		                            	$childresult = getRecord('tbl_category',array('cat_type'=>$row['cat_id'],'cat_status'=>1));

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
                                                    <div class="col-xs-12 col-lg-6">
                                                        <ul>
                                                        	<?php 
                                                        	for($i=0;$i<$j;$i++)
                                                        	{?>
                                                        		 	<li><a href="product-list.php?cat_id=<?php echo $child_arr[$i]['cat_id'];?>"><?php echo ucwords($child_arr[$i]['cat_name']);?></a></li>
                                                        	<?php 
                                                        	}
                                                        	?>
                                                        </ul>
                                                    </div>
                                                    <?php if($k !=0) 
                                                    {?>
                                                    <div class="col-xs-12 col-lg-6">
                                                        <ul>
                                                            <?php 
                                                            for($i=$i;$i<$childNum;$i++)
                                                        	{?>
                                                        		 <li><a href="#"><?php echo ucwords($child_arr[$i]['cat_name']); ?></a></li>
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