<?php

namespace App\Services\Searcher\Contracts;

/**
 * Interface SearcherInterface
 * @package App\Services\Searcher\Contracts
 */
interface SearcherInterface
{
    /**
     * @param string $param
     */
    public function search(string $param);
}
