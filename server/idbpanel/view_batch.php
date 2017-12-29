<?php
include("include/routines.php");
checkuser();
chkRights(basename($_SERVER['PHP_SELF']));

// This is for dynamic title, bread crum, etc.
if(isset($_GET['pag']))
{
	$title = $_GET['pag'];
}
$path_parts   		= pathinfo(__FILE__);
$filename 	  		= $path_parts['filename'].".php";
$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
$row_feature  		= mysqli_fetch_row($result_feature);
$feature_name 		= $row_feature[1];
$home_name    		= "Home";
$home_url 	  		= "view_dashboard.php?pag=Dashboard";
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
<link rel="stylesheet" href="css/plugins/datepicker/datepicker.css" />
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
                <div class="container-fluid" id="div_view_branch">                
                    	<?php 
                    	/* this function used to add navigation menu to the page*/ 
                    	breadcrumbs($home_url,$home_name,'View Batch',$filename,$feature_name);  
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
                                    <?php
										$add = checkFunctionalityRight($filename,0);
										if($add)
										{
											?>
                                            <button type="button" class="btn-info" onClick="addMoreBranch('','add')" ><i class="icon-plus"></i>&nbsp;Add Batch</button>
  											<?php		
										}
									?>                                         
										<br>
                                    	<input type="hidden" name="hid_page" id="hid_page" value="1">
                                        <select name="rowlimit" id="rowlimit" onChange="loadData();"  class = "select2-me">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries per page
                                        <input type="text" class="input-medium" id = "srch" name="srch" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
                                    </div>
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
                                <?php
										$add = checkFunctionalityRight($filename,0);
										$edit = checkFunctionalityRight($filename,1);
										if(($add) || ($edit))
										{
											?>                                  
            				                    <div class="box box-color box-bordered" style="display: none">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Excel Bulk Upload For Branch
                                        </h3>
                                       
                                    </div> <!-- header title-->
                                    <div class="box-content nopadding">
                                        <div class="profileGallery">
                                            <div style="width:50%;" align="center">
                                                <div id="loading"></div>                                            
                                                <div id="container2">
                                                    <div class="data">
                                                        <form method="post" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" id="frm_branch_excel">
                                                            <div class="control-group">
                                                                <label for="tasktitel" class="control-label">Select file </label>
                                                                <div class="controls">
                                                                    <input type="file" name="file" id="file" data-rule-required="true" data-rule-extension="xlsx"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <button type="submit" name="reg_submit_excel" class="btn-success">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
			                	<div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Wrong Entries For Batch
                                        </h3>
                                       
                                    </div> <!-- header title-->
                                    <div class="box-content nopadding">
                                    	<div style="padding:10px 15px 10px 15px !important">
                                            <input type="hidden" name="hid_page1" id="hid_page1" value="1">
                                            <input type="hidden" name="branch_parent1" id="branch_parent1" value="Parent">
                                            <select name="rowlimit1" id="rowlimit1" onChange="loadData1();"  class = "select2-me">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries per page
                                            <input type="text" class="input-medium" id="srch1" name="srch1" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
                                        </div>
                                        <div id="req_resp1"></div>
                                        <div class="profileGallery">
                                            <div style="width:99%;" align="center">
                                                <div id="loading"></div>                                            
                                                <div id="container3" class="data_container">
                                                    <div class="data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 	}	?>
                            </div>
                        </div>
                </div> <!-- View Branch -->


				<div id="div_add_branch" style="display:none;">
                	<div class="container-fluid"> 
                        <?php 
                        /* this function used to add navigation menu to the page*/ 
                        breadcrumbs($home_url,$home_name,'Add Batch',$filename,$feature_name); 
                        /* this function used to add navigation menu to the page*/ 
                        ?>          
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Add Batch
                                        </h3>
                                        <button type="button" class="btn-info_1" style= "float:right" onClick="backToMain('div_add_branch','div_view_branch');" ><i class="icon-arrow-left"></i>&nbsp Back </button>                                       
                                     </div> <!-- header title-->
                                    <div class="box-content nopadding" >
                                    	<form id="frm_add_batch" class="form-horizontal form-bordered form-validate" >
                                            <div id="div_add_branch_part">
                                            </div>                                    
                                        </form>
                                    </div>	<!-- Main Body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Add Branch -->


				<div id="div_edit_branch" style="display:none;">
                	<div class="container-fluid"> 
                        <?php 
                        /* this function used to add navigation menu to the page*/ 
                        breadcrumbs($home_url,$home_name,'Edit Batch',$filename,$feature_name); 
                        /* this function used to add navigation menu to the page*/ 
                        ?>          
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Edit Batch
                                        </h3>
                                            <button type="button" class="btn-info_1" style= "float:right" onClick="backToMain('div_edit_branch','div_view_branch');" ><i class="icon-arrow-left"></i>&nbsp Back </button>                                                                                                                          
                                    </div> <!-- header title-->
                                    <div class="box-content nopadding" >
                                    	<form id="frm_edit_batch" class="form-horizontal form-bordered form-validate" >
                                        <div id="div_edit_branch_part">
                                        </div>                                    
                                        </form>
                                    </div>	<!-- Main Body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- edit Branch -->

				<div id="div_error_branch" style="display:none;">
                	<div class="container-fluid"> 
                        <?php 
                        /* this function used to add navigation menu to the page*/ 
                        breadcrumbs($home_url,$home_name,'Update Error Batch',$filename,$feature_name); 
                        /* this function used to add navigation menu to the page*/ 
                        ?>          
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Update Error Branch
                                        </h3>
                                            <button type="button" class="btn-info_1" style= "float:right" onClick="location.reload();" ><i class="icon-arrow-left"></i>&nbsp Back </button>                                                                                   
                                    </div> <!-- header title-->
                                    <div class="box-content nopadding" >
                                    	<form id="frm_branch_error" class="form-horizontal form-bordered form-validate" >
                                        <div id="div_error_branch_part">
                                        </div>                                    
                                        </form>
                                    </div>	<!-- Main Body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- error Branch -->   
            	<div id="div_view_branch_details" style="display:none;">
                	<div class="container-fluid"> 
                        <?php 
                        /* this function used to add navigation menu to the page*/ 
                        breadcrumbs($home_url,$home_name,'Branch Details',$filename,$feature_name); 
                        /* this function used to add navigation menu to the page*/ 
                        ?>          
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-table"></i>
                                            Branch Details
                                        </h3>
                                            <button type="button" class="btn-info_1" style= "float:right" onClick="location.reload();" ><i class="icon-arrow-left"></i>&nbsp Back </button>                                                                                   
                                    </div> <!-- header title-->
                                    <div class="box-content nopadding" >
                                    	<form id="frm_view_branch_details" class="form-horizontal form-bordered form-validate" >
                                        <div id="div_view_branch_part">
                                        </div>                                    
                                        </form>
                                    </div>	<!-- Main Body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- view Branch -->                    
            </div>
    </div>


    <!-- ========================Product Request=================== -->
    <div class="modal fade" id="product_reqest" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
        </div>
        <div class="modal-body text-center" id="model_body">

        <div class="control-group">
           <label for="tasktitel" class="control-label"><h3>Product Name </h3></label>
            <div class="controls">
                <input type="text" id="prod_name" name="prod_name"  style="width:90%"  rows="4" class="input-large" data-rule-required="true" >
            </div>
        </div> <!-- Faq Ques -->
        <div class="form-actions">
        <button type="button" onclick="productRequest();" name="reg_submit_add" class="btn-success">Send Request</button>
        </div> <!-- Save and cancel -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>

		<?php getloder();?>
        <?php ?>
        <script type="text/javascript">
		function multipleDelete()
		{			
			loading_show();		
			var batch = [];
			$(".batch:checked").each(function ()
			{
				batch.push(parseInt($(this).val()));
			});
/*			if (typeof batch.length == 0)
			{
				alert("Please select checkbox to delete catogery");				
			}
			else*/
			{
				var sendInfo 	= {"batch":batch, "delete_branch":1};
				var del_branch 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_batch.php",
					type: "POST",
					data: del_branch,
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
						//alert("complete");
						loading_hide();
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
			if(row_limit == "" && page == "")
			{
				$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
				$('#error_model').modal('toggle');	
				loading_hide();			
			}
			else
			{
				var sendInfo 		= {"row_limit":row_limit, "search_text":search_text, "load_batch":1, "page":page};
				var branch_load 	= JSON.stringify(sendInfo);				
				$.ajax({
					url: "load_batch.php",
					type: "POST",
					data: branch_load,
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
						//alert("complete");
						loading_hide();
                	}
			    });
			}
		}

		function changeStatus(batch_id,curr_status)
		{
			//loading_show();
			if(batch_id == "" && curr_status == "")
			{
				$("#model_body").html('<span style="style="color:#F00;"> User id or Status to change not available</span>');
			}
			else
			{
				var sendInfo 	= {"batch_id":batch_id, "curr_status":curr_status, "batchStatus":1};
				var branch_status 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_batch.php?",
					type: "POST",
					data: branch_status,
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
						//alert("complete");
						loading_hide();
                	}
			    });						
			}
		}	
		function addMoreBranch(batch_id,req_type)
		{
			$('#div_view_branch').css("display", "none");
			if(req_type == "add")
			{
				$('#div_add_branch').css("display", "block");				
			}
			else if(req_type == "edit")
			{
				$('#div_edit_branch').css("display", "block");				
			}	
			else if(req_type == "error")
			{
				$('#div_error_branch').css("display", "block");				
			}
			else if(req_type == "view")
			{
				$('#div_view_branch_details').css("display", "block");				
			}							
			var sendInfo = {"batch_id":batch_id,"req_type":req_type,"load_add_batch_part":"1"};
			var branch_load = JSON.stringify(sendInfo);
			$.ajax({
					url: "load_batch.php",
					type: "POST",
					data: branch_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{
                            $("#div_add_branch_part").html(' ');
                            $("#div_edit_branch_part").html(' '); 
                            $("#div_error_branch_part").html(' ');
                            $("#div_view_branch_part").html(' ');

							if(req_type == "add")
							{
								$("#div_add_branch_part").html(data.resp);
							}
							else if(req_type == "edit")
							{
								$("#div_edit_branch_part").html(data.resp);				
							}	
							else if(req_type == "error")
							{
								$("#div_error_branch_part").html(data.resp);				
							}
							else if(req_type == "view")
							{
								$("#div_view_branch_part").html(data.resp);
							}
							loading_hide();
						} 
						else if(data.Success == "fail") 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');						
							$('#error_model').modal('toggle');						
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
						//alert("complete");
						loading_hide();
                	}
				});			
		} 
		function changeOrder(branch_id,new_order)
		{
			loading_show();			
			if(branch_id == "" && new_order == "")
			{
				$("#model_body").html('<span style="style="color:#F00;"> User id or Status to change not available</span>');
			}
			else
			{
				change_sort_order 	= 1;
				var sendInfo 	= {"branch_id":branch_id, "new_order":new_order, "change_sort_order":change_sort_order};
				var branch_order 	= JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_batch.php?",
					type: "POST",
					data: branch_order,
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
						//alert("complete");
						loading_hide();
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
       			   	loadData1();	
				}
			});	
			loadData();
			<?php
			$add = checkFunctionalityRight($filename,0);
			$edit = checkFunctionalityRight($filename,1);
			if($add || $edit)
			{
			?>
			loadData1();
			<?php
			}
			?>
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
				loadData1();						
			});
		});
		
		// ******************************************************************************************
		// scripts for excel bulk upload [ for showing the error logs ] starts here 
		// ******************************************************************************************
		function loadData1()
		{
			loading_show();
			row_limit1 		= $.trim($('select[name="rowlimit1"]').val());
			search_text1 	= $.trim($('#srch1').val());
			page1 			= $.trim($("#hid_page1").val());
			branch_parent1		= $.trim($('#branch_parent1').val());
			load_error 	= "1";			
			
			if(row_limit1 == "" && page1 == "")
			{
				$("#model_body").html('<span style="style="color:#F00;">Can not Get Row Limit and Page number</span>');
				$('#error_model').modal('toggle');				
			}
			else
			{
				var sendInfo_error 		= {"row_limit1":row_limit1, "search_text1":search_text1, "load_error":load_error, "page1":page1,"branch_parent1":branch_parent1};
				var branch_load_error = JSON.stringify(sendInfo_error);				
				$.ajax({
					url: "load_batch.php?",
					type: "POST",
					data: branch_load_error,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{
						data = JSON.parse(response);
						
						if(data.Success == "Success") 
						{
							$("#container3").html(data.resp);
							loading_hide();
						} 
						else if(data.Success == "fail") 
						{
							$("#container3").html('<span style="style="color:#F00;">'+data.resp+'</span>');														
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
						//alert("complete");
						loading_hide();
                	}
				});
			}
		}
		
		
		$('#frm_branch_excel').on('submit', function(e) {
			e.preventDefault();
			if ($('#frm_branch_excel').valid())
			{
				loading_show();	
				$.ajax({
						url: "load_batch.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#req_resp").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								window.location.assign("view_branch.php?pag=<?php echo $title; ?>");
								loading_hide();
							} 

							else 
							{
								$("#req_resp").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
								loading_hide();						
							}
						},
						error: function (request, status, error) 
						{
							//alert(request.responseText);
						},
						complete: function()
						{
							//alert("complete");
                		}
				    });
			}
		});
		$('#frm_add_batch').on('submit', function(e) {
			e.preventDefault();
			if ($('#frm_add_batch').valid())
			{
				$.ajax({
                        url: "load_batch.php?",
                        type: "POST",
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        async:true,                 
                        success: function(response) 
                        {
                            //alert(response);
                            data = JSON.parse(response);
                            //alert();
                            if(data.Success == "Success") 
                            {
                                window.location.assign("view_batch.php?pag=Batch");
                            } 
                            else 
                            {
                                //alert("Wrong Entries");
                                $("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
                                $('#error_model').modal('toggle');  
                                            
                            }
                        },
                        error: function (request, status, error) 
                        {
                            $("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
                            $('#error_model').modal('toggle');  
                                                
                        },
                        complete: function()
                        {
                        }
                    });
			}
		});//add
		$('#frm_edit_batch').on('submit', function(e) {
			e.preventDefault();
			if ($('#frm_edit_batch').valid())
			{
				$.ajax({
                        url: "load_batch.php?",
                        type: "POST",
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        async:true,                 
                        success: function(response) 
                        {
                            //alert(response);
                            data = JSON.parse(response);
                            //alert();
                            if(data.Success == "Success") 
                            {
                                window.location.assign("view_batch.php?pag=Batch");
                            } 
                            else 
                            {
                                //alert("Wrong Entries");
                                $("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
                                $('#error_model').modal('toggle');  
                                            
                            }
                        },
                        error: function (request, status, error) 
                        {
                            $("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
                            $('#error_model').modal('toggle');  
                                                
                        },
                        complete: function()
                        {
                        }
                    });
			}
		});//edit
		$('#frm_branch_error').on('submit', function(e) {
			e.preventDefault();
			if ($('#frm_branch_error').valid())
			{
				loading_show();	
				var branch_name 		= $.trim($("#branch_name").val());
				var branch_orgid 		= $.trim($("#branch_orgid").val());				
				var branch_detail_add 	= $.trim(CKEDITOR.instances['branch_detail_add'].getData());
				var branch_state 		= $.trim($("#branch_state").val());
				var branch_city			= $.trim($("#branch_city").val());
				var branch_pincode 		= $.trim($("#branch_pincode").val());												
				var branch_meta_tags	= $.trim($("#branch_meta_tags").val());
				var branch_meta_description	= $.trim(CKEDITOR.instances['branch_meta_description'].getData());
				var branch_meta_title	= $.trim($("#branch_meta_title").val());	
				var branch_status 		= $('input[name=branch_status]:checked', '#frm_branch_error').val();
				var error_id				= $("#error_id").val();
							
				if(branch_name == "" && branch_orgid == "" && branch_status == "")
				{
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
					$('#error_model').modal('toggle');	
				} 
				else
				{
					e.preventDefault();
					$('input[name="reg_submit_error"]').attr('disabled', 'true');
					var sendInfo 		= {"branch_name":branch_name, "branch_orgid":branch_orgid, "branch_detail_add":branch_detail_add,"branch_state":branch_state,"branch_city":branch_city,"branch_pincode":branch_pincode,"branch_meta_tags":branch_meta_tags,"branch_meta_description":branch_meta_description,"branch_meta_title":branch_meta_title,"branch_status":branch_status,"error_id":error_id,"insert_req":"1"};
					var branch_insert = JSON.stringify(sendInfo);				
					$.ajax({
						url: "load_batch.php?",
						type: "POST",
						data: branch_insert,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');								
								//window.location.assign("view_branch.php?pag=<?php echo $title; ?>");
								loading_hide();
							} 
							else 
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
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
							//alert("complete");
							loading_hide();
						}
				    });
				}
			}
		});//error
		// ******************************************************************************************
		// scripts for excel bulk upload [ for showing the error logs ] ends here 
		// ******************************************************************************************   


        function backToMain(close_div,show_div)
        {
            $('#'+close_div).css('display','none');
            $('#'+show_div).css('display','block');
            loadData();
        }

        // ******************************************************************************************
        // scripts for get product 
        // ******************************************************************************************  
        function getProduct(type)
        {
			if(type==1)
			{
				$('#prod_mrp').css('display','none');
			}
			else
			{
				$('#prod_mrp').css('display','block');
			}
			
            if(type == "")
            {
                $("#model_body").html('<span style="style="color:#F00;"> Plesae select product type</span>');
            }
            else
            {
                var sendInfo    = {"type":type, "getProduct":1};
                var batch_status   = JSON.stringify(sendInfo);                             
                $.ajax({
                    url: "load_batch.php?",
                    type: "POST",
                    data: batch_status,
                    contentType: "application/json; charset=utf-8",                     
                    success: function(response) 
                    {           
                        data = JSON.parse(response);
                        if(data.Success == "Success") 
                        {                           
                           $('#prod_id').html(data.resp);
                            
                        } 
                        else
                        {
                            $("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');                                                 
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
                        //alert("complete");
                        loading_hide();
                    }
                });                     
            }
        }

        function productRequest()
        {
            var prod_name = $('#prod_name').val();
            loading_show();
            if(prod_name == "")
            {
                $("#model_body").html('<span style="style="color:#F00;">Enter Product Name</span>');
            }
            else
            {
                var sendInfo    = {"prod_name":prod_name, "productRequest":1};
                var batch_status   = JSON.stringify(sendInfo);                             
                $.ajax({
                    url: "load_batch.php?",
                    type: "POST",
                    data: batch_status,
                    contentType: "application/json; charset=utf-8",                     
                    success: function(response) 
                    {           
                        data = JSON.parse(response);
                        if(data.Success == "Success") 
                        {                           
                           alert(data.resp);
                           location.reload();
                        } 
                        else
                        {
                            alert(data.resp);                                              
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
                        //alert("complete");
                        loading_hide();
                    }
                });                     
            }
        }
		$(document).on('change', '#disclaimer', function() {
				
				
				if($("#disclaimer").attr("checked")) 
				{
					$('#disclaimermodal').modal({
										backdrop: 'static'
								  });
				}
			});
			
			$(document).on('change', '.prod_sample', function() {
				
				
				if($(this).val()==1) 
				{
					$('#spanMsg').html('You will be charged 100 Rs. extra ');
				}
				else
				{
					$('#spanMsg').html(' ');
				}
			});
			
			 $( ".datepicker" ).datepicker({
				changeMonth	: true,
				changeYear	: true,
				dateFormat	: 'mm-dd-yy',
				yearRange 	: 'c:c',//replaced "c+0" with c (for showing years till current year)
				maxDate		: new Date(),
					
			   });
			   
		 function numsonly(e)
		 {
  			  var unicode=e.charCode? e.charCode : e.keyCode
			 
			  if (unicode !=8 && unicode !=32)
			  {  // unicode<48||unicode>57 &&
				  if (unicode<48||unicode>57)  //if not a number
				  return false //disable key press
              }
		}
		
		
		function getCommission(price)
		{
			
            var prod_id = $('#prod_id').val();
           
            if(prod_id == "")
            {
                alert('Please select product first...!');
				return false;
            }
            else
            {
				 loading_show();
                var sendInfo    = {"prod_id":prod_id,"price":price, "getCommission":1};
                var batch_status   = JSON.stringify(sendInfo);                             
                $.ajax({
                    url: "load_batch.php?",
                    type: "POST",
                    data: batch_status,
                    contentType: "application/json; charset=utf-8",                     
                    success: function(response) 
                    {           
                        data = JSON.parse(response);
                        if(data.Success == "Success") 
                        {                           
                           $('#commission_msg').html(data.resp);
                           
                        } 
                        else
                        {
                            alert(data.resp);                                              
                         
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
                        //alert("complete");
                        loading_hide();
                    }
                });                     
            }
        
		}
		</script>
        <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
         <div class="modal fade " tabindex="-1" role="dialog" id="disclaimermodal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Disclaimer</h4>
                  </div>
                  <div class="modal-body">
                    <p>
                    In general, an item may be eligible for return within the applicable return window if it fulfils one or more of the following conditions:
                    Was delivered in a physically damaged condition </p><p>
                    Has missing parts or accessories
                       </p><p> Is different from what was ordered
                       </p><p> Is no longer needed (not all items may be eligible)
                    Products marked as "non-returnable" on the product detail page cannot be returned. View the full list of non-returnable items.
                        </p><p>All items must be returned in their original condition, with price tags intact, user manual, warranty cards, original accessories and in the original manufacturer’s box/packaging as delivered to you.
                      </p><p>  Only Fulfilled by Amazon (FBA) items may be eligible for replacement. For more details, please refer About Free Replacements.
                       </p><p> If you wish to return an electronic device that stores any personal information, please ensure that you have removed all such personal information from the device prior to returning. Amazon shall not be liable in any manner for any misuse or usage of such information."
                      </p><p>  Some items may not be eligible for return if you "no longer need it" (including cases of buyer's remorse such as incorrect model or color of product ordered or incorrect product ordered).
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
           
            <!-- ========================================= MAIN : END ========================================= -->
        
    </body>
</html>