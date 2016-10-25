<?php
namespace App\Libraries\Payment;

class Payment
{
    private $mount;
    private $items = array();
    //private $model;

    public function __construct()
    {
        //$this->model = new PaymentRepository();
    }

    public function setCalculateMount($item){
        $mount = 0;
        $mount = $mount + $item;
        return $mount;
    }

    public function getCalculateMount(){
        return $this->mount;
    }

    public function addItems($item){
        $items[] = $item;
    }

    public function getItems(){
        return $this->items;
    }

}