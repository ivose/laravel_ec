<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
    public function updateQuantity($rowId, $k)
    {
        Cart::update($rowId, $k == 0 ? 0 : Cart::get($rowId)->qty + $k);
    }
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message', 'Item removed from cart');
    }
    public function destroyAll()
    {
        Cart::destroy();
        session()->flash('success_message', 'All items removed from the cart');
    }
}
