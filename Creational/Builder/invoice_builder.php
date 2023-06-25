<?php
class Invoice
{
    private $name;
    private $product = [];
    private $address;


    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setProduct($product)
    {
        $this->product[] = $product;
    }
    public function getProduct()
    {
        return $this->product;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }
}

class InvoiceBuilder
{
    public $invoice;
    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    public function setName($name)
    {
        $this->invoice->setName($name);
    }
    public function setProduct($product)
    {
        $this->invoice->setProduct($product);
    }
    public function setAddress($address)
    {
        $this->invoice->setAddress($address);
    }
    public function getInvoice()
    {
        return $this->invoice;
    }
}

$invoice = new InvoiceBuilder;
$invoice->setName("Amr Ahmed");
$invoice->setProduct('Product 1');
$invoice->setProduct('Product 2');
$invoice->setProduct('Product 3');
$invoice->setAddress("Nabeel Khalel");
$new = $invoice->getInvoice();
// print_r($new->product);
foreach ($new->getProduct() as $p) {
    echo $p;
}
