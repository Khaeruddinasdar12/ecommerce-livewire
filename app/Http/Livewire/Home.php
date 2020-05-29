<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use App\Facades\Cart;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home',[
        	'data' => Product::orderBy('created_at', 'desc')->limit(6)->get(),
        ]);
    }

    public function addToCart(int $productId)
    {
    	$data = Cart::get()['products'];
        foreach ($data as $data) {
            if ($data->id == $productId) {
                session()->flash('error', 'Produk '.$data->nama.' telah berada di keranjang');
                return redirect()->back();
            }
        }
    	Cart::add(Product::where('id', $productId)->first());
        $this->emit('cartAdded');

        session()->flash('success', 'Menambahkan ke keranjang');
                return redirect()->back();
    }
}
