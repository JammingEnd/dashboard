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

	echo 'Merk  en Model  = ' . $voertuig->getMerk() . ' ' . $voertuig->getHandelsBenaming() . '</p>';
	echo '<p>Kenteken = ' . $voertuig->getKenteken() . '<br />';
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kenteken - <?php echo $voertuig->getKenteken() ?></title>
</head>
<body>

	<div class="container">
		<ul>
			<li id="kenteken"><a href="">Kenteken</a>
				<?php echo '<p>Kenteken = ' . $voertuig->getKenteken() . '<br />'; ?></li>
			<li id="voertuigsoort"><a href="">Voertuigsoort</a>
				<?php echo '<p>voertuigsoort = ' . $voertuig->getVoertuigSoort() . '<br />'; ?></li>
			<li id="Merk"><a href="">Merk</a>
				<?php echo '<p>merk = ' . $voertuig->getMerk() . '<br />'; ?></li>
			<li id="handelsbenaming"><a href="">Handelsbenaming</a>
				<?php echo '<p>Handelsbenaming = ' . $voertuig->getHandelsBenaming() . '<br />'; ?></li>
			<li id="inrichting"><a href="">Inrichting</a>
				<?php echo '<p>inrichting = ' . $voertuig->getInrichting() . '<br />'; ?></li>
			<li id="cilinders"><a href="">Aantal cilinders</a>
				<?php echo '<p>Aantal cilinders = ' . $voertuig->getAantalCilinders() . '<br />'; ?></li>
			<li id="variant"><a href="">Variant</a>
				<?php echo '<p>Variant = ' . $voertuig->getVariant() . '<br />'; ?></li>
			<li id="kleur"><a href="">Eerste kleur</a>
				<?php echo '<p>Eerste kleur = ' . $voertuig->getEersteKleur() . '<br />'; ?></li>
				<li id="datum"><a href="">Datum eerste toelating</a>
			<?php echo '<p>Datum eerste toelating = ' . $voertuig->getEersteToeLating(). '<br />'; ?></li>
		</ul>
	</div>
</body>
</html>