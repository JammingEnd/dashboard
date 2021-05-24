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

	// echo 'Merk  en Model  = ' . $voertuig->getMerk() . ' ' . $voertuig->getHandelsBenaming() . '</p>';
	// echo '<p>Kenteken = ' . $voertuig->getKenteken() . '<br />';
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<title>Kenteken - <?php echo $voertuig->getKenteken() ?></title>
</head>
<body>
	<div class="row">
		
	</div>
	<div class="row center-div">
		<div class="col-lg-12 text-center">
			<h2>Kenteken: <?php echo $voertuig->getKenteken() ?></h2>
		</div>
		<div class="col-lg-12">
			<div class="bs-component text-center" style="padding: 25px 0 0 25%;">
				<!-- <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
					<a href="#Kenteken" class="card-body">
						<h4 class="card-title">Model: <?php echo $voertuig->getHandelsBenaming() ?> </h4>
					</a>
				</div> -->

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#merk" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Merk: <?php echo $voertuig->getMerk() ?></h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#model" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Model: <?php echo $voertuig->getHandelsBenaming() ?> </h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#inrichting" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Inrichting: <?php echo $voertuig->getInrichting() ?> </h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#cilinders" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Aantal cilinders: <?php echo $voertuig->getAantalCilinders() ?> </h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#variant" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Variant: <?php echo $voertuig->getVariant() ?> </h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#eersteKleur" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Eerste kleur: <?php echo $voertuig->getEersteKleur() ?> </h4>
					</a>
				</div>

				<div class="card text-white bg-primary mb-3" style="max-width: 30rem;">
					<a href="#eersteToeLating" class="card-body" style="text-decoration:none;">
						<h4 class="card-title">Eerste toelating: <?php echo date("d-m-Y", $voertuig->getEersteToeLating()) ?> </h4>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>