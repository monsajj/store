<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Filters\Factory;
use App\Services\Searcher\Contracts\SearcherInterface;
use App\Services\Searcher\ProductSearcher;
use App\Shop\Categories\DataCollector\CategoryCollector;

class SearchController extends Controller
{

    /**
     * @var ProductSearcher
     */
    private $searcher;

    /**
     * SearchController constructor.
     * @param ProductSearcher $searcher
     */
    public function __construct(ProductSearcher $searcher)
    {
        $this->searcher = $searcher;
    }


    /**
     * @param Request $request
     */
    public function search(Request $request, CategoryCollector $categoryCollector)
    {
        $categories = $categoryCollector->collect($request->search);
        echo ($request->search);
        dump($this->searcher->search($request->search));
        dd($categories->toArray());
    }
}
