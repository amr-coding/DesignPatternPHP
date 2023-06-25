<?php
abstract class AbstractFactory
{
    public function createAnimal()
    {
        return new Animal;
    }
    public function createHabitat()
    {
        return new Habitat;
    }
}

interface Animal
{

    public function getName();
}

interface Habitat
{
    public function getDescription();
}

class LandAnimalFactory extends AbstractFactory
{
    public function createAnimal()
    {
        return new LandAnimal;
    }
    public function createHabitat()
    {
        return new LandHabitat;
    }
}
class AquaticAnimalFactory extends AbstractFactory
{
    public function createAnimal()
    {
        return new AquaticAnimal;
    }
    public function createHabitat()
    {
        return new AquaticHabitat;
    }
}

class LandAnimal implements Animal
{
    // public $name;
    public function getName()
    {
        echo "Donkey";
    }
}

class LandHabitat implements Habitat
{
    public function getDescription()
    {
        echo "This is land habitat description";
    }
}

class AquaticAnimal implements Animal
{
    public function getName()
    {
        echo "New Fish";
    }
}
class AquaticHabitat implements Habitat
{
    public function getDescription()
    {
        echo "This is aquatic description";
    }
}

$animal = new LandAnimalFactory;
$new = $animal->createAnimal();
echo $new->getName();
