<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Shop\Products\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
