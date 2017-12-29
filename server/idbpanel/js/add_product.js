
function productType(type)
{
	//alert(type);
	if(type=='1')
	{
		//$('#div_form_factor').css('display','block');

		// =============Display None====================
		$('#div_cost_effective_pack').css('display','none');
		$('#div_stadard_pack').css('display','none');
		$('#div_shipper').css('display','none');
		$('#div_ean').css('display','none');
		$('#div_hsn').css('display','none');
		$('#div_generic_name').css('display','none');
		$('#div_size_attribute').css('display','none');

	}
	else if(type=='2')
	{

		$('#div_cost_effective_pack').css('display','block');
		$('#div_stadard_pack').css('display','block');
		$('#div_shipper').css('display','block');
		$('#div_ean').css('display','block');
		$('#div_hsn').css('display','block');
		$('#div_generic_name').css('display','none');
		$('#div_size_attribute').css('display','none');

		// =============Display None====================
	  // $('#div_form_factor').css('display','none');
	}
	else if(type=='3')
	{
		$('#div_generic_name').css('display','block');
		$('#div_size_attribute').css('display','block');
		$('#div_cost_effective_pack').css('display','block');
		$('#div_stadard_pack').css('display','block');
		$('#div_shipper').css('display','block');
	}

}