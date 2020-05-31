<?php

namespace App\Http\Livewire;
use App\Facades\Cart;
use Livewire\Component;

class Navbar extends Component
{
	public $cartTotal = 0;
    public $search;

    // if($search) {
    //     route('cart.index');
    // }
	protected $listeners = [
		'cartAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal',
	];

	public function mount()
	{
		$this->cartTotal =count(Cart::get()['products']) ;
	}
    public function render()
    {
        // $this->search === null ?  
            $kategori = \App\Category::get();
            return view('livewire.navbar',['kategori' => $kategori]);     

    }

    public function search()
    {
        $this->validate([
            'search' => 'required'
        ]);
        
        return redirect()->route('search', ['string' => $this->search]);
    }

    public function updateCartTotal()
    {
    	$this->cartTotal =count(Cart::get()['products']) ;
    }
}
