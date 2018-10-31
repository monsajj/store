<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Shop\Products\Product;
use App\Http\Controllers\Controller;
use App\Shop\Categories\Category;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var Category
     */
    private $categories;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product, Category $categories)
    {
        $this->product = $product;
        $this->categories = $categories;
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
        $product = $this->product->with(['category','images'])->where('slug', $slug)->first();
        $category = $product->category()->first();
        $categories = $this->categories->parent()->get();


        return view('front.products.product', [
            'product' => $product,
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
