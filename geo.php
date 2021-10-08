<html>
	<body onload="document.getElementById('geoin').focus();">
		<?php
		$geoin="";
		$result="";
		if(isset($_POST['geoin']))
		{
			$geoin = $_POST['geoin']; // PinCode

			// Get JSON results from this request
			$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($geoin).'&sensor=false');
			$geo = json_decode($geo, true); // Convert the JSON to an array

			if ($geo['status'] == 'OK') {
			  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
			  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
			}
			$result="$latitude,$longitude";
		}
		?>
		<form method="post">
		<input required name="geoin" id="geoin" placeholder="City / PinCode" />&nbsp;
		<input type="submit" value="Show Geo" />&nbsp;
		<?php echo $result;?>
		</form>
	</body>
</html>