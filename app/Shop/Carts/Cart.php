<?php
/**
 * Created by PhpStorm.
 * User: monsajj
 * Date: 31.10.18
 * Time: 13:55
 */

namespace App\Shop\Carts;

use App\Shop\Carts\CartItem;
use App\Shop\Products\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{

    /**
     * @var Collection
     */
    private $cart;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $cartCount;

    /**
     * Cart constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Add a record to cart
     *
     * @param Product $product
     * @param int $quantity
     */
    public function addToCart(Product $product, int $quantity)
    {
        if (($this->getCart() != null) && ($this->getCart()->isNotEmpty())) {
            ($this->getCart()->get($product->id)) != null
                ? $this->getCart()[$product->id] += $quantity
                : $this->getCart()->put($product->id, $quantity);
        } else {
            $this->cart = collect();
            $this->getCart()->put($product->id, $quantity);
        }
        $this->cartCount += $quantity;
        $this->saveCartChanges();
    }

    /**
     * @param $id
     */
    public function deleteProductFromCart($id)
    {
        $this->cartCount -= $this->getCart()->get($id);
        $this->getCart()->forget($id);
        $this->saveCartChanges();
    }

    /**
     * @return Collection
     */
    public function getCartDataForView(): Collection
    {
        $cart = collect();
        if ($this->getCart() != null)
            $this->getCart()->each(function ($value, $key) use ($cart) {
                $product = $this->product->where('id', $key)->first();
                $cart->push(new CartItem($key, $product->name, $value, $product->price));
            });
        return $cart;
    }

    /**
     * @return float
     */
    public function getCartTotalSum(): float
    {
        return $this->getCartDataForView()->sum('total');
    }

    /**
     * @return int
     */
    public function getCartCount(): int
    {
        if ($this->getCart() == null) $this->cartCount = 0;
        if (!isset($this->cartCount)) $this->cartCount = $this->getCart()->sum();
        return $this->cartCount;
    }

    /**
     *
     */
    public function saveCartChanges(): void
    {
        session(['cart' => $this->getCart()]);
        Session::save();
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|Collection|mixed
     */
    public function getCart()
    {
        if (!isset($this->cart)) $this->cart = session('cart');
        return $this->cart;
    }


}
