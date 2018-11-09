<?php

namespace App\Shop\Categories\Filters;

use App\Services\Filters\Filter;
use App\Shop\Categories\Category;
use Illuminate\Support\Collection;

/**
 * Class ByCategoryNameLength
 * @package App\Shop\Categories\Filters
 */
final class ByCategoryNameLength extends Filter
{
    const MAXIMUM_CATEGORY_NAME_LENGTH = 25;

    /**
     * @return callable
     */
    protected function getAlgorithm(): callable
    {
        return function (Category $category) {
            return strlen($category->name) < self::MAXIMUM_CATEGORY_NAME_LENGTH;
        };
    }

    protected function getSorted(Collection $collection)
    {
        return $collection->sortBy('name');
    }
}
