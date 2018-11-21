<?php

namespace App\Shop\Categories\DataCollector;

use App\Services\Filters\Contract\FilterInterface;
use App\Services\Filters\Exceptions\FilterBuildingException;
use App\Services\Filters\Factory as FilterFactory;
use App\Shop\Categories\Category;
use App\Shop\Products\Product;
use Illuminate\Support\Collection;

/**
 * Class CategoryCollector
 * @package App\Shop\Categories\DataCollerctor
 */
class CategoryCollector
{
    const FILTER_ALIAS = 'test-category';

    /**
     * @var FilterFactory
     */
    private $filterFactory;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var Product
     */
    private $product;

    /**
     * CategoryCollector constructor.
     * @param FilterFactory $filterFactory
     * @param Category $category
     * @param Product $product
     */
    public function __construct(FilterFactory $filterFactory, Category $category, Product $product)
    {
        $this->filterFactory = $filterFactory;
        $this->category = $category;
        $this->product = $product;
    }


    /**
     * @param $param
     * @return \Illuminate\Support\Collection
     */
    public function collect($param)
    {
        $products = $this->getProducts($param);
        return $products;
//        dd($products);
//        try {
//            $filter = $this->getFilter();
//            return $filter->filter($products);
//        } catch (FilterBuildingException $exception) {
//            return $products;
//        }

//        $categories = $this->getCategories();
//        try {
//            $filter = $this->getFilter();
//            return $filter->filter($categories);
//        } catch (FilterBuildingException $exception) {
//            return $categories;
//        }
    }

    /**
     * @return FilterInterface
     * @throws \App\Services\Filters\Exceptions\FilterBuildingException
     */
    private function getFilter(): FilterInterface
    {
        return $this->filterFactory->buildFilter(self::FILTER_ALIAS);
    }

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getCategories()
    {
        return $this->category->where([])->with('products')->get();
    }

    /**
     * @param $param
     * @return mixed
     */
    private function getProducts($param)
    {

        $products = $this->product->all();
        $productsSortedByPrice = $products->sortBy('price');
        $productsSortedByPriceAndGroupByCategory = $productsSortedByPrice->groupBy('category_id')->all();
        ksort($productsSortedByPriceAndGroupByCategory);
        $productsCollect = collect($productsSortedByPriceAndGroupByCategory);
        $productsCollectCollapse = $productsCollect->collapse();
        return $productsCollectCollapse;
//        return $this->product->where([
//            ['name', 'LIKE', '%' . $param . '%']
//        ])->get();
    }

    private function sortByCategoryName(Collection $collection)
    {
        return $collection->sortBy('name');
    }

    private function sortByPriceValue(Collection $collection)
    {
        return $collection->sortBy('price');
    }
}
