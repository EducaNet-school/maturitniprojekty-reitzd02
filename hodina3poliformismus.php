<?php
class auto{
    public $typ;
    public $znacka;

    public function __construct($typ,$znacka){
        $this->typ = $typ;
        $this->znacka = $znacka;
    }

    public function getInfo(){
        return $this->znacka . " " . $this->typ;
    }
}
class nakladak extends auto{
    public $nosnost;

    public function __construct($typ,$znacka,$nosnost){
        auto::__construct($typ,$znacka);
        $this->nosnost = $nosnost;
    }
    public function getNosnost(){
        return $this->znacka . " " . $this->typ . " " . $this->nosnost;
    }
}
class e_auto extends auto{
    public $dojezd;

    public function __construct($typ,$znacka,$dojezd){
        auto::__construct($typ,$znacka);
        $this->dojezd = $dojezd;
    }
    public function getDojezd(){
        return $this->znacka . " " . $this->typ . " " . $this->dojezd . " km";
    }
}
$autaArray = array();
$autoArray[] = new auto("auto", "Mercedes");
$autoArray[] = new nakladak("nakladak", "hundai", 5);
$autoArray[] = new e_auto("eAuto", "Tesla", 500);

foreach($autoArray as $auto) {
    print_r(get_object_vars($auto));
    echo "\n";
}
?>