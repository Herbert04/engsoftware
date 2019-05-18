<?php

class Geolocation {

    public $id;
    public $idPedido;
    public $IP;
    public $continent_code;
    public $continent_name;
    public $country_code2;
    public $country_code3;
    public $country_name;
    public $country_capital;
    public $state_prov;
    public $district;
    public $city;
    public $zipcode;
    public $latitude;
    public $longitude;
    public $is_eu;
    public $calling_code;
    public $country_tld;
    public $languages;
    public $country_flag;
    public $connection_type;
    public $organization;
    public $geoname_id;

    public static function create($idPedido, $IP, $continent_code, $continent_name, $country_code2, $country_code3, $country_name, $country_capital, $state_prov, $district, $city, $zipcode, $latitude, $longitude, $is_eu, $calling_code, $country_tld, $languages, $country_flag, $connection_type, $organization, $geoname_id) {
        $instancie = new self();
        $instancie->idPedido = $idPedido;
        $instancie->IP = $IP;
        $instancie->continent_code = $continent_code;
        $instancie->continent_name = $continent_name;
        $instancie->country_code2 = $country_code2;
        $instancie->country_code3 = $country_code3;
        $instancie->country_name = $country_name;
        $instancie->country_capital = $country_capital;
        $instancie->state_prov = $state_prov;
        $instancie->district = $district;
        $instancie->city = $city;
        $instancie->zipcode = $zipcode;
        $instancie->latitude = $latitude;
        $instancie->longitude = $longitude;
        $instancie->is_eu = $is_eu;
        $instancie->calling_code = $calling_code;
        $instancie->country_tld = $country_tld;
        $instancie->languages = $languages;
        $instancie->country_flag = $country_flag;
        $instancie->connection_type = $connection_type;
        $instancie->organization = $organization;
        $instancie->geoname_id = $geoname_id;

        return $instancie;
    }

    function __construct() {
        $this->id;
        $this->idPedido = "";
        $this->IP = "";
        $this->continent_code = "";
        $this->continent_name = "";
        $this->country_code2 = "";
        $this->country_code3 = "";
        $this->country_name = "";
        $this->country_capital = "";
        $this->state_prov = "";
        $this->district = "";
        $this->city = "";
        $this->zipcode = "";
        $this->latitude = "";
        $this->longitude = "";
        $this->is_eu = "";
        $this->calling_code = "";
        $this->country_tld = "";
        $this->languages = "";
        $this->country_flag = "";
        $this->connection_type = "";
        $this->organization = "";
        $this->geoname_id = "";
    }

    public function insert($conn) {
        $sql = "INSERT INTO geolocation(idPedido, IP, continent_code, continent_name, country_code2, country_code3, country_name, country_capital, state_prov, district, city, zipcode, latitude, longitude, is_eu, calling_code, country_tld, languages, country_flag, connection_type, organization, geoname_id) VALUES (:idPedido, :IP, :continent_code, :continent_name, :country_code2, :country_code3, :country_name, :country_capital, :state_prov, :district, :city, :zipcode, :latitude, :longitude, :is_eu, :calling_code, :country_tld, :languages, :country_flag, :connection_type, :organization, :geoname_id)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idPedido', $this->idPedido);
        $stmt->bindParam(':IP', $this->IP);
        $stmt->bindParam(':continent_code', $this->continent_code);
        $stmt->bindParam(':continent_name', $this->continent_name);
        $stmt->bindParam(':country_code2', $this->country_code2);
        $stmt->bindParam(':country_code3', $this->country_code3);
        $stmt->bindParam(':country_name', $this->country_name);
        $stmt->bindParam(':country_capital', $this->country_capital);
        $stmt->bindParam(':state_prov', $this->state_prov);
        $stmt->bindParam(':district', $this->district);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':zipcode', $this->zipcode);
        $stmt->bindParam(':latitude', $this->latitude);
        $stmt->bindParam(':longitude', $this->longitude);
        $stmt->bindParam(':is_eu', $this->is_eu);
        $stmt->bindParam(':calling_code', $this->calling_code);
        $stmt->bindParam(':country_tld', $this->country_tld);
        $stmt->bindParam(':languages', $this->languages);
        $stmt->bindParam(':country_flag', $this->country_flag);
        $stmt->bindParam(':connection_type', $this->connection_type);
        $stmt->bindParam(':organization', $this->organization);
        $stmt->bindParam(':geoname_id', $this->geoname_id);



        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }

    public static function capturaIP() {
        $capturandoIp = 'http://ipinfo.io/';
        return $capturandoIp;
    }

    public static function caputarLocalPrincipal($conn, $idPedido) {


        $capturandoIp = Geolocation::capturaIP();
        $ch = curl_init($capturandoIp);
        $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=61a9acc5a052402b8a18e6601bdbaaf6&ip=' . $ch['ip'];
        $ch_ = curl_init($url);
        curl_setopt($ch_, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch_);
        curl_close($ch_);
        $array = json_decode($data, TRUE);
        $local = Geolocation::create($idPedido, $array['ip'], $array['continent_code'], $array['continent_name'], $array['country_code2'], $array['country_code3'], $array['country_name'], $array['country_capital'], $array['state_prov'], $array['district'], $array['city'], $array['zipcode'], $array['latitude'], $array['longitude'], $array['is_eu'], $array['calling_code'], $array['country_tld'], $array['languages'], $array['country_flag'], $array['connection_type'], $array['organization'], $array['geoname_id']);
        return $local->insert($conn);
    }

    public static function caputarLocalSecundario($conn, $idPedido) {
        $url = Geolocation::capturaIP();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);

        $array = json_decode($data, TRUE);
        $lat_log = explode(',', $array['loc']);

        $local = Geolocation::create($idPedido, $array['ip'], '', '', '', $array['country'], '', '', '', '', $array['city'], $array['postal'], $lat_log[0], $lat_log[1], '', '', '', '', '', '', $array['org'], '');
        return $local->insert($conn);
    }

}

?>