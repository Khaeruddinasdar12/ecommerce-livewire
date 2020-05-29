<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use App\Product;

class Detail extends Component
{

	public $id_product;

	public function mount($id)
	{
		$this->id_product = $id; 
		// $this->detail = 'haha';
	}

    public function render()
    {
    	// dd($this->id_product);
    	$data = \App\Product::findOrFail($this->id_product);
        return view('livewire.detail', ['detail' => $data]);
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
