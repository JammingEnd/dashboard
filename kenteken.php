<!DOCTYPE html>
<html lang="en">
<head>
	<title>kenteken</title>
</head>
<body>
	<?php

$json = file_get_contents('https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken='.($_POST["kenteken"]));

$json_data = json_decode( $json );
$data = $json_data[0];

//foreach( $json_data as $data )
//{
    echo 'Merk  en Model  = ' . $data->merk . ' ' . $data->handelsbenaming . '</p>';
    echo '<p>Kenteken = ' . $data->kenteken . '<br />';
    
?>
	<div class="container">
		<ul>
			<li id="kenteken"><a href="">Kenteken</a>
				<?php echo '<p>Kenteken = ' . $data->kenteken . '<br />'; ?></li>
			<li id="voertuigsoort"><a href="">Voertuigsoort</a>
				<?php echo '<p>voertuigsoort = ' . $data->voertuigsoort . '<br />'; ?></li>
			<li id="Merk"><a href="">Merk</a>
				<?php echo '<p>merk = ' . $data->merk . '<br />'; ?></li>
			<li id="handelsbenaming"><a href="">Handelsbenaming</a>
				<?php echo '<p>Handelsbenaming = ' . $data->handelsbenaming . '<br />'; ?></li>
			<li id="inrichting"><a href="">Inrichting</a>
				<?php echo '<p>inrichting = ' . $data->inrichting . '<br />'; ?></li>
			<li id="cilinders"><a href="">Aantal cilinders</a>
				<?php echo '<p>Aantal cilinders = ' . $data->aantal_cilinders . '<br />'; ?></li>
			<li id="variant"><a href="">Variant</a>
				<?php echo '<p>Variant = ' . $data->variant . '<br />'; ?></li>
			<li id="kleur"><a href="">Eerste kleur</a>
				<?php echo '<p>Eerste kleur = ' . $data->eerste_kleur. '<br />'; ?></li>
				<li id="datum"><a href="">Datum eerste toelating</a>
			<?php echo '<p>Datum eerste toelating = ' . $data->datum_eerste_toelating. '<br />'; ?></li>
		</ul>
	</div>
</body>
</html>