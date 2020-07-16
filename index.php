<?php
require_once 'secure/api_key.php';
if( isset($_POST['var_lat']) && isset($_POST['var_lon']) )
{
  $vlat=$_POST['var_lat'];
  $vlon=$_POST['var_lon'];
  //new location api
   $locationurl="https://api.tomtom.com/search/2/reverseGeocode/".$vlat."%2C".$vlon.".json?key=".$api_key;
   $locationdata=file_get_contents($locationurl);
   $locationinfo=json_decode($locationdata,true);
   $location_state=$locationinfo['addresses'][0]['address']['countrySubdivision'];
   $location_city=$locationinfo['addresses'][0]['address']['countrySecondarySubdivision'];
   $city=$location_city;
   $state=$location_state;
   $data=file_get_contents("https://api.covid19india.org/state_district_wise.json");
   $corona=json_decode($data,true);
   $dist=$city;
   $dist=ucwords($dist);
   $cstate=$state;
   $cstate=ucwords($cstate);
   $num_active=$corona[$cstate]['districtData'][$dist]['active'];
   $num_confirmed=$corona[$cstate]['districtData'][$dist]['confirmed'];
   $num_died=$corona[$cstate]['districtData'][$dist]['deceased'];
   $num_recovered=$corona[$cstate]['districtData'][$dist]['recovered'];
   echo json_encode(array($dist,$cstate,$num_active,$num_confirmed,$num_died,$num_recovered));
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>COVID-19 INFO</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="myscript.js"></script>
</head>


<body onload="main()">


<form action="" method="post">
  <input type="hidden" name="var_lat_php" id="var_lat" value="">
  <input type="hidden" name="var_lon_php" id="var_lon" value="">
  <input type="submit" name="submit_button" id="suid" value="Lets Fight COVID-19">
</form>

<div class="top-container">
  <h1>Lets Fight COVID-19</h1>
</div>
<div class="header">
  <p>Protect yourself and others around you by knowing the facts and taking appropriate precautions. Follow advice provided by your local public health agency.</p>
  <hr>
</div>

<div class="content">
<p>To prevent the spread of COVID-19:</p>
<ul>
<li>Follow social distancing.</li>
<li> Clean your hands often. Use soap and water, or an alcohol-based sanitizers.</li>
<li> Maintain a safe distance from anyone who is coughing or sneezing.</li>
<li> Do not touch your eyes, nose and mouth with unclean hands.</li>
<li> Cover your nose and mouth with your bent elbow or a tissue when you cough or sneeze.</li>
<li> Stay home if you feel unwell.</li>
<li> If you have a fever, a cough, and difficulty breathing, seek medical attention. Call in advance.</li>
<li> Follow the directions of your local health authority.</li>
<li>Avoiding unneeded visits to medical facilities allows healthcare systems to operate more effectively, therefore protecting you and others.</li>
<li>Ensure that the surfaces and objects are regularly cleaned.</li>
</ul>
<hr>
</div>



<div class="footer">
  <p align="center">Data provided here will get updated when the data fetching sources provide updated data.</p>
</div>



</body>
</html>
