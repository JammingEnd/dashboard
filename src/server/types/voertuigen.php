<?php 

class Voertuigen {

    public static $voertuigen = [];

    public static function addVoertuig($apiReponse, $cache = false) {
        if (gettype($apiReponse) == "array") return self::addVoertuigen($apiReponse, $cache);
        
        $newVoertuig = new Voertuig(
            $apiReponse->kenteken, 
            $apiReponse->voertuigsoort, 
            $apiReponse->merk, 
            $apiReponse->handelsbenaming, 
            $apiReponse->inrichting, 
            $apiReponse->aantal_cilinders, 
            $apiReponse->variant, 
            $apiReponse->eerste_kleur,
            $apiReponse->datum_eerste_toelating);

        if ($cache) {
            array_push(self::$voertuigen, $newVoertuig);
        }
        return $newVoertuig;
    }

    public static function addVoertuigen($apiReponse, $cache = false) {
        if (gettype($apiReponse) != "array") return self::addVoertuig($apiReponse, $cache);
        $dataArray = [];
        foreach ($apiReponse as $res) {
            array_push($dataArray, self::addVoertuig($res));
        }

        return $dataArray;
    }

}

class Voertuig {
    private $_kenteken;
    private $_voertuigsoort;
    private $_merk;
    private $_handelsbenaming;
    private $_inrichting;
    private $_aantalCilinders;
    private $_variant;
    private $_eersteKleur;
    private $_eersteToeLating;
    private $_lastUpdated;

    public function __construct($kenteken, $voertuigsoort, $merk, $handelsbenaming, $inrichting, $aantalCilinders, $variant, $eersteKleur, $eersteToeLating) {
        $this->_kenteken = $kenteken;
        $this->_voertuigsoort = $voertuigsoort;
        $this->_merk = $merk;
        $this->_handelsbenaming = $handelsbenaming;
        $this->_inrichting = $inrichting;
        $this->_aantalCilinders = $aantalCilinders;
        $this->_variant = $variant;
        $this->_eersteKleur = $eersteKleur;
        $this->_eersteToeLating = $eersteToeLating;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
        return $this;
    }

    public function getKenteken() {
        return $this->_kenteken;
    }

    public function setKenteken($kenteken) {
        $this->_kenteken = $kenteken;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getVoertuigSoort() {
        return $this->_voertuigsoort;
    }

    public function setVoertuigSoort($voertuigsoort) {
        $this->_voertuigsoort = $voertuigsoort;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getMerk() {
        return $this->_merk;
    }

    public function setMerk($merk) {
        $this->_merk = $merk;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getHandelsBenaming() {
        return $this->_handelsbenaming;
    }

    public function setHandelsBenaming($handelsbenaming) {
        $this->_handelsbenaming = $handelsbenaming;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getInrichting() {
        return $this->_inrichting;
    }

    public function setInrichting($inrichting) {
        $this->_inrichting = $inrichting;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getAantalCilinders() {
        return $this->_aantalCilinders;
    }

    public function setAantalCilinders($aantalCilinders) {
        $this->_aantalCilinders = $aantalCilinders;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getVariant() {
        return $this->_variant;
    }

    public function setVariant($variant) {
        $this->_variant = $variant;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getEersteKleur() {
        return $this->_eersteKleur;
    }

    public function setEersteKleur($eersteKleur) {
        $this->_eersteKleur = $eersteKleur;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }

    public function getEersteToeLating() {
        return $this->_eersteToeLating;
    }

    public function setEersteToeLating($eersteToeLating) {
        $this->_eersteToeLating = $eersteToeLating;
        $this->_lastUpdated = $_SERVER['REQUEST_TIME'];
    }
}

?>
