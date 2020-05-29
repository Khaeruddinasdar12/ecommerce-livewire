<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Facades\Cart;
use App\Product;

class Kategori extends Component
{
	public $kategori_name;

	use WithPagination;

	public function mount($kategori)
	{
		$this->kategori_name = $kategori;
	}

    public function render()
    {
    	$id_kategori = \App\Category::where('nama', $this->kategori_name)->first();
    	// dd($id_kategori->id);
    	// dd(\App\Product::where('id_category', 1)->paginate(8));
        return view('livewire.kategori', [
        	'products' => Product::where('id_category', $id_kategori->id)->paginate(8),
        	'kategori' => $this->kategori_name,
        ]);
    }

    public function addToCart(int $productId)
    {
        // $cek_stok = Product::find($productId);
        // if ($cek_stok->stok = 0 ) {
        //     session()->flash('error', 'Stok '.$data->nama.' tidak cukup');
        // }
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
