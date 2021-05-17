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
    <div class="text-center align-middle" style="height: 50%;">
        <form action="../server/server.php" method="POST">
            <fieldset>
                <legend>Kenteken</legend>
            </fieldset>
            <div class="form-group">
                <input type="text" placeholder="1ABC23" name="kenteken" class="form-label mt-4">
            </div>
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Search</button>
        </form>
    </div>
</body>

</html>