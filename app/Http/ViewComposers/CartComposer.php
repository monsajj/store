<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 02.11.18
 * Time: 15:07
 */

namespace App\Http\ViewComposers;

use App\Shop\Carts\Cart;
use Illuminate\View\View;

class CartComposer
{
    /**
     * The categories repository implementation.
     *
     * @var Cart
     */
    protected $cart;

    /**
     * Create a new cart composer.
     *
     * @param  Cart $cart
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('cartCount', $this->cart->getCartCount());
    }
}
