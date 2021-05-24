<?php
    require_once("curl_helper.php");
    require_once("types/voertuigen.php");
    $action = "GET";
    $url = "https://opendata.rdw.nl/resource/m9d7-ebf2.json";
    echo "Trying to reach ...";
    echo $url;
    $parameters = array("kenteken" => "1KBB00");
    $results = CurlHelper::getFileContents($url, $parameters);
    echo "<br><br>RESULT => <br><br>";

    // echo $results;

    Voertuigen::addVoertuig(json_decode($results));



    echo "<br><br><br>";

    var_dump(Voertuigen::$voertuigen[0]->getKenteken());


    // echo "<br><br><br>";



?>