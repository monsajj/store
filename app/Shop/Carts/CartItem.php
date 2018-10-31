<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 31.10.18
 * Time: 13:55
 */

namespace App\Shop\Carts;


class CartItem
{
    public $id;
    public $name;
    public $count;
    public $price;
    public $total;

    public function __construct($id, $name, $count, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->count = $count;
        $this->price = $price;
        $this->total = $price * $count;
    }
}
