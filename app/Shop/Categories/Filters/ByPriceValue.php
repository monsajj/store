<?php

namespace App\Shop\Categories\Filters;

use App\Services\Filters\Filter;
use App\Shop\Categories\Category;
use App\Shop\Products\Product;
use Illuminate\Support\Collection;

/**
 * Class ByPriceValue
 * @package App\Shop\Categories\Filters
 */
final class ByPriceValue extends Filter
{
    const MIM_PRODUCT_PRICE = 100;

    /**
     * @return callable
     */
    protected function getAlgorithm(): callable
    {
        return function (Category $category) {
            $products = $category->products;
            /**
             * @var Collection $filteredProducts
             */
            $filteredProducts = $products->filter(function (Product $product) {
                return $product->price > self::MIM_PRODUCT_PRICE;
            });
            return $filteredProducts->isNotEmpty();
        };
    }

    protected function getSorted(Collection $collection)
    {
        return $collection->sortBy('price');
    }
}
