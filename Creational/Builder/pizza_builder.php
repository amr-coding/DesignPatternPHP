<?php
class Pizza
{
    public $size;
    public $crust;
    public $toppings;
    public $extra;

    public function setSize($size)
    {
        $this->size = $size;
    }
    public function setCrust($crust)
    {
        $this->crust = $crust;
    }
    public function setToppings($toppings)
    {
        $this->toppings = $toppings;
    }
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }
}

class PizzaBuilder
{
    public $pizza;
    public function __construct()
    {
        $this->pizza = new Pizza;
    }
    public function setSize($size)
    {
        $this->pizza->setSize($size);
    }
    public function setCrust($crust)
    {
        $this->pizza->setCrust($crust);
    }
    public function setToppings($toppings)
    {
        $this->pizza->setToppings($toppings);
    }
    public function setExtra($extra)
    {
        $this->pizza->setExtra($extra);
    }
    public function getPizza()
    {
        return $this->pizza;
    }
}

$pizza = new PizzaBuilder;
$pizza->setSize('Large');
$pizza->setCrust('Thick');
$pizza->setToppings('Chicken');
$pizza->getPizza();
// print_r($pizza->getPizza());

foreach ($pizza->getPizza() as $p) {
    print_r($p);
    echo "<br>";
}
