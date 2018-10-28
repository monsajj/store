<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Shop\Categories\Category;
use App\Shop\Products\Product;
use App\Shop\Users\User;
use App\Shop\Images\Image;

class HomeController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, Product $product, User $user, Image $image)
    {
        $this->middleware('auth');

        $this->category = $category;
        $this->image = $image;
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $category = $this->category->get();
//        $product = $this->product->get();
//        $users = $this->user->get();
//        $image = $this->image->get();
//
//        dd(
//            ["categories" => ""],
//            $category,
//            ["products" => ""],
//            $product,
//            ["users" => ""],
//            $users,
//            ["images" => ""],
//            $image
//        );

        $categories = $this->category->with(['images', 'subCategories'])->parent()->get();

        return view('front.index', [
            'categories' => $categories
        ]);
    }
}
