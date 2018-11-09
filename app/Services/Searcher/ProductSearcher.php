<?php

namespace App\Services\Searcher;

use App\Services\Searcher\Contracts\SearcherInterface;
use App\Shop\Products\Product;
use Illuminate\Support\Collection;

class ProductSearcher implements SearcherInterface
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductSearcher constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param string $param
     * @return mixed
     */
    public function search(string $param)
    {
        return $this->searchProductByName($param);
    }

    /**
     * @param string $param
     * @return mixed
     */
    private function searchProductByName(string $param)
    {
        return $this->product->where([
            ['name', 'LIKE', '%' . $param . '%']
        ])->get()->sortBy('price')->sortBy('category_id')->toArray();
    }
}
