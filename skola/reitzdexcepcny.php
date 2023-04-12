class Film {
private $nazev;
private $cena;
private $minimalniVek;

public function __construct($nazev, $cena, $minimalniVek) {
$this->nazev = $nazev;
$this->cena = $cena;
$this->minimalniVek = $minimalniVek;
}

public function getCena() {
return $this->cena;
}

public function getMinimalniVek() {
return $this->minimalniVek;
}
}

class Divak {
private $vek;
private $penize;

public function __construct($vek, $penize) {
$this->vek = $vek;
$this->penize = $penize;
}

public function getVek() {
return $this->vek;
}

public function getPenize() {
return $this->penize;
}
}

class Kino {
public static function ProdejListku(Film $film, Divak $divak) {
if ($divak->getVek() < $film->getMinimalniVek()) {
    throw new CustomerTooYoungException("Divák je příliš mladý pro tento film");
    }

    if ($divak->getPenize() < $film->getCena()) {
        throw new MissingMoneyException("Divák nemá dostatek peněz pro koupi lístku");
        }

        echo "Prodáno";
        }
        }

        class CustomerTooYoungException extends Exception {}

        class MissingMoneyException extends Exception {}

        try {
        $film = new Film("Matrix", 150, 18);
        $divak = new Divak(17, 100);
        Kino::ProdejListku($film, $divak);
        } catch (CustomerTooYoungException $e) {
        echo "Chyba: " . $e->getMessage();
        } catch (MissingMoneyException $e) {
        echo "Chyba: " . $e->getMessage();
        }