<?php
    require_once("curl_helper.php");
    $action = "GET";
    $url = "http://localhost:5555";
    echo "Trying to reach ...";
    echo $url;
    $parameters = array("param" => "value");
    $result = CurlHelper::perform_http_request($action, $url, $parameters);
    echo "<br><br>RESULT => ";

    $actualResult = json_encode($result);

    echo $actualResult;
?>