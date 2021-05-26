<!DOCTYPE html>
<html lang="en">
<?php
  include_once("../server/curl_helper.php");
	include_once("../server/types/voertuigen.php");

  if (count($_GET) <= 0 || !array_key_exists("kenteken", $_GET) || !array_key_exists("key", $_GET) || !array_key_exists("value", $_GET) || !array_key_exists("merk", $_GET)) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    // header("Location: http://$host$uri/$extra");
    exit; // ???
  }

  
  $key = $_GET["key"]; // aantal_cilinders
  $value = $_GET["value"]; // result.
  $merk = $_GET["merk"];
  $keyObj = null;
  $kenteken = $_GET["kenteken"];

	$url = 'https://opendata.rdw.nl/resource/m9d7-ebf2.json';

	$results = CurlHelper::getFileContents($url);

	$allVoertuigen = Voertuigen::addVoertuig(json_decode($results), true);

	if (count($allVoertuigen) <= 0) {
    echo "2";
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		// header("Location: http://$host$uri/$extra");
		exit;
	}

  $label = "";

  switch ($key) {
    case "aantal_cilinders":
      $keyObj = "aantalcilinders";
      $lable = "Cilinders";
      break;
    case "handelsbenaming":
      $keyObj = "handelsbenaming";
      break;
    case "inrichting":
      $keyObj = "inrichting";
      break;
    default:
      break;
  }

  $aantallen = array();

  $valueMap = array();

  foreach ($allVoertuigen as $res) {
    $result = $res->getPropByName($keyObj);
    try {
    if (array_key_exists($result, $valueMap)) {
      $valueMap[$result] = $valueMap[$result] + 1;
    } else {
      $valueMap[$result] = 1;
    }
    } catch (Exception $e) {
      echo "<br>";
      var_dump($res);
    }
  }

  $aantallen = array();
  $lables = array();

  foreach($valueMap as $mapKey => $mapValue) {
    array_push($aantallen, $mapValue);
    array_push($lables, ((string) $mapKey) == "" ? "?" : (string)$mapKey);
  }

  // var_dump($valueMap);

  // echo "<br><br>";
  // var_dump($aantallen);
  // echo "<br><br>";
  var_dump($lables);
  // exit;

  $aantallen2 = array(30, 1567, 3045, 1787, 497, 56, 45); //hexagon
  $aantallenDiagram2 = array(0, 10, 5, 2, 20, 30, 45);
  $labelDriagram2 = array( 'January','February','March','April','May','June',);

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Diagrammen.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>RDW - Dashboard: Diagrammen</title>
</head>

<body>
<div class="header">
<h1>Statestieken</h1>
</div>

<div class="flexbox">

<div>
<canvas id="test" width="468" height="468" style="display: block; box-sizing: border-box; height: 500px; width: 500px;"></canvas>
  </div>

<script type="text/javascript">
 
var een_lijstJS2 = <?php echo json_encode($aantallen2) ?>;
var labelName = <?php echo json_encode($lableName) ?>;
//labels veranderen naar de opgevraagde data

var data = <?php echo json_encode($aantallen) ?>;
var labels = <?php echo json_encode($lables) ?>;

const configData = {
  labels,
  datasets: [{
    label: "todo",
    data,
    fill: true,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'

  }]
};



const config = {
  type: 'doughnut',
  data: configData,
  options: {
    elements: {
      line: {
        borderWidth: 3
      }
    }
  },
};
window.addEventListener('load', function() { 
      var myChart = new Chart(
          document.getElementById('test'),
          config
      );
  }); // sluit de eerste function

  </script>
<!-- ================ tweede diagram ============= -->
<div>
<canvas id="Dia2" width="750" height="375" style="display: block; box-sizing: border-box; height: 500px; width: 500px;"></canvas>
    </div>

<script type="text/javascript">
var dataDiagram2 = <?php echo json_encode($aantallenDiagram2) ?>;  
var labelDiagram2 = <?php echo json_encode($labelDriagram2)?>;
var labeNaam2 = <?php echo json_encode($labelnaamDia2)?>;
//labels veranderen naar de opgevraagde data


    const labels2 = labelDiagram2;

    //data
    const data2 = {
        labels: labels2,
        datasets: [{
            label: "???",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: dataDiagram2,
        }]
    };

   //soort grafiek
    const config2 = {
        type: 'line',
        data: data2,
        options: {}
    };

    
    //toevoegen
    window.addEventListener('load', function() { 
        var myChart = new Chart(
            document.getElementById('Dia2'),
            config2
        );
    }); 
    </script>
    </div>
</body>

</html>
