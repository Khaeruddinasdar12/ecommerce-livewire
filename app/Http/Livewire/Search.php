<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use Livewire\WithPagination;
use App\Facades\Cart;
class Search extends Component
{
	public $search;

	use WithPagination;

	public function mount($string)
	{
		$this->search = $string; 
		// $this->detail = 'haha';
	}
    public function render()
    {
    	// BookingDates::where('email', Input::get('email'))
    	// ->orWhere('name', 'like', '%' . Input::get('name') . '%')->get();
    	$data = Product::where('nama', 'like', '%' . $this->search . '%')->paginate(8);
        return view('livewire.search', ['products' => $data]);
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
