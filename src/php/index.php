<?php
$padding = 20;
if (array_key_exists("error1", $_GET)) {
    $padding -= 5;
}
if (array_key_exists("error2", $_GET)) {
    $padding -= 5;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>RDW - Dashboard</title>
</head>

<body>
    <div class="text-center align-middle" style="padding-top: <?php echo $padding ?>%;">
    <?php 
    if (array_key_exists("error1", $_GET)) {
        echo "<div class='alert alert-dismissible alert-danger center-div text-center' style='max-width: 30rem;'>
        <strong>Er is wat fout gegaan!</strong> Geen kenteken gegeven.</a>
        </div>";
    }
    if (array_key_exists("error2", $_GET)) {
        echo "<div class='alert alert-dismissible alert-danger center-div text-center' style='max-width: 30rem; margin-top:15px'>
        <strong>Er is wat fout gegaan!</strong> Kan gegeven kenteken niet vinden.</a>
        </div>";
    }
    ?> 
        <form action="./kentekeninfo.php" method="POST">
            <fieldset>
                <legend>Kenteken</legend>
            </fieldset>
            <div class="form-group">
                <input id="kenteken" type="text" placeholder="1ABC23" name="kenteken" class="form-label mt-4" style="text-transform:uppercase;">
            </div>
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Search</button>
        </form>
    </div>
</body>

</html>