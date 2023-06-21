<?php
interface FurnitureFactory
{
    public function createChair();
    public function createTable();
    public function createBed();
}
class VictorianFactory implements FurnitureFactory
{
    public function createChair()
    {
        return new VictorianChair;
    }
    public function createTable()
    {
        return new VictorianTable;
    }
    public function createBed()
    {
        return new VictorianBed;
    }
}
class ModernFactory implements FurnitureFactory
{
    public function createChair()
    {
        return new ModernChair;
    }
    public function createTable()
    {
        return new ModernTable;
    }
    public function createBed()
    {
        return new ModernBed;
    }
}

interface Chair
{
    public function sitOn();
}
interface Table
{
    public function putSomething($type);
}
interface Bed
{
    public function sleepOn();
}
class VictorianChair implements Chair
{
    public function sitOn()
    {
        echo "Sitting on a Victorian Chair";
    }
}
class VictorianTable implements Table
{
    public function putSomething($type)
    {
        echo "Putting " . $type . " on the table";
    }
}
class VictorianBed implements Bed
{
    public function sleepOn()
    {
        echo "Sleeping on the bed";
    }
}
class ModernChair implements Chair
{
    public function sitOn()
    {
        echo "Sitting on a Modern Chair";
    }
}
class ModernTable implements Table
{
    public function putSomething($type)
    {
        echo "Putting " . $type . " on the table";
    }
}
class ModernBed implements Bed
{
    public function sleepOn()
    {
        echo "Sleeping on the bed";
    }
}


$victorianFactory = new VictorianFactory;
$vChair = $victorianFactory->createChair();
$vChair->sitOn();
