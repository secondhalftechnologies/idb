<?php
	function generateRandomString($length, $type) 
	{
		if($type != '')
		{
			if($type == 'mobile')
			{
				$characters = '0123456789';
			}
			elseif($type == 'email')
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	
			}
			
			$randomString = '';
			for ($i = 0; $i < $length; $i++) 
			{
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;	
		}
		else
		{
			return 'Type is required';	
		}		
	}
	
	function randomString($query,$length,$type)
	{
		global $db_con;
		$random_string = generateRandomString($length, $type);
		
		if($random_string != "")
		{
			$sql_check_string		= $query;
			$result_check_string 	= mysqli_query($db_con,$sql_check_string) or die(mysqli_error($db_con));
			$num_rows_check_string 	= mysqli_num_rows($result_check_string); 
			if($num_rows_check_string == 0)
			{
				return $random_string;
			}
			else
			{
				randomString($query,$col_name,$length);
			}
		}
		else
		{
			randomString($query,$col_name,$length);
		}
	}
?>