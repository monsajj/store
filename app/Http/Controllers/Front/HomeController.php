<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop\Categories\Category;

class HomeController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * HomeController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        //$this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->with(['images', 'subCategories'])->parent()->get();

        return view('front.index', [
            'categories' => $categories
        ]);
    }
}
