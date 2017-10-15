<?php
include("include/routines.php");
checkuser();
chkRights(basename($_SERVER['PHP_SELF']));

// This is for dynamic title, bread crum, etc.
$title = "View Category";
$path_parts   		= pathinfo(__FILE__);
$filename 	  		= $path_parts['filename'].".php";
$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
$row_feature  		= mysqli_fetch_row($result_feature);
$feature_name 		= $row_feature[1];
$home_name    		= "Home";
$home_url 	  		= "view_faq.php?pag=Dashboard";
$utype				= $_SESSION['panel_user']['utype'];
$tbl_users_owner 	= $_SESSION['panel_user']['tbl_users_owner'];
?>
<!doctype html>
<html>
<head>	
<?php 
	/* This function used to call all header data like css files and links */
	headerdata($feature_name);
	/* This function used to call all header data like css files and links */	
?>
</head>
<body  class="<?php echo $theme_name;?>" data-theme="<?php echo $theme_name;?>" >
	<?php 
	/*include Bootstrap model pop up for error display*/
	modelPopUp();
	/*include Bootstrap model pop up for error display*/	
	/* this function used to add navigation menu to the page*/ 
	navigation_menu();
	/* this function used to add navigation menu to the page*/  
	?> <!-- Navigation Bar --> 
    <div class="container-fluid" id="content">
		<div id="main" style="margin-left:0px !important">
        	<div class="container-fluid" id="div_view_cat">                
				<?php 
                /* this function used to add navigation menu to the page*/ 
                breadcrumbs($home_url,$home_name,'View Requests',$filename,$feature_name); 
                /* this function used to add navigation menu to the page*/ 
                ?>          
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered">
                            <div class="box-title">
                                <h3>
                                    <i class="icon-table"></i>
                                    <?php echo $feature_name; ?>
                                </h3>
                               
                            </div> <!-- header title-->
                            <div class="box-content nopadding">
                            
                            <div style="padding:10px 15px 10px 15px !important">
                                <input type="hidden" name="hid_page" id="hid_page" value="1">
                                <input type="hidden" name="cat_parent" id="cat_parent" value="parent">
                                <select name="rowlimit" id="rowlimit" onChange="loadData();"  class = "select2-me">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries per page
                                <input type="text" class="input-medium" id = "srch" name="srch" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
                            </div>
                            <div id="req_resp"></div>
                            <div class="profileGallery">
                                <div style="width:99%;" align="center">
                                    <div id="loading"></div>                                            
                                    <div id="container1" class="data_container">
                                        <div class="data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                       
                    </div>
                </div>
            </div>
                         
		</div>
	</div>
</div>     
        <?php getloder();?>
        <script type="text/javascript">
		
		
		function multipleDelete()
		{			
			loading_show();		
			var batch = [];
			$(".batch:checked").each(function ()
			{
				batch.push(parseInt($(this).val()));
			});
			if (typeof batch.length == 0)
			{
				$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
				$('#error_model').modal('toggle');	
				loading_hide();		
			}
			else
			{
				delete_req 	= 1;
				var sendInfo 	= {"batch":batch, "delete_req":delete_req};
				var del_cat 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_request.php?",
					type: "POST",
					data: del_cat,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{	
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{						
							loadData();
							loading_hide();
						} 
						else
						{
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
							$('#error_model').modal('toggle');													
							loading_hide();						
							$('#srch').val("");							
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
						loading_hide();
					},
					complete: function()
					{
					}
			    });					
			}
		}
		
		function loadData()
		{
			loading_show();
			
			
			row_limit = $.trim($('select[name="rowlimit"]').val());
			search_text = $.trim($('#srch').val());
			page = $.trim($("#hid_page").val());
			
			load_request = "1";			
			if(row_limit == "" && page == "")
			{
				$("#model_body").html('<span style="style="color:#F00;">Can not Get Row Limit and Page number</span>');	
				$('#error_model').modal('toggle');	
				loading_hide();
			}
			else
			{
				var sendInfo 		= {"row_limit":row_limit, "search_text":search_text, "load_request":load_request, "page":page};
				var cat_load = JSON.stringify(sendInfo);				
				$.ajax({
					url: "load_request.php?",
					type: "POST",
					data: cat_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
							$("#container1").html(data.resp);
							loading_hide();
						} 
						else if(data.Success == "fail") 
						{
							$("#container1").html('<span style="style="color:#F00;">'+data.resp+'</span>');														
							loading_hide();
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
						loading_hide();
					},
					complete: function()
					{
						loading_hide();
						//alert("complete");
					}
			    });
			}
		}		
		
		
		
		$( document ).ready(function() {
			$('#srch').keypress(function(e) 
			{
				if(e.which == 13) 
				{	
					$("#hid_page").val("1");					
       			   	loadData();	
				}
			});
			$('#srch1').keypress(function(e) 
			{
				if(e.which == 13) 
				{	
					$("#hid_page1").val("1");					
       			   	loadData();	
				}
			});			
			loadData();
			
			$('#container1 .pagination li.active').live('click',function()
			{
				var page = $(this).attr('p');
				$("#hid_page").val(page);
				loadData();						
		});
			$('#container3 .pagination li.active').live('click',function()
			{
				var page = $(this).attr('p');
				$("#hid_page1").val(page);
				loadErrorData();						
			});				
	});  
			
		</script>
    </body>
</html>