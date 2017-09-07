<?php
	include("include/routines.php");
	$uid 				= $_SESSION['panel_user']['id'];
	$utype				= $_SESSION['panel_user']['utype'];
	$tbl_users_owner	= $_SESSION['panel_user']['tbl_users_owner'];

	if((isset($obj->load_products)) == '1' && (isset($obj->load_products)))
	{
		
		
		echo json_encode($response_array);	
	}
?>
