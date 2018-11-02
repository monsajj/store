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

    /**
     * Find the product via the slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function show($slug)
    {
        $product = $this->product->with(['category','images'])->bySlug($slug)->first();

        return view('front.products.product', [
            'product' => $product
        ]);
    }
}
