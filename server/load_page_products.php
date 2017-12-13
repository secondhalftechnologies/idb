<?php
	include("includes/db_con.php");
	include('includes/query-helper.php');
	include('includes/random-helper.php');
	include('includes/email-helper.php');
	include('includes/city-state-country-helper.php');
	
	function dataPagination($query,$per_page,$start,$cur_page)
	{
		global $db_con;
		$start_offset1  	= 1;	// Start Point
		$start_offset2  	= 1;	// End of the Limit
		$previous_btn 		= true;
		$next_btn 			= true;
		$first_btn 			= true;
		$last_btn 			= true;
		$msg 				= "";
		$result_pag_num 	= mysqli_query($db_con,$query) or die(mysqli_error($db_con));;
		$record_count		= mysqli_num_rows($result_pag_num);	// Total Count of the Record
		
		$no_of_paginations 	= ceil($record_count / $per_page);	// Getting the total number of pages
		/*Edit Count Query*/
		/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
		
		
		if($cur_page >= 5) 
		{
			$start_loop = $cur_page - 2;
			if ($no_of_paginations > $cur_page + 2)
			{
				$end_loop = $cur_page + 2;			
			}
			elseif($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 4) 
			{
				$start_loop = $no_of_paginations - 4;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		} 
		else 
		{		
			$start_loop = 1;
			if ($no_of_paginations > 5)
			{
				$end_loop = 5;			
			}
			else
			{
				$end_loop = $no_of_paginations;			
			}
		}
		/* ----------------------------------------------------------------------------------------------------------- */
		
		$msg .= "<br>";
		$msg .= '<div class="row">';
        	$msg .= '<div class="col-xs-12 col-sm-6 text-left">';
			$msg	.= '<ul class="pagination">';		
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1)
			{
				$pre = $cur_page - 1;
				$msg .= "<li class='current'><a p='".$pre."' >";
					$msg .= "<i class='fa fa-angle-double-left '></i>";
				$msg .= "</a></li>";
			}
			else
			{
				$msg .= "<li><a class='' disabled>";
					$msg .= "<i class='fa fa-angle-double-left'></i>";
				$msg .= "</a></li>";
			}
			
			for ($i = $start_loop; $i <= $end_loop; $i++) 
			{
				$msg .= "<li ";
				if ($cur_page == $i)
				{
					$msg .= "class='current'";
				}
				$msg .=" ><a p='".$i."' ";
				
				$msg .= ">".$i."</a></li>";
			}
			
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations)
			{
				$nex = $cur_page + 1;
				$msg .= "<li  class='current'><a p='".$nex."'>";
					$msg .= "<i class='fa fa-angle-double-right'></i>";
				$msg .= "</a></li>";	
			}
			else
			{
				$msg .= "<li><a class=''>";
					$msg .= "<i class='fa fa-angle-double-right'></i>";
				$msg .= "</a></li>";			
			}
			$start_offset1 = $cur_page * $per_page + 1 - $per_page;
			if($end_loop == $cur_page)
			{
				$start_offset2 = $record_count;
			}
			else
			{
				$start_offset2 = $cur_page * $per_page;
			}
			$msg	.= '</ul></div>';
		$msg .= '<div class="col-xs-12 col-sm-6">';
		
		$data_count				= dataCount($query,$per_page,$start,$cur_page);
                                             $msg .='       <div class="result-counter">
                                                        '.$data_count.'
                                                    </div><!-- /.result-counter -->
                                                </div></div>';
		//$total_string = "<div class='total' a='$no_of_paginations' style='color:#333333;font-family: Open Sans,sans-serif;font-size: 13px !important;'>Showing <b>".$start_offset1."</b> to <b>".$start_offset2."</b> of <b>".$record_count."</b> entries</div>";
		//$msg1 = $msg . $total_string ;  // Content for pagination	
		$msg1 = $msg;
		if(!$record_count=='0')
		{
			return $msg1;
		}
		else
		{
			return 0;	
		}
	}
	
	function dataCount($query,$per_page,$start,$cur_page)
	{
		global $db_con;
		$start_offset1  	= 1;	// Start Point
		$start_offset2  	= 1;	// End of the Limit
		$result_pag_num 	= mysqli_query($db_con,$query) or die(mysqli_error($db_con));;
		$record_count		= mysqli_num_rows($result_pag_num);	// Total Count of the Record
		
		$no_of_paginations 	= ceil($record_count / $per_page);	// Getting the total number of pages
		
		if($cur_page >= 5) 
		{
			$start_loop = $cur_page - 2;
			if ($no_of_paginations > $cur_page + 2)
			{
				$end_loop = $cur_page + 2;			
			}
			elseif($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 4) 
			{
				$start_loop = $no_of_paginations - 4;
				$end_loop = $no_of_paginations;
			}
			else
			{
				$end_loop = $no_of_paginations;
			}
		} 
		else 
		{		
			$start_loop = 1;
			if ($no_of_paginations > 5)
			{
				$end_loop = 5;			
			}
			else
			{
				$end_loop = $no_of_paginations;			
			}
		}
		
		$start_offset1 = $cur_page * $per_page + 1 - $per_page;
		if($end_loop == $cur_page)
		{
			$start_offset2 = $record_count;
		}
		else
		{
			$start_offset2 = $cur_page * $per_page;
		}
		
		$total_string = "<div class='total' a='".$no_of_paginations."' style='color:#333333;font-family: Open Sans,sans-serif;font-size: 13px !important;'><h4>(Showing <b>".$start_offset1."</b> to <b>".$start_offset2."</b> of <b>".$record_count."</b> entries)</h4></div>";
		
		$total_string ="Showing <span>".$start_offset1."-".$start_offset2."</span> of <span>".$record_count."</span> results";
		if(!$total_string=='')
		{
			return $total_string;
		}
		else
		{
			return 0;	
		}
	}
	
	
	
	//===================================================================================================================//
	//==========================Start : Load Products Dn BY satish======================================================//
	
	if((isset($obj->getProducts)) == '1' && (isset($obj->getProducts)))
	{
		$order_by		= $obj->sort_by;
		$page			= $obj->page;
		$per_page    	= $obj->per_page;
		$data           ='';
		$start_offset   = 0;
		$sort_by				= array(0=>"",1=>" batch_created desc ",2=>"prod_price asc ",3=>" prod_price desc ");
		
		
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset  += $page * $per_page;
		$start 			= $page * $per_page;
		
		$sql            = " SELECT * FROM tbl_batches as tb ";
		$sql           .= " INNER JOIN tbl_products as tp ON tb.prod_id = tp.id";
		$sql           .= " INNER JOIN tbl_product_images as ti ON tp.id = ti.prod_id";
		$sql           .= " WHERE tp.prod_status=1 AND tb.batch_status=1";
		$sql           .= " GROUP BY batch_id";
		if($order_by != "")
		{
			foreach($sort_by as $id => $condition)
			{
				if($id == $order_by)
				{
					$sql	.= " order by ".$condition;					
				}
			}
		}
		$res            = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
		
		while($row = mysqli_fetch_array($res))
		{
			$manufacturing_date = explode('-',$row['prod_manu_date']);
			$manufacturing_date = $manufacturing_date[1].'/'.$manufacturing_date[0];
			
			$expiry_date        = explode('-',$row['prod_exp_date']);
			$expiry_date		= $expiry_date[1].'/'.$expiry_date[0];
			
			
			
			$application        = $row['prod_attribute'];
			if($application!="")
			{
				$sql_get_applcation  = "SELECT GROUP_CONCAT(attribute_name separator  ', ') as attribute FROM tbl_attribute WHERE id IN(".$application.")";
				$res_get_application = mysqli_query($db_con,$sql_get_applcation) or die(mysqli_error($db_con));
				$row_get_application = mysqli_fetch_array($res_get_application);
				$application         = $row_get_application['attribute'];
			}
			
			
			
			
			
			$data .='<div class="product-item product-item-holder">
						<div class="ribbon red"><span>sale</span></div>
						<div class="ribbon blue"><span>new!</span></div>
						<div class="row">
							<div class="no-margin col-xs-12 col-sm-4 image-holder">
								<div class="image">
									<img alt="'.$row['image_name'].'" src="images/products/prodid_'.$row['id'].'/medium/'.$row['image_name'].'" data-echo="images/products/prodid_'.$row['id'].'/medium/'.$row['image_name'].'" />
								</div>
							</div><!-- /.image-holder -->
							<div class="no-margin col-xs-12 col-sm-5 body-holder">
								<div class="body">
									<div class="label-discount green">-50% sale</div>
									<div class="title">
										<a href="'.$BaseFolder.'/'.$row['prod_slug'].'-'.$row['batch_id'].'-a">'.ucwords($row['prod_name']).'</a>
									</div>
									<div class="brand">'.ucwords($row['prod_manufactured']).'</div>
									<div class="excerpt">
										<p><strong>Application:</strong> '.ucwords($application).'<br />
										<strong>Manufacturing Date:</strong> '.$manufacturing_date.'<br />
										<strong>Expiry Date:</strong> '.$expiry_date.'</p>
									</div>
								</div>
							</div><!-- /.body-holder -->
							<div class="no-margin col-xs-12 col-sm-3 price-area">
								<div class="right-clmn">
									<div class="price-current">Rs. '.$row['prod_price'].'</div>
									<div class="price-prev"></div>
									<div class="availability"><label>Seller Location:</label><span class="available">  Mumbai, MH</span></div>
									<a class="le-button" href="#">add to cart</a>
								</div>
							</div><!-- /.price-area -->
						</div><!-- /.row -->
					</div>';
		}
		$data_pagination		= dataPagination($sql,$per_page,$start,$cur_page);
		quit(array($data,$data_pagination),1);
	}
	
	
?>