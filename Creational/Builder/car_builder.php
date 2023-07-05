<?php

class Car
{
    public $make;
    public $model;
    public $color;
    public $engineType;


    public function setMake($make)
    {
        $this->make = $make;
    }
    public function getMake()
    {
        return $this->make;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function setEngineType($type)
    {
        $this->engineType = $type;
    }
    public function getEngineType()
    {
        return $this->engineType;
    }
}

class CarBuilder
{
    private $car;
    public function __construct()
    {
        $this->car = new Car();
    }
    public function setMake($make)
    {
        $this->car->setMake($make);
    }
    public function setColor($color)
    {
        $this->car->setColor($color);
    }
    public function setModel($model)
    {
        $this->car->setModel($model);
    }
    public function setEngineType($type)
    {
        $this->car->setEngineType($type);
    }

    public function getCar()
    {
        return $this->car;
    }
}

$builder = new CarBuilder();
$builder->setMake("BMW");
$builder->setModel("X6");
$builder->setColor("Black");
$car = $builder->getCar();

echo $car->getColor();
echo $car->getMake();
echo $car->getModel();
