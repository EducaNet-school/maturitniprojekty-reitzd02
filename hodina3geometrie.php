<?php
class form
{
    public $a;
    public $cislo;

    public function __construct($a,$cislo)
    {
        $this->a = $a;
        $this->cislo = $cislo;
    }
    public function input($cislo)
    {
        echo '<input type="number" cislo"' . $cislo . '" value "' . $this->a[$cislo] . '"> ';
    }
}
class  ctverec
{
    public $a;

    public function __construct($a)
    {
        $this->a = $a;
    }

    public function obvodC()
    {
        return $this->a * 4;
    }
    public function obsahC()
    {
        return $this->a * $this->a;
    }
}
class obdelnik
{
    public $a;
    public $b;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    public function obvodO()
    {
        return $this->a * 2 + $this->b * 2;
    }
    public function obsahO()
    {
        return $this->a * $this->b;
    }
}
class trojuhelnik
{
    public $a;
    public $b;

    public function __construct($a,$b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    public function obvodT()
    {
        return $this->a + $this->a  + $this->b;
    }
    public function obsahT()
    {
        return $this->a * $this->b /2;
    }
}
$ctverec1 = new ctverec(5);
echo "obvod ctverce je " . $ctverec1->obvodC();
echo "<br>";
echo "obsah ctverce je " . $ctverec1->obsahC();
echo "<br>";
$obdelnik1 = new obdelnik(5,3);
echo "obvod obdelnku je " . $obdelnik1->obvodO();
echo "<br>";
echo "obsah obdelniku je " . $obdelnik1->obsahO();
echo "<br>";
$trojuhelnik1 = new trojuhelnik(3,4);
echo "obvod rovnorameneho trojuhelniku je  " . $trojuhelnik1->obvodt();
echo "<br>";
echo "obsah rovnorameneho trojuhelniku je  " . $trojuhelnik1->obsaht();

?>