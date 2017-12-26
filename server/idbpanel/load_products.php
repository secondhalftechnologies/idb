<?php
	include("include/routines.php");
	//include("include/query-helper.php");
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
				
			$sql_load_data  = " SELECT * FROM tbl_products";			
			

			
			if($excel == 1)
			{
				
				$response_array	 = exportToXlsx($sql_load_data);
				//echo json_encode($response_array);exit();
			}
			else
			{	
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
				$prod_data .= '<th class="center-text">Prod Id</th>';
				$prod_data .= '<th class="center-text">Model Number</th>';	
				$prod_data .= '<th class="center-text" style="width:15%;">Product Name</th>';
				$prod_data .= '<th class="center-text" style="width:15%;">Images</th>';
				$dis = checkFunctionalityRight("view_products.php",3);
				if($dis)
				{					
					$prod_data .= '<th class="center-text">Status</th>';						
				}
				$edit = checkFunctionalityRight("view_products.php",1);
				$edit = 1;
				if($edit)
				{			
					$prod_data .= '<th class="center-text">Edit</th>';			
				}
				$del = checkFunctionalityRight("view_products.php",2);
				$del = 1;
				if($del)
				{			
					$prod_data .= '<th class="center-text"><div class="center-text">
					<input type="button"  value="Delete" onclick="deleteProductSpecification();" class="btn-danger"/></div></th>';
				}			
	          	$prod_data .= '</tr>';
	      		$prod_data .= '</thead>';
	      		$prod_data .= '<tbody>';
				$i=1;
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
					$prod_data .= '<tr>';
					$prod_data .= '<td class="center-text">'.$i++.'</td>';
					$prod_data .= '<td class="center-text">'.$row_load_data['id'].'</td>';
					$prod_data .= '<td class="center-text">'.$row_load_data['prod_id'].'</td>';			
					$prod_data .= '<td class="center-text" style="width:15%;"><a href="view_product_detail.php?pag=Products&product_id='.$row_load_data['id'].'">'.ucwords($row_load_data['prod_name']).'</a></td>';
					$prod_data .= '<td class="center-text">';
						$prod_data .= '<input type="button" value="Images" id="img'.$row_load_data['id'].'" class="btn-warning" onclick="viewImages('.$row_load_data['id'].');"></td>';
					$dis = checkFunctionalityRight("view_products.php",3);
					if($dis)
					{					
						$prod_data .= '<td class="center-text">';	

						if($row_load_data['prod_status'] == 1)
						{
							$prod_data .= '<input type="button" value="Active" id="'.$row_load_data['id'].'" class="btn-success" onclick="changeStatus(this.id,0)">';
						}
						else
						{
							$prod_data .= '<input type="button" value="Inactive" id="'.$row_load_data['id'].'" class="btn-danger" onclick="changeStatus(this.id,1);">';
						}
						$prod_data .= '</td>';	
					}
					$edit = checkFunctionalityRight("view_products.php",1);
					$edit = 1;
					if($edit)
					{				
						$prod_data .= '<td class="center-text">';
						$prod_data .= '
						<a class="btn-warning" style="color:white" href="edit_product_detail.php?pag=Products&product_id='.$row_load_data['id'].'">Edit</a>
						</td>';				
					}
					$del = checkFunctionalityRight("view_products.php",2);
					$del = 1;
					if($del)
					{					
						$prod_data .= '<td><div class="center-text">';
						$prod_data .= '<input type="checkbox" value="'.$row_load_data['id'].'" id="batch_prod_spec'.$row_load_data['id'].'" name="batch_prod_spec'.$row_load_data['id'].'" class="css-checkbox batch_prod_spec">';
						$prod_data .= '<label for="batch_prod_spec'.$row_load_data['id'].'" class="css-label"></label>';				
						$prod_data .= '</div></td>';										
					}			
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
		$prod_id = 200000;

		$prod_type                   = mysqli_real_escape_string($db_con,$_POST['txt_type']);
		if($prod_type=='')
		{
			quit('Plesae Select Type');
		}

        $sql_get_id = " SELECT prod_id,id FROM tbl_products ORDER BY id DESC LIMIT 1";
        $res_get_id = mysqli_query($db_con,$sql_get_id) or dir(mysqli_error($db_con));	
        $row_get_id = mysqli_fetch_array($res_get_id);
        $data['prod_name'] = mysqli_real_escape_string($db_con,$_POST['prod_name']);
        $data['prod_slug'] = getSlug($data['prod_name']);
		$data['prod_type'] = $prod_type;
		

 		if(!isExist('tbl_products' ,array('prod_name'=>$data['prod_name'],'prod_slug'=>$data['prod_slug'])))
 		{
			
			$data['prod_handling'] 		   = mysqli_real_escape_string($db_con,$_POST['prod_handling']);
			$data['prod_cat']              = mysqli_real_escape_string($db_con,$_POST['txt_cat']);
			$data['prod_id']               = 'SKU'.($prod_id+$row_get_id['id']);
			
			$data['prod_comp_cat']         = mysqli_real_escape_string($db_con,$_POST['txt_cmp_cat']);
			$data['prod_pharmacopia']      = mysqli_real_escape_string($db_con,$_POST['txt_pharmacopia']);
	        $data['prod_tax']              = mysqli_real_escape_string($db_con,$_POST['txt_tax']);

	        $data['prod_dimension_l']      = mysqli_real_escape_string($db_con,$_POST['txt_dimensionl']);
	        $data['prod_dimension_h']      = mysqli_real_escape_string($db_con,$_POST['txt_dimensionh']);
	        $data['prod_dimension_w']      = mysqli_real_escape_string($db_con,$_POST['txt_dimensionw']);
			
			$data['prod_nett_weight']      = mysqli_real_escape_string($db_con,$_POST['txt_nweight']);
	        $data['prod_gross_weight']     = mysqli_real_escape_string($db_con,$_POST['txt_gweight']);
	        $data['prod_unit_weight']      = mysqli_real_escape_string($db_con,$_POST['txt_uoweight']);

	        $data['prod_packing']          = mysqli_real_escape_string($db_con,$_POST['txt_packing']);
	        $data['prod_manufactured']     = mysqli_real_escape_string($db_con,$_POST['txt_manufactured']);
	        $data['prod_manufactured_number']  = mysqli_real_escape_string($db_con,$_POST['txt_manufactured_lic']);
	        $data['prod_meta_tags']        = mysqli_real_escape_string($db_con,$_POST['txt_meta']);
			$data['prod_commission']        = mysqli_real_escape_string($db_con,$_POST['txt_commission']);
			
	       
	        $data['prod_insurance']        = mysqli_real_escape_string($db_con,$_POST['txt_insurance']);
	        $data['prod_status']          = mysqli_real_escape_string($db_con,$_POST['txt_status']);
	        $data['prod_factor'] 		   = mysqli_real_escape_string($db_con,$_POST['txt_factor']);
			if($prod_type=='raw')
			{
				
			}
			else
			{
				$data['prod_effective_pack']   = mysqli_real_escape_string($db_con,$_POST['txt_cost_effective_pack']);
				$data['prod_standard_pack']     = mysqli_real_escape_string($db_con,$_POST['txt_stadard_pack']);
				$data['prod_shipper']          = mysqli_real_escape_string($db_con,$_POST['txt_shipper']);
				$data['prod_ean']              = mysqli_real_escape_string($db_con,$_POST['txt_ean']);
	            $data['prod_hsn']              = mysqli_real_escape_string($db_con,$_POST['txt_hsn']);
			}
			
			//=====To Check Composition TYpe=================
			$prod_comp_array           = array();
			if($data['prod_comp_cat'] !="Combination")
			{
				array_push($prod_comp_array,$_POST['txt_cmp']);
			}
			else
			{
				$prod_comp_array= $_POST['txt_cmp_type'];
			}

		

			//=====To Check n upload DMF Document
			if(isset($_FILES['img_dmf']) && $_FILES['img_dmf']['name'] !='')
			{
		        $dmf_size      = $_FILES['img_dmf']['size'];
				if($dmf_size > 5242880 &&  $dmf_size !=0) // file size
				{
					quit('Image size should be less than 5 MB');
				}
				
				$dmf_img               = explode('.',$_FILES['img_dmf']['name']);
				$dmf_img               = date('dhyhis').'.'.$dmf_img[1];
				
				
				$dir                          = 'documents/dmf/'.$dmf_img;
				
				if(move_uploaded_file($_FILES['img_dmf']['tmp_name'],$dir))
				{
					$data['prod_dmf']      = $dmf_img;
				}
				else
				{
					quit('DMF Document not uploaded.!');
				}
			}


            if($utype !=1)
			{
				$data['prod_status'] = 2;
			}
			
      		
			$res = insert('tbl_products',$data);


			$prod_attributes        = $_POST['txt_attribute'];
			foreach($prod_attributes as $prod_attribute)
			{
				insert('tbl_product_attributes',array('product_id'=>$res,'attribute_id'=>$prod_attribute));
			}

			$prod_attributes        = $_POST['txt_attribute'];
			foreach($prod_comp_array as $composition_id)
			{
				insert('tbl_product_compositions',array('product_id'=>$res,'composition_id'=>$composition_id));
			}
			
			
			$dir 		= "../images/products/";
			$prod_dir   = $dir.'prodid_' .$res;
			if(is_dir($prod_dir) === false)
			{
				mkdir($prod_dir);
			}
			$sprod_dir = $prod_dir.'/small';
			if(is_dir($sprod_dir) === false)
			{
				mkdir($sprod_dir);
			}
			
			$mprod_dir = $prod_dir.'/medium';
			if(is_dir($mprod_dir) === false)
			{
				mkdir($mprod_dir);
			}
			
			$lprod_dir = $prod_dir.'/large';
			if(is_dir($lprod_dir) === false)
			{
				mkdir($lprod_dir);
			}
			
			$img_order = 1;
			for($j=0;$j<count($_FILES["prod_img"]["tmp_name"]);$j++)
            {
				$temp_file    = $prod_dir."/".$_FILES["prod_img"]["name"][$j];
				
				$file_name    = explode('.',$_FILES["prod_img"]["name"][$j]);
				$file_name    = date('dmyhis').$img_order.$res.'.'.$file_name[1];
				
				if(move_uploaded_file($_FILES["prod_img"]["tmp_name"][$j],$temp_file))
				{
					make_thumb($temp_file,$sprod_dir.'/'.$file_name,100,100);	
					make_thumb($temp_file,$mprod_dir.'/'.$file_name,300,300);	
					make_thumb($temp_file,$lprod_dir.'/'.$file_name,500,500);	
				}
				
				$idata['prod_id']        	= $res;
				$idata['image_name']        = $file_name;
				$idata['image_status']      = 1;
				$idata['image_order']       = $img_order;
				$idata['image_created']     = $datetime;
				$idata['image_created_by']  = $uid;
				insert('tbl_product_images',$idata);
				
				$img_order++;
				unlink($temp_file);
			}
			
			if($res)
			{
				quit('Product Added Successfully.!',1);
			}
			else
			{
				quit('Something went wrong..!');
			}
		}
		else
		{
			quit('Product Name already Exist...!');
		}
	}
	
	if((isset($obj->getCat)) == '1' && (isset($obj->getCat)))
	{
		$cat_id  = $obj->cat_id;
		
		$sql_get_cats	= " SELECT * FROM `tbl_category` ";
		$sql_get_cats	.= " WHERE `cat_status`='1' ";
		$sql_get_cats	.= " 	AND `cat_name`!='none' ";
		$sql_get_cats	.= " 	AND `cat_type`='parent' ";
		$sql_get_cats	.= " 	AND `cat_id`='".$cat_id."' ";
		$sql_get_cats	.= " ORDER BY `cat_name` ASC ";
		$res_get_cats	= mysqli_query($db_con, $sql_get_cats) or die(mysqli_error($db_con));
		$num_get_cats	= mysqli_num_rows($res_get_cats);
		
		$data = '';
		if($num_get_cats != 0)
		{
			
			$data .='<option  value="">Select Sub Category</option>';
		
			while($row_get_cats = mysqli_fetch_array($res_get_cats))
			{
			
				//     $data .='<option value="'.$row_get_cats['cat_id'].'">';
				// 	$data .=ucwords($row_get_cats['cat_name']);
				// 	$data .='</option>';
				
				$data.= getSubCatValue($row_get_cats['cat_id'], 'add');
			}
		}
		else
		{
			
			$data .='<option value="">No Match Found</option>';
			
		}
		
		quit($data,1);
	}
	
	if((isset($obj->getPacking)) == '1' && (isset($obj->getPacking)))
	{
		$cat_id  = $obj->cat_id;
		$sql_get_cats	= " SELECT * FROM `tbl_packing` ";
		$sql_get_cats	.= " WHERE `status`='1' ";
		$sql_get_cats	.= " 	AND `cat_id`='".$cat_id."' ";
		$sql_get_cats	.= " ORDER BY `packing_name` ASC ";
		$res_get_cats	= mysqli_query($db_con, $sql_get_cats) or die(mysqli_error($db_con));
		$num_get_cats	= mysqli_num_rows($res_get_cats);
		
		$data = '';
		if($num_get_cats != 0)
		{
			$data .='<option  value="">Select Category</option>';
			while($row_get_cats = mysqli_fetch_array($res_get_cats))
			{
				$data .='<option value="'.$row_get_cats['id'].'">';
				$data .=ucwords($row_get_cats['packing_name']);
				$data .='</option>';
			}
		}
		else
		{
			$data .='<option value="">No Match Found</option>';
		}
		
		quit($data,1);
	}
	if((isset($obj->getFactor)) == '1' && (isset($obj->getFactor)))
	{
		$cat_id  = $obj->cat_id;
		$sql_get_cats	= " SELECT * FROM `tbl_form_factor` ";
		$sql_get_cats	.= " WHERE `status`='1' ";
		$sql_get_cats	.= " 	AND `cat_id`='".$cat_id."' ";
		$sql_get_cats	.= " ORDER BY `form_factor_name` ASC ";
		$res_get_cats	= mysqli_query($db_con, $sql_get_cats) or die(mysqli_error($db_con));
		$num_get_cats	= mysqli_num_rows($res_get_cats);
		
		$data = '';
		if($num_get_cats != 0)
		{
			$data .='<option  value="">Select Category</option>';
			while($row_get_cats = mysqli_fetch_array($res_get_cats))
			{
				$data .='<option value="'.$row_get_cats['id'].'">';
				$data .=ucwords($row_get_cats['form_factor_name']);
				$data .='</option>';
			}
		}
		else
		{
			$data .='<option value="">No Match Found</option>';
		}
		
		quit($data,1);
	}
	
	if((isset($obj->changeStatus)) == '1' && (isset($obj->changeStatus)))
	{
		$prod_id        = $obj->prod_id;
		$status         = $obj->curr_status;
		
		$sql_update_status = " UPDATE tbl_products SET prod_status='".$status."' WHERE id ='".$prod_id."'";
		$res_update_status = mysqli_query($db_con,$sql_update_status) or die(mysqli_error($db_con));
		if($res_update_status)
		{
			$response_array  =   array('Success'=>'Success','resp'=>$sql_update_status);
		}
		else
		{
			$response_array  =   array('Success'=>'fail','resp'=>'');
		}
		
		echo json_encode($response_array);exit();
	}
	
	if((isset($obj->getApplication)) == '1' && (isset($obj->getApplication)))
	{
		$cat_id  = $obj->cat_id;
		
		$sql_get_cats	= " SELECT * FROM `tbl_attribute` ";
		$sql_get_cats	.= " WHERE `status`='1' ";
		$sql_get_cats	.= " 	AND `cat_id`='".$cat_id."' ";
		$sql_get_cats	.= " ORDER BY `attribute_name` ASC ";
		$res_get_cats	= mysqli_query($db_con, $sql_get_cats) or die(mysqli_error($db_con));
		$num_get_cats	= mysqli_num_rows($res_get_cats);
		
		$data = '';
		if($num_get_cats != 0)
		{
			$data .='<option  value="">Select Category</option>';
			while($row_get_cats = mysqli_fetch_array($res_get_cats))
			{
				$data .='<option value="'.$row_get_cats['id'].'">';
				$data .=ucwords($row_get_cats['attribute_name']);
				$data .='</option>';
			}
		}
		else
		{
			$data .='<option value="">No Match Found</option>';
		}
		
		quit($data,1);
	}
	
	
	if((isset($obj->getImages)) == '1' && (isset($obj->getImages)))
	{
		$prod_id  = $obj->prod_id;
		$data       ='';
		$data  	   .='<input type="hidden" name="prod_id" id="prod_id" value="'.$prod_id.'">';
		$data .='<input type="hidden" name="addImage" id="addImage" value="1">';
		$data .='<div style="padding:15px;text-align:center">';
		
		$data .= '<input  id="" name="prod_img[]" class="" data-rule-required="true"  type="file" multiple="multiple" accept="image/*" />';
		
		$data .= '<input value="Add Image" id="" class="btn-success"  type="submit">';
		
		$data .= '</div> ';
		
		$sql_get_image  = " SELECT tpi.*,(SELECT fullname FROM tbl_cadmin_users WHERE id=tpi.image_created_by) as created_name,(SELECT fullname FROM tbl_cadmin_users WHERE id=tpi.image_modified_by) as modified_name FROM tbl_product_images  tpi";
		$sql_get_image .= " WHERE  1=1 AND ";
		$sql_get_image .= "  prod_id='".$prod_id."'";
		$res_get_image  = mysqli_query($db_con,$sql_get_image) or die(mysqli_error($db_con));
		
		if(mysqli_num_rows($res_get_image)!=0)
		{
		
			$data .= '<table id="tbl_user" class="table table-bordered dataTable" style="width:100%;text-align:center">';
			$data .= '<thead>';
			$data .= '<tr>';
			$data .= '<th style="text-align:center">Sr No.</th>';
			$data .= '<th style="text-align:center">Image</th>';
			$data .= '<th style="text-align:center">Sort Order</th>';
			
			$data .= '<th style="text-align:center">Created Date</th>';
			$data .= '<th style="text-align:center">Created By</th>';
			$data .= '<th style="text-align:center">Modified Date</th>';
				$data .= '<th style="text-align:center">Modified By</th>';
			$data .= '<th style="text-align:center">Status</th>';
			$delete = checkFunctionalityRight("view_products.php",2);
			if($delete)
			{			
				$data .= '<th style="text-align:center">
				<div style="text-align:center">';
				$data .= '<input type="button"  value="Delete" onclick="multipleImageDelete('.$prod_id.');" class="btn-danger"/>
				</div></th>';
			}
			
			$data .= '</tr>';
			$data .= '</thead>';
			$data .= '<tbody>';
			
			while($row_load_data = mysqli_fetch_array($res_get_image))
			{
				$data .= '<tr>';				
				$data .= '<td style="text-align:center">'.++$start_offset.'</td>';				
				$data .= '<td style="text-align:center">
				<img width="100px" height="100px" src="../images/products/prodid_'.$row_load_data['prod_id'].'/small/'.$row_load_data['image_name'].'" /></td>';
				$data .= '<td class="center-text">';
				$data .= '<input type="text" style="text-align:center;width:50%" onblur="changeImageOrder('.$prod_id.',this.id,this.value)" id="'.$row_load_data['image_id'].'" value="'.$row_load_data['image_order'].'">';
				$data .= '</td>';
				$data .= '<td style="text-align:center">'.$row_load_data['image_created'].'</td>';				
				$data .= '<td style="text-align:center">'.ucwords($row_load_data['created_name']).'</td>';		
				$data .= '<td style="text-align:center">'.$row_load_data['image_modified'].'</td>';
				$data .= '<td style="text-align:center">'.ucwords($row_load_data['modified_name']).'</td>';		
				
				$data .= '<td class="center-text">';	
				if($row_load_data['image_status'] == 1)
				{
					$data .= '<input type="button" value="Active" id="'.$row_load_data['image_id'].'" class="btn-success" onclick="changeImageStatus('.$prod_id.',this.id,0);">';
				}
				else
				{
					$data .= '<input type="button" value="Inactive" id="'.$row_load_data['image_id'].'" class="btn-danger" onclick="changeImageStatus('.$prod_id.',this.id,1);">';
				}
				$data .= '</td>';	
				$delete = checkFunctionalityRight("view_products.php",2);
				if($delete)
				{					
					$data .= '<td><div class="controls" align="center">';
					$data .= '<input type="checkbox" value="'.$row_load_data['image_id'].'" id="image_batch'.$row_load_data['image_id'].'" name="student_batch'.$row_load_data['image_id'].'" class="css-checkbox image_batch">';
					$data .= '<label for="image_batch'.$row_load_data['image_id'].'" class="css-label"></label>';
					$data .= '</div></td>';		
											
				}
				$data .= '</tr>';															
			}	
			$data .= '</tbody>';
			$data .= '</table>';
		}
		
		quit(array($data,ucwords($row_get_team['batch_name'])),1);

	}
	
	
	if(isset($_POST['addImage']) && $_POST['addImage']==1)
	{
		$prod_id  = $_POST['prod_id'];
		$files    = $_FILES['prod_img']["tmp_name"];
		
		if(isset($files))
		{
			$dir 		= "../images/products/";
			$prod_dir   = $dir.'prodid_' .$prod_id;
			if(is_dir($prod_dir) === false)
			{
				mkdir($prod_dir);
			}
			$sprod_dir = $prod_dir.'/small';
			if(is_dir($sprod_dir) === false)
			{
				mkdir($sprod_dir);
			}
			
			$mprod_dir = $prod_dir.'/medium';
			if(is_dir($mprod_dir) === false)
			{
				mkdir($mprod_dir);
			}
			
			$lprod_dir = $prod_dir.'/large';
			if(is_dir($lprod_dir) === false)
			{
				mkdir($lprod_dir);
			}
			
			$sql_get_order =" SELECT image_order FROM tbl_product_images WHERE prod_id='".$prod_id."' ORDER BY image_order DESC  LIMIT 1";
			$res_get_order = mysqli_query($db_con,$sql_get_order) or die(mysqli_error($db_con));
			$row_get_order = mysqli_fetch_array($res_get_order);
			$img_order     = $row_get_order['image_order'] + 1;
			for($j=0;$j<count($files);$j++)
			{
				$temp_file    = $prod_dir."/".$_FILES["prod_img"]["name"][$j];
				
				$file_name    = explode('.',$_FILES["prod_img"]["name"][$j]);
				$file_name    = date('dmyhis').$img_order.$prod_id.'.'.$file_name[1];
				
				if(move_uploaded_file($_FILES["prod_img"]["tmp_name"][$j],$temp_file))
				{
					make_thumb($temp_file,$sprod_dir.'/'.$file_name,100,100);	
					make_thumb($temp_file,$mprod_dir.'/'.$file_name,300,300);	
					make_thumb($temp_file,$lprod_dir.'/'.$file_name,500,500);	
				}
				
				$idata['prod_id']        	= $prod_id;
				$idata['image_name']        = $file_name;
				$idata['image_status']      = 1;
				$idata['image_order']       = $img_order;
				$idata['image_created']     = $datetime;
				$idata['image_created_by']  = $uid;
				insert('tbl_product_images',$idata);
				
				$img_order++;
				unlink($temp_file);
			}
			
			quit(array('Images added Successfully...!',$prod_id),1);
		}
		else
		{
			quit('Please select file');
		}
	}
	
	
	if(isset($obj->deleteImage)  && $obj->deleteImage ==1)
	{
		$batch   = $obj->batch;
		$prod_id = $obj->prod_id;
		
		foreach($batch as $image_id)
		{
			$irow = checkExist('tbl_product_images' ,array('image_id'=>$image_id));
			unlink('../images/products/prodid_'.$prod_id.'/small/'.$irow['image_name']);
			unlink('../images/products/prodid_'.$prod_id.'/medium/'.$irow['image_name']);
			unlink('../images/products/prodid_'.$prod_id.'/large/'.$irow['image_name']);
			delete('tbl_product_images' ,array('image_id'=>$image_id));
		}
		
		quit('Images Deleted Successfully',1);
	}
	
	
	if(isset($obj->changeImageStatus)  && $obj->changeImageStatus ==1)
	{
		$curr_status   = $obj->curr_status;
		$image_id 	   = $obj->image_id;
		$prod_id       = $obj->prod_id;
		
		$data['image_status']      = $curr_status;
		$data['image_modified']	   = $datetime;
		$data['image_modified_by'] = $uid;
		$res 		   = update('tbl_product_images',$data,array('image_id'=>$image_id));
		quit(1,1);
	}
	
	if(isset($obj->changeImageOrder)  && $obj->changeImageOrder ==1)
	{
		$new_order     = $obj->curr_order;
		$image_id 	   = $obj->image_id;
		$prod_id       = $obj->prod_id;
		
		$sql_check_self_order	= " SELECT * from tbl_product_images WHERE image_id LIKE '".$image_id."' ";
		$result_check_self_order= mysqli_query($db_con,$sql_check_self_order) or die(mysqli_error($db_con));	
		$row_check_self_order	= mysqli_fetch_array($result_check_self_order);
		
		
	}
?>
