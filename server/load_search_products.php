<?php
	include("includes/db_con.php");
	include('includes/query-helper.php');
	
	
	//===================================================================================================================//
	//==========================Start : Load Products Dn BY satish======================================================//
	
	if((isset($obj->getProducts)) == '1' && (isset($obj->getProducts)))
	{
		$data ='';
		$sort_by				= array(0=>"",1=>" batch_created desc ",2=>"prod_price asc ",3=>" prod_price desc ");
		
		$sql            = " SELECT * FROM tbl_batches as tb ";
		$sql           .= " INNER JOIN tbl_products as tp ON tb.prod_id = tp.id";
		$sql           .= " INNER JOIN tbl_product_images as ti ON tp.id = ti.prod_id";
		$sql           .= " WHERE tp.prod_status=1 AND tb.batch_status=1";
		$sql           .= " GROUP BY batch_id";
		
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
			
			$data .=' <tr>     
						<td data-title="Product">
							<a href="'.$BaseFolder.'/'.$row['prod_slug'].'-'.$row['batch_id'].'-a">'.ucwords($row['prod_name']).'</a>
							<p><i>Brand Name</i></p>
						</td>
						<td data-title="Price">Rs. '.$row['prod_price'].'</td>
						<td data-title="Seller Location">Mumbai, MH</td>
						<td data-title="View Details"><a href="'.$BaseFolder.'/'.$row['prod_slug'].'-'.$row['batch_id'].'-a" class="le-button small">Details</a></td>
					</tr>';
			
			
		}
		
		quit($data,1);
	}
	
	
?>