<?php
include("include/routines.php");
$json = file_get_contents('php://input');
$obj = json_decode($json);
//var_dump($obj = json_decode($json));
$uid				= $_SESSION['panel_user']['id'];
$utype				= $_SESSION['panel_user']['utype'];



if((isset($obj->delete_req)) == "1" && isset($obj->delete_req))
{
	$response_array = array();		
	$ar_faq_id 		= $obj->batch;
	$del_flag 		= 0; 
	if(!empty($ar_faq_id))
	{
		foreach($ar_faq_id as $req_id)	
		{
				$sql_delete_req ="DELETE FROM tbl_product_request WHERE req_id ='".$req_id."' ";
				mysqli_query($db_con,$sql_delete_req) or die(mysqli_error($db_con));
		}
		
		$response_array = array("Success"=>"Success","resp"=>"Record Deletion Success.");
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Record Deletion failed.");
	}		
	echo json_encode($response_array);	
}



if((isset($obj->load_request)) == "1" && isset($obj->load_request))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= mysqli_real_escape_string($db_con,$obj->page);	
	$per_page		= mysqli_real_escape_string($db_con,$obj->row_limit);
	$search_text	= mysqli_real_escape_string($db_con,$obj->search_text);	
	$cat_parent		= mysqli_real_escape_string($db_con,$obj->cat_parent);		
	if($page != "" && $per_page != "")	
	{
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
			
		$sql_load_data  = " SELECT * FROM tbl_product_request as tpr ";
		$sql_load_data .= " INNER JOIN tbl_cadmin_users as tcu ON tpr.req_userid = tcu.id ";
		$sql_load_data .= "WHERE 1=1 ";
		$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
		$sql_load_data .=" ORDER BY req_id DESC LIMIT $start, $per_page ";
		$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
		if(strcmp($data_count,"0") !== 0)
		{		
			$req_data = "";			
			
			$req_data .= '<table id="tbl_user" class="table table-bordered dataTable" style="width:100%;text-align:center">';
    	 	$req_data .= '<thead>';
    	  	$req_data .= '<tr>';
         	$req_data .= '<th class="center-text">Sr No.</th>';
			$req_data .= '<th class="center-text">User Name</th>';
			$req_data .= '<th style="width:20%" class="center-text">Product Name</th>';
			$req_data .= '<th style="width:20%" class="center-text">Request Date</th>';
			
			
			$edit = checkFunctionalityRight("view_request.php",1);
			if($edit)
			{
				$req_data .= '<th class="center-text">Action</th>';
			}


			$del = checkFunctionalityRight("view_request.php",2);
			if($del)
			{
				$req_data .= '<th class="center-text">';
				$req_data .= '<div class="center-text">';
				$req_data .= '<input type="button"  value="Delete" onclick="multipleDelete();" class="btn-danger"/></div></th>';
			}
          	$req_data .= '</tr>';
      		$req_data .= '</thead>';
      		$req_data .= '<tbody>';
			while($row_load_data = mysqli_fetch_array($result_load_data))
			{
	    	  	$req_data .= '<tr>';				
				$req_data .= '<td class="center-text">'.++$start_offset.'</td>';				
				$req_data .= '<td class="center-text">'.$row_load_data['fullname'].'</td>';
				$req_data .= '<td class="center-text">
				'.$row_load_data['prod_name'].'</td>';
				$req_data .= '</td>';								
				$req_data .= '<td style="width:20%" class="center-text">';
				$req_data .= $row_load_data['req_created'];
				$req_data .= '</td>';
				
				
				$edit = checkFunctionalityRight("view_request.php",1);				
				if($edit)
				{
					$req_data .= '<td class="center-text">';

					$req_data .= '<a target="_blank" href="add_products.php?req_id='.$row_load_data['req_id'].'"><input type="button" value="Add Product"  class="btn-warning"></a>';
					
					$req_data .='</td>';
				}
				$del = checkFunctionalityRight("view_request.php",2);
				if($del)				
				{    
				  
					$req_data .= '<td>';
					
					$req_data .=' <div class="controls" align="center">';					
					$req_data .= '		<input type="checkbox" value="'.$row_load_data['req_id'].'" id="batch'.$row_load_data['req_id'].'" name="batch'.$row_load_data['req_id'].'" class="css-checkbox batch">';
					$req_data .= '		<label for="batch'.$row_load_data['req_id'].'" class="css-label"></label>';
					$req_data .= '	</div>';
					
					$req_data .= '	</td>';										
				}
	          	$req_data .= '</tr>';															
			}	
      		$req_data .= '</tbody>';
      		$req_data .= '</table>';	
			$req_data .= $data_count;
			$response_array = array("Success"=>"Success","resp"=>$req_data);					
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Data Available");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
	}
	echo json_encode($response_array);	
}


?>