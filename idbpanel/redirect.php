<?php
include("include/routines.php");
if(isset($_SESSION['front_panel']))
{
	
	$vendor_id			= $_SESSION['front_panel']['cust_vendorid'];
	$sql 				=" SELECT * FROM tbl_vendor WHERE vendor_id='".$vendor_id."' AND vendor_status = 1";
	$res 				=  mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
	if(mysqli_num_rows($res)==1)
	{
    	$prow = mysqli_fetch_array($res);
		$sql 				=" SELECT * FROM tbl_cadmin_users WHERE email='".$prow['vendor_email']."' AND status = 1";
	    $res 				=  mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
		$crow				= mysqli_fetch_array($res);
		
		$_SESSION['panel_user'] = $crow;?>
         <script type="text/javascript">
       		 window.location.href="view_dashboard.php?pag=Dashboard";
        </script>
        <?php 
	}   
	else
	 {?>
     <script type="text/javascript">
	 alert('You don\'t have an access');
		history.go(-1);
	</script>
<?php }
	
	
}
else
{?>
	
    <script type="text/javascript">
		history.go(-1);
	</script>
<?php
}

?>