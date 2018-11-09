<?php

namespace App\Services\Filters\Contract;

/**
 * Interface CompositeInterface
 * @package App\Services\Filters\Contract
 */
interface CompositeInterface
{
    /**
     * @param FilterInterface $filter
     * @return mixed
     */
    public function addFilter(FilterInterface $filter);
}