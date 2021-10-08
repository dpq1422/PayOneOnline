<?php
$pinCode="";
$result="";
if(isset($_POST['pinCode']))
{
	$pinCode = $_POST['pinCode']; // PinCode

	// Get JSON results from this request
	$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($pinCode).'&sensor=false');
	$geo = json_decode($geo, true); // Convert the JSON to an array

	$latitude=$longitude="";
	if ($geo['status'] == 'OK') {
	  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
	  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
	}
	$result="$latitude,$longitude";
	$result=json_encode($result);
}
echo $result;
?>