<?php
	function insert($table, $variables = array() )
	{
				//Make sure the array isn't empty
		global $db_con;
		if( empty( $variables ) )
		{
			return false;
			exit;
		}
		
		$sql = "INSERT INTO ". $table;
		$fields = array();
		$values = array();
		foreach( $variables as $field => $value )
		{
			$fields[] = $field;
			$values[] = "'".$value."'";
		}
		$fields = ' (' . implode(', ', $fields) . ')';
		$values = '('. implode(', ', $values) .')';
		
		$sql .= $fields .' VALUES '. $values;
	
		$result		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
		
		if($result)
		{
			return mysqli_insert_id($db_con);
		}
		else
		{
			return false;
		}
	}
	
	function update($table, $variables = array(), $where,$not_where_array=array(),$and_like_array=array(),$or_like_array=array())
	{
		//Make sure the array isn't empty
		global $db_con;
		if( empty( $variables ) )
		{
			return false;
			exit;
		}
		
		$sql = "UPDATE ". $table .' SET ';
		$fields = array();
		$values = array();
		
		foreach($variables as $field => $value )
		{   
			$sql  .= $field ."='".$value."' ,";
		}
		$sql   =chop($sql,',');
		
		$sql .=" WHERE 1 = 1 ";
		//==Check Where Condtions=====//
		if(!empty($where))
		{
			foreach($where as $field1 => $value1 )
			{   
				$sql  .= " AND ".$field1 ."='".$value1."' ";
			}
		}
	
		$result 		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
		
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function checkExist($table ,$where)
	{
		global $db_con;
		if($table=="")
		{
			quit('Table name can not be blank');
		}
		$sql = " SELECT * FROM ". $table ;
		$fields = array();
		$values = array();
		
		
		$sql .=" WHERE 1 = 1 ";
		//==Check Where Condtions=====//
		if(!empty($where))
		{
			foreach($where as $field1 => $value1 )
			{   
				$sql  .= " AND ".$field1 ."='".$value1."' ";
			}
		}
		$result 		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
		$num            = mysqli_num_rows($result);
		if($num > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function quit($msg,$Success="")
	{
		if($Success ==1)
		{
			$Success="Success";
		}
		else
		{
			$Success="fail";
		}
		echo json_encode(array("Success"=>$Success,"resp"=>$msg));
		exit();
	}
?>