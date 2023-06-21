<?php
interface AbstractFactory
{
    public function createGpu();
    public function createMonitor();
}

class MSIFactory implements AbstractFactory
{
    public function createGpu()
    {
        return new MSIGpu;
    }
    public function createMonitor()
    {
        return new MSIMonitor;
    }
}
class AsusFactory implements AbstractFactory
{
    public function createGpu()
    {
        return new AsusGpu;
    }
    public function createMonitor()
    {
        return new AsusMonitor;
    }
}

interface Gpu
{
    public function update();
}
interface monitor
{
    public function powerOn();
}

class MSIGpu implements Gpu
{
    public function update()
    {
        echo "Your MSI GPU updated successfully.";
    }
}
class MSIMonitor implements monitor
{
    public function powerOn()
    {
        echo "MSI Monitor Turned ON";
    }
}
class AsusGpu implements Gpu
{
    public function update()
    {
        echo "Your Asus GPU updated successfully.";
    }
}
class AsusMonitor implements monitor
{
    public function powerOn()
    {
        echo "Asus Monitor Turned ON";
    }
}

$factory = new MSIFactory;
$gpu = $factory->createGpu();
$gpu->update();
