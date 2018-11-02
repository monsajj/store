<?php

namespace App\Http\Middleware;

use Closure;
use App\Shop\Carts\Cart;

class RedirectIfEmptyCart
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * EmptyCart constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->cart->getCartCount() == 0) return redirect('/');
        else return $next($request);
    }
}
