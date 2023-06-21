<?php

interface AbstractFactory
{
    public function createShirt();
    public function createPants();
}

class TShirtFactory implements AbstractFactory
{
    public function createShirt()
    {
        return new TShirt($size = "XL", $color = "RED");
    }
    public function createPants()
    {
        return new Jeans($size = "LG", $color = "BLK");
    }
}

class FormalShirtFactory implements AbstractFactory
{
    public function createShirt()
    {
        return new FormalShirt($size = "LG", $color = "GRAY");
    }
    public function createPants()
    {
        return new Trousers($size = "M", $color = "WHITE", $fit = "Skinny");
    }
}

abstract class Clothing
{
    protected $size;
    protected $color;

    public function __construct($size, $color)
    {
        $this->size = $size;
        $this->color = $color;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function getColor()
    {
        return $this->color;
    }
    abstract public function
    displayInfo();
}
class Shirt extends Clothing
{
    public $fabric;
    public function __construct($size, $color, $fabric)
    {
        parent::__construct($size, $color);
        $this->fabric = $fabric;
    }
    public function getFabric()
    {
        return $this->fabric;
    }
    public function
    displayInfo()
    {
        echo "Shirt Info: \n";
        echo "Size: " . $this->size . "\n";
        echo "Color: " . $this->color . "\n";
        echo "Fabric: " . $this->fabric . "\n";
    }
}

class Pants extends Clothing
{
    public $fit;

    public function __construct($size, $color, $fit)
    {
        parent::__construct($size, $color);
        $this->fit = $fit;
    }


    public function getSize()
    {
        return $this->size;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getFit()
    {
        return $this->fit;
    }
    public function
    displayInfo()
    {
        echo "Pants info: \n";
        echo "Size: " . $this->size . "\n";
        echo "Color: " . $this->color . "\n";
        echo "Fit: " . $this->fit . "\n";
    }
}


class TShirt extends Shirt
{
    public function __construct($size, $color, $fabric = "COTTON")
    {
        parent::__construct($size, $color, $fabric);
    }
}
class Jeans extends Pants
{
    public function __construct($size, $color, $fit = "SLIM")
    {
        parent::__construct($size, $color, $fit);
    }
}

class FormalShirt extends Shirt
{
    public function __construct($size, $color, $fabric = "FIBER")
    {
        parent::__construct($size, $color, $fabric);
    }
}


class Trousers extends Pants
{
    public function __construct($size = "XXL", $color = "YELLOW", $fit = "SK")
    {
        $this->size = $size;
        $this->color = $color;
        $this->fit = $fit;
    }
}


function displayClothingDetails(AbstractFactory $factory)
{
    $shirt = $factory->createShirt();
    $pants = $factory->createPants();

    // echo 'hello';
    echo $pants->displayInfo();
}
$tshirtFactory = new TShirtFactory;
$formalShirtFactory = new FormalShirtFactory;
displayClothingDetails($formalShirtFactory);
// $tshirtFactory->create