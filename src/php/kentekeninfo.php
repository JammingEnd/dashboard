<!DOCTYPE html>
<html lang="en">
<head>
	<title>kenteken</title>
</head>
<body>
	<?php
include_once("../server/curl_helper.php");
include_once("../server/types/voertuigen.php");

/**
 * Validation
 */
if (!array_key_exists("kenteken", $_POST)) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php?error1';
	header("Location: http://$host$uri/$extra");
	exit;
}


$kenteken = $_POST["kenteken"];


$url = 'https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken='.$kenteken;

$results = CurlHelper::getFileContents($url);

$voertuigen = Voertuigen::addVoertuig(json_decode($results));

if (count($voertuigen) <= 0) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php?error2';
	header("Location: http://$host$uri/$extra");
	exit;
}

$voertuig = $voertuigen[0];

//foreach( $json_data as $data )
//{
    // echo 'Merk  en Model  = ' . $voertuig->getMerk() . ' ' . $voertuig->getHandelsBenaming() . '</p>';
    // echo '<p>Kenteken = ' . $voertuig->getKenteken() . '<br />';
    
?>

</body>
</html>