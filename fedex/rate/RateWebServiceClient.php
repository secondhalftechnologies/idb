<?php
// Copyright 2009, FedEx Corporation. All rights reserved.
// Version 12.0.0

require_once('../include/fedex-common.php');

$newline = "<br />";
//The WSDL is not included with the sample code.
//Please include and reference in $path_to_wsdl variable.
$path_to_wsdl = "RateService_v22.wsdl";

ini_set("soap.wsdl_cache_enabled", "0");
 
$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

$request['WebAuthenticationDetail'] = array(
	'ParentCredential' => array(
		'Key' => getProperty('parentkey'),
		'Password' => getProperty('parentpassword')
	),
	'UserCredential' => array(
		'Key' => getProperty('key'), 
		'Password' => getProperty('password')
	)
); 
$request['ClientDetail'] = array(
	'AccountNumber' => getProperty('shipaccount'), 
	'MeterNumber' => getProperty('meter'),
	'CustomsClearanceDetail' => array(
					     'CommercialInvoice' => array(
					       'Purpose' => "SOLD"
					    )
					)
);

$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request using PHP ***');
$request['Version'] = array(
	'ServiceId' => 'crs', 
	'Major' => '22', 
	'Intermediate' => '0', 
	'Minor' => '0'
);
$request['ReturnTransitAndCommit'] = true;
$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
$request['RequestedShipment']['ShipTimestamp'] = date('c');
$request['RequestedShipment']['ServiceType'] = 'INTERNATIONAL_PRIORITY'; // valid values INTERNATIONAL_PRIORITY, STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
$request['RequestedShipment']['TotalInsuredValue']=array(
	'Amount'=>100,
	'Currency'=>'INR'
);
$request['RequestedShipment']['Shipper'] = addShipper();
$request['RequestedShipment']['Recipient'] = addRecipient();
$request['RequestedShipment']['ShippingChargesPayment'] = addShippingChargesPayment();
$request['RequestedShipment']['PackageCount'] = '1';
$request['RequestedShipment']['RequestedPackageLineItems'] = addPackageLineItem1();



try {
	if(setEndpoint('changeEndpoint')){
		$newLocation = $client->__setLocation(setEndpoint('endpoint'));
	}
	
	$response = $client -> getRates($request);
        
    if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){  	
    	$rateReply = $response -> RateReplyDetails;
    	echo '<table border="1">';
        echo '<tr><td>Service Type</td><td>Amount</td><td>Delivery Date</td></tr><tr>';
    	$serviceType = '<td>'.$rateReply -> ServiceType . '</td>';
    	if($rateReply->RatedShipmentDetails && is_array($rateReply->RatedShipmentDetails)){
			$amount = '<td>$' . number_format($rateReply->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",") . '</td>';
		}elseif($rateReply->RatedShipmentDetails && ! is_array($rateReply->RatedShipmentDetails)){
			$amount = '<td>$' . number_format($rateReply->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",") . '</td>';
		}
        if(array_key_exists('DeliveryTimestamp',$rateReply)){
        	$deliveryDate= '<td>' . $rateReply->DeliveryTimestamp . '</td>';
        }else if(array_key_exists('TransitTime',$rateReply)){
        	$deliveryDate= '<td>' . $rateReply->TransitTime . '</td>';
        }else {
        	$deliveryDate='<td>&nbsp;</td>';
        }
        echo $serviceType . $amount. $deliveryDate;
        echo '</tr>';
        echo '</table>';
        
        printSuccess($client, $response);
    }else{
        printError($client, $response);
    } 
    writeToLog($client);    // Write to log file   
} catch (SoapFault $exception) {
   printFault($exception, $client);        
}



function addShipper(){
	$shipper = array(
		'Contact' => array(
			'PersonName' => 'Satish',
			'CompanyName' => 'Planet Educate',
			'PhoneNumber' => '9012638716'
		),
		'Address' => array(
			'StreetLines' => array('Worli'),
			'City' => 'Delhi',
			'StateOrProvinceCode' => 'DL',
			'PostalCode' => '110005',
			'CountryCode' => 'IN'
		)
	);
	return $shipper;
}
function addRecipient(){
	$recipient = array(
		'Contact' => array(
			'PersonName' => 'Prathmesh',
			'CompanyName' => 'Edmission',
			'PhoneNumber' => '9012637906'
		),
		'Address' => array(
			'StreetLines' => array('Chandani Chowk'),
			'City' => 'Collierville',
			'StateOrProvinceCode' => 'TN',
			'PostalCode' => '38017',
			'CountryCode' => 'US'
			
		)
	);
	//'Residential' => false
	return $recipient;	                                    
}
function addShippingChargesPayment(){
	$shippingChargesPayment = array(
		'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
		'Payor' => array(
			'ResponsibleParty' => array(
				'AccountNumber' => getProperty('billaccount'),
				'CountryCode' => 'IN'
			)
		)
	);
	return $shippingChargesPayment;
}
function addLabelSpecification(){
	$labelSpecification = array(
		'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
		'ImageType' => 'PDF',  // valid values DPL, EPL2, PDF, ZPLII and PNG
		'LabelStockType' => 'PAPER_7X4.75'
	);
	return $labelSpecification;
}
function addSpecialServices(){
	$specialServices = array(
		'SpecialServiceTypes' => array('COD'),
		'CodDetail' => array(
			'CodCollectionAmount' => array(
				'Currency' => 'INR', 
				'Amount' => 150
			),
			'CollectionType' => 'ANY' // ANY, GUARANTEED_FUNDS
		)
	);
	return $specialServices; 
}
function addPackageLineItem1(){
	$packageLineItem = array(
		'SequenceNumber'=>1,
		'GroupPackageCount'=>1,
		'Weight' => array(
			'Value' => 50.0,
			'Units' => 'LB'
		),
		'Dimensions' => array(
			'Length' => 108,
			'Width' => 5,
			'Height' => 5,
			'Units' => 'IN'
		)
	);
	return $packageLineItem;
}
?>