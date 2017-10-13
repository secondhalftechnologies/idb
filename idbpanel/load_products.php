<?php
	include("include/routines.php");
	$uid 				= $_SESSION['panel_user']['id'];
	$utype				= $_SESSION['panel_user']['utype'];
	$tbl_users_owner	= $_SESSION['panel_user']['tbl_users_owner'];

	if((isset($obj->load_products)) == '1' && (isset($obj->load_products)))
	{
		
	$response_array	 				= array();	
	$start_offset   				= 0;
	
	$page 							= $obj->page;	
	$per_page						= $obj->row_limit;
	$search_text					= $obj->search_text_prod;
	
	
	
	if($page != "" && $per_page != "")	
	{
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
			
		$sql_load_data  = " SELECT * FROM tbl_products_master";			
		

		
		if($excel == 1)
		{
			
			$response_array	 = exportToXlsx($sql_load_data);
			//echo json_encode($response_array);exit();
		}
		else
		{	
			//$response_array = array("Success"=>"fail","resp"=>$sql_load_data);
			//echo json_encode($response_array);	
			//exit();
						
			$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);	
			//========Strat : for go to option 16052017 by satish==///
			$no_of_page = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));
			$no_of_page =mysqli_num_rows($no_of_page);
			$no_of_page =$no_of_page/$per_page;
			//========End for go to option 16052017 by satish==///
			
			
			$sql_load_data .=" ORDER by prod_created DESC LIMIT $start, $per_page ";//ORDER by prod_id DESC
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			if(strcmp($data_count,"0") !== 0)
			{		
			$prod_data = "";	
			$prod_data .= '<table id="tbl_user" class="table table-bordered dataTable">';
    	 	$prod_data .= '<thead>';
    	  	$prod_data .= '<tr>';
         	$prod_data .= '<th class="center-text">Sr. No.</th>';
			$prod_data .= '<th class="center-text">Prod id</th>';
			$prod_data .= '<th class="center-text">Model Number</th>';			
			$prod_data .= '<th class="center-text" style="width:15%;">Product Name</th>';
						
          	$prod_data .= '</tr>';
      		$prod_data .= '</thead>';
      		$prod_data .= '<tbody>';
			$i=1;
			while($row_load_data = mysqli_fetch_array($result_load_data))
			{
				$prod_data .= '<tr>';
				$prod_data .= '<td class="center-text">'.$i++.'</td>';
				$prod_data .= '<td class="center-text">'.$row_load_data['prod_id'].'</td>';
				$prod_data .= '<td class="center-text">'.$row_load_data['prod_model_number'].'</td>';			
				$prod_data .= '<td class="center-text" style="width:15%;">'.$row_load_data['prod_name'].'</td>';
							
				$prod_data .= '</tr>';	
			}	
      		$prod_data .= '</tbody>';
      		$prod_data .= '</table>';	
			$prod_data .= $data_count;
			$response_array = array("Success"=>"Success","resp"=>utf8_encode($prod_data),"query"=>$sql_load_data,"no_of_page"=>$no_of_page);					
		}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"No Data Available","Query"=>$sql_load_data);
			}
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified for Products");
	}
	echo json_encode($response_array);	
}
	
	if((isset($_POST['add_product_req'])) == '1' && (isset($_POST['add_product_req'])))
	{
		$data['prod_name']          = mysqli_real_escape_string($db_con,$_POST['prod_name']);
		$data['prod_model_number']  = mysqli_real_escape_string($db_con,$_POST['prod_model_number']);
		$data['prod_factor'] 		= mysqli_real_escape_string($db_con,$_POST['txt_factor']);
		$data['prod_pharmacopia']   = mysqli_real_escape_string($db_con,$_POST['txt_pharmacopia']);
		$data['prod_drug_type']     = mysqli_real_escape_string($db_con,$_POST['txt_drug_type']);
		$data['prod_composition']   = mysqli_real_escape_string($db_con,$_POST['txt_cmp']);
		if($data['prod_drug_type']=="Single")
		{
			$data['prod_composition']   = mysqli_real_escape_string($db_con,$_POST['txt_cmp']);
		}
		else
		{
			$data['prod_composition']   = implode('1',mysqli_real_escape_string($db_con,$_POST['txt_cmp']));
		}
		
		$data['prod_brandid']    = mysqli_real_escape_string($db_con,$_POST['txt_brand']);
		$data['prod_tax_class']  = mysqli_real_escape_string($db_con,$_POST['txt_tax']);
		$data['prod_packing']    = mysqli_real_escape_string($db_con,$_POST['txt_packing']);
		$data['prod_dimension']  = mysqli_real_escape_string($db_con,$_POST['txt_dimension']);
		$data['prod_uow']  		 = mysqli_real_escape_string($db_con,$_POST['txt_weight']);
		$data['prod_available_pack']  = mysqli_real_escape_string($db_con,$_POST['txt_avai_pack']);
		$data['prod_status']     = mysqli_real_escape_string($db_con,$_POST['prod_status']);
		$data['prod_created_by'] = $logged_uid;
		$data['prod_created']    = $datetime;
		
		if(!isExist('tbl_products_master',array('prod_model_number'=>$data['prod_model_number'])))
		{
			if($data['prod_model_number']!="")
			{
				$res = insert('tbl_products_master',$data);
			
				if($res)
				{
					quit('Product Added Successfully...!','1');
				}
				else
				{
					quit('Please try letter...!');
				}
			}
			else
			{
				quit('Model Number required...!');
			}
		}
		else
		{
			quit('Model Number already exist...!');
		}
	}
	
?>
