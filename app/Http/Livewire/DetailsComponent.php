<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        return view('livewire.details-component', compact('product', 'popular_products', 'related_products'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        \Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Product added into chart');
        return redirect()->route('get.cart');
    }
}
