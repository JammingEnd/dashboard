<?php
// This class has all the necessary code for making API calls thru curl library
class CurlHelper {

    // This method will perform an action/method thru HTTP/API calls
    // Parameter description:
    // Method= POST, PUT, GET etc
    // Data= array("param" => "value") ==> index.php?param=value
    public static function perform_http_request($method, $url, $data = false)
    {
        $curl = curl_init();
    
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
    
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    
        // Optional Authentication:
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "X-App-Token:ZHyla6oL2CtRsybgVkYK37Zsd");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        curl_close($curl);
    
        return $result;
    }

    public static function getFileContents($url, ) {
        $url = $url . "?%24limit=5000&%24%24app_token=ZHyla6oL2CtRsybgVkYK37Zsd";

        $opts = array (
            'http' => array (
                'method' => 'GET',
                'header'=> "X-App-Token: ZHyla6oL2CtRsybgVkYK37Zsd",
                )
            );
        $context  = stream_context_create($opts);


        $result = file_get_contents($url, false, $context);

        return $result;

    }
    
    }
?>