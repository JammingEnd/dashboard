<!DOCTYPE html>
<html>
<head>
<style>
.propContainer
{
margin: auto;
padding: 3px;
background-color: grey;
}
.KenmerkCanvas{
    margin-left: 10px;
    width: 200px;
    height: auto;
    padding: 2px;
background-color: aqua;
}

</style>

</head>
<body>
<?php include('PHP/Nav.php'); $

// adding a loop through the method

$value1 = $_POST['prop1'];
$value2 = $_POST['prop2'];

$filterArray = array($value1, $value2);
?>
<div class="filterCanvas">
<?php

for ($i=0; $i < sizeof($filterArray); $i++) {  ?> 
<div class="propContainer">
     <?php echo $'value +  $i'; ?> 
</div>
<?php

}
?>

</div>

<form method="post">
 <div class="KenmerkCanvas">
 <input type="checkbox" class="propContainer" name="prop1" value=0>
 <label for="propContainer1"> een toyota </label>

 <input type="checkbox" class="propContainer" name="prop2" value=1>
 <label for="propContainer2"> 180 cilinders </label>


<div class="KernmerkButton">
<!-- button for confirmation -->

</div>
</div>
</form>
</body>

</html>
