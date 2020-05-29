<?php

namespace App\Http\Livewire;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Facades\Cart;

class ProductIndex extends Component
{
	use WithPagination;

	public $search;

    public function render()
    {
        return view('livewire.product-index', [
        	'products' => Product::paginate(8),
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
