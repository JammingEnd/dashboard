<!DOCTYPE html>
<html lang="en">
<?php
  include_once("../server/curl_helper.php");
	include_once("../server/types/voertuigen.php");

  if (count($_GET) <= 0 || !array_key_exists("kenteken", $_GET) || !array_key_exists("key", $_GET) || !array_key_exists("value", $_GET) || !array_key_exists("merk", $_GET)) {
    echo "1";
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

  $urlMerk = "https://opendata.rdw.nl/resource/m9d7-ebf2.json?merk=" . $merk;

	$results = CurlHelper::getFileContents($url);

	$allVoertuigen = Voertuigen::addVoertuig(json_decode($results));

  $resultsMerk = CurlHelper::getFileContents($urlMerk);
  $merkVoertuigen = Voertuigen::addVoertuig(json_decode($resultsMerk));

	if (count($allVoertuigen) <= 0 || count($merkVoertuigen) <= 0) {
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

  
  function getValueMap($var1, $var3) {
    $var2 = array();
    foreach($var1 as $var) {
      $result = $var->getPropByName($var3);
      try {
      if (array_key_exists($result, $var2)) {
        $var2[$result] = $var2[$result] + 1;
      } else {
        $var2[$result] = 1;
      }
      } catch (Exception $e) {
        echo "<br>";
        var_dump($res);
      }
    }
    return $var2;
  }

  


  $valueMapAll = getValueMap($allVoertuigen, $keyObj);
  $valueMapMerk = getValueMap($merkVoertuigen, $keyObj);

  $aantallenAll = array();
  $lablesAll = array();

  
  $aantallenMerk = array();
  $lablesMerk = array();
  

  foreach($valueMapAll as $mapKey => $mapValue) {
    array_push($aantallenAll, $mapValue);
    array_push($lablesAll, ((string) $mapKey) == "" ? "?" : (string) $mapKey);
  }

  foreach($valueMapMerk as $mapKey => $mapValue) {
    array_push($aantallenMerk, $mapValue);
    array_push($lablesMerk, ((string) $mapKey) == "" ? "?" : (string) $mapKey);
  }

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
 
var data = <?php echo json_encode($aantallenAll) ?>;
var labels = <?php echo json_encode($lablesAll) ?>;

console.log("data =>", data);
console.log("lables =>", labels);

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
const data2 = <?php echo json_encode($aantallenMerk) ?>;
const labels2 = <?php echo json_encode($lablesMerk) ?>;

console.log("data2 => ", data2);
console.log("labels2 => ", labels2);

    const configData2 = {
      labels,
      datasets: [{
        label: "todo",
        data: data2,
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgb(255, 99, 132)',
        pointBackgroundColor: 'rgb(255, 99, 132)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(255, 99, 132)'
      }]
    };

   //soort grafiek
    const config2 = {
        type: 'doughnut',
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
