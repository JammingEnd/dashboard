<?php 

class Voertuigen {

    public static $voertuigenCache = [];

    public static function addVoertuig($apiReponse, $cache = false) {
        if (gettype($apiReponse) == "array") return self::addVoertuigen($apiReponse, $cache);
        $kenteken = null;
        $voertuigsoort = null;
        $merk = null;
        $handelsbenaming = null;
        $inrichting = null;
        $aantalCilinders = null;
        $variant = null;
        $eersteKleur = null;
        $datumEersteToelating = null;        

        if (property_exists($apiReponse, "kenteken")) {
            $kenteken = $apiReponse->kenteken; 
        }

        if (property_exists($apiReponse, "voertuigsoort")) {
            $voertuigsoort = $apiReponse->voertuigsoort; 
        }

        if (property_exists($apiReponse, "merk")) {
            $merk = $apiReponse->merk; 
        }

        if (property_exists($apiReponse, "handelsbenaming")) {
            $handelsbenaming = $apiReponse->handelsbenaming; 
        }

        if (property_exists($apiReponse, "inrichting")) {
            $inrichting = $apiReponse->inrichting; 
        }

        if (property_exists($apiReponse, "aantal_cilinders")) {
            $aantalCilinders = $apiReponse->aantal_cilinders;
        }

        if (property_exists($apiReponse, "variant")) {
            $variant = $apiReponse->variant;
        }

        if (property_exists($apiReponse, "eerste_kleur")) {
            $eersteKleur = $apiReponse->eerste_kleur;
        }

        if (property_exists($apiReponse, "datum_eerste_toelating")) {
            $eersteToeLating = $apiReponse->datum_eerste_toelating;
        }

        $newVoertuig = new Voertuig(
            $kenteken, 
            $voertuigsoort, 
            $merk, 
            $handelsbenaming, 
            $inrichting, 
            $aantalCilinders, 
            $variant, 
            $eersteKleur,
            $datumEersteToelating);

        if ($cache) {
            array_push(self::$voertuigenCache, array($newVoertuig->getKenteken() => $newVoertuig));
        }
        return $newVoertuig;
    }

    public static function addVoertuigen($apiReponse, $cache = false) {
        if (gettype($apiReponse) != "array") return self::addVoertuig($apiReponse, $cache);
        $dataArray = [];
        foreach ($apiReponse as $res) {
            array_push($dataArray, self::addVoertuig($res, $cache));
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

    public function getPropByName($prop) {
        if (gettype($prop) != "string") return null;
        switch ($prop) {
            case "kenteken":
                return $this->getKenteken();
            case "voertuigsoort":
                return $this->getVoertuigSoort();
            case "merk":
                return $this->getVoertuigSoort();
            case "handelsbenaming":
                return $this->getHandelsBenaming();
            case "inrichting":
                return $this->getInrichting();
            case "aantalcilinders":
                return $this->getAantalCilinders();
            case "variant": 
                return $this->getVariant();
            case "eerstekleur":
                return $this->getEersteKleur();
            case "eerstetoelating":
                return $this->getEersteToeLating();
            default:
                return null;
        }
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
