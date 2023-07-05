<?php

abstract class Animal
{
    public $name;
    public $age;

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    abstract public function cloneAnimal();
}

class Cat extends Animal
{
    public function cloneAnimal()
    {
        return clone $this;
    }
}
class Dog extends Animal
{
    public function cloneAnimal()
    {
        return clone $this;
    }
}
$cat = new Cat;
$cat->setName('Lucy');
$cat->setAge(2);
print_r($cat);
$catClone = $cat->cloneAnimal();
print_r($catClone);
$catClone->setName('Kissy');
print_r($catClone);
