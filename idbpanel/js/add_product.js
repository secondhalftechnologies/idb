
function productType(type)
{
	if(type=='raw')
	{
		$('#div_form_factor').css('display','block');

		// =============Display None====================
		$('#div_cost_effective_pack').css('display','none');
		$('#div_stadard_pack').css('display','none');
		$('#div_shipper').css('display','none');
		$('#div_ean').css('display','none');
		$('#div_hsn').css('display','none');

	}
	else if(type=='formulation')
	{

		$('#div_cost_effective_pack').css('display','block');
		$('#div_stadard_pack').css('display','block');
		$('#div_shipper').css('display','block');
		$('#div_ean').css('display','block');
		$('#div_hsn').css('display','block');

		// =============Display None====================
	   $('#div_form_factor').css('display','none');
	}

}