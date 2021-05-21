<!DOCTYPE html>
<html lang="en">
<?php
$woonplaatsen = array('Sneek', 'Bolsward', 'Sint Nicolaasga', 'Overig');
$aantallen = array(50, 1257, 3345, 1567, 897, 34, 12);
$aantallen2 = array(30, 1567, 3045, 1787, 497, 56, 45);
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
  <canvas id="test"></canvas>
  </div>

<script type="text/javascript">
 
 var een_lijstJS = <?php echo json_encode($aantallen) ?>;
  var een_lijstJS2 = <?php echo json_encode($aantallen2) ?>;

//labels veranderen naar de opgevraagde data

   const data = {
   labels: [
  '2cc',
  '4cc',
  '6cc',
  '8cc',
  'electric',
  'hydrogen',
  'else'
],

datasets: [{
  label: 'Mercedes',
  data: een_lijstJS,
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
type: 'radar',
data: data,
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
        <canvas id="Dia2"></canvas>
    </div>

<script type="text/javascript">
var dataDiagram2 = <?php echo json_encode($aantallenDiagram2) ?>;  
var labelDiagram2 = <?php echo json_encode($labelDriagram2)    ?>

//labels veranderen naar de opgevraagde data


    const labels = labelDiagram2;

    //data
    const data2 = {
        labels: labels,
        datasets: [{
            label: 'tweede diagram',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: dataDiagram2,
        }]
    };

   //soort grafiek
    const config2 = {
        type: 'line',
        data,
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
