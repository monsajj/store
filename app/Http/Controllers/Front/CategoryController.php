<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Categories\Category;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryController constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }


//    public function getCategory(string $slug)
//    {
//        $categories = $this->category->with(['products','images'])->get();
//        $parentCategories = $categories->where('parent_id', null);
//        $category = $categories->where('slug', $slug)->first();
//
//        return view('front.categories.category', [
//            'categories' => $parentCategories,
//            'category' => $category
//        ]);
//    }

    /**
     * Find the category via the slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function show($slug)
    {
        $categories = $this->category->with(['products','images'])->get();
        $parentCategories = $categories->where('parent_id', null);
        $category = $categories->where('slug', $slug)->first();
        return view('front.categories.category', [
            'categories' => $parentCategories,
            'category' => $category
        ]);
    }
}
