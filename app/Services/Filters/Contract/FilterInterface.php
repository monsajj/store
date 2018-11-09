<?php

namespace App\Services\Filters\Contract;

use Illuminate\Support\Collection;

/**
 * Interface FilterInterface
 * @package App\Services\Filters\Contract
 */
interface FilterInterface
{
    /**
     * @param Collection $collection
     * @return Collection
     */
    public function filter(Collection $collection): Collection;

    public function sortBy(Collection $collection): Collection;
}
