<?php 



class KentekenData {
    
    private $_kenteken;

    public static function init($kenteken) {
        $this->$_kenteken = $kenteken;
        echo 1;
        echo $this->$_kenteken;
    }

    public static function getKenteken() {
        return $this->$_kenteken;
    }    
}

$data = new KenTekenData();


$data::init($_POST["kenteken"]);

echo $data::getKenteken();

?>