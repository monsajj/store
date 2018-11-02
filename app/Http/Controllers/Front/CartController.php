<?php

namespace App\Http\Controllers\Front;

use App\Shop\Categories\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Carts\RequestRules\AddToCartRequest;
use App\Shop\Carts\Cart;
use App\Shop\Products\Product;
use Session;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Category
     */
    private $categories;

    /**
     * CartController constructor.
     * @param Cart $cart
     * @param Product $product
     * @param Category $category
     */
    public function __construct(Cart $cart, Product $product, Category $category)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->categories = $category;
    }

    /**
     * @param AddToCartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddToCartRequest $request)
    {
        $product = $this->product->where('id', $request->get('product'))->first();
        $quantity = $request->get('quantity');
        $this->cart->addToCart($product, $quantity);
        return redirect()->route('cart.show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $cart = $this->cart->getCartDataForView();
        $sum = $this->cart->getCartTotalSum();

        return view('front.carts.cart', compact('cart', 'sum'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(Request $request)
    {
        Session::forget('cart');
        return redirect()->route('cart.show');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->cart->deleteProductFromCart($id);
        return redirect()->route('cart.show');
    }
}
