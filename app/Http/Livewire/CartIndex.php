<?php

namespace App\Http\Livewire;
// use Illuminate\Http\Request;
use Livewire\Component;
use App\Facades\Cart;
use App\Province;
use App\City;
use App\Courier;
use App\Product;
use Illuminate\Http\Request;

class CartIndex extends Component
{
	public $cart;
    public $berat = 0;
    public $total = 0;
    public $nama;
    public $nohp;
    public $alamat;

	public function mount()
	{
        $data = Cart::get();
        $this->cart = $data;
        $get_total = Cart::get()['products'];
        $jumlah = 0;
        $brt = 0;
        foreach ($get_total as $total) {
            $jumlah = $jumlah + $total->subtotal;
            $brt = $brt + $total->berat;
        }
        $this->total = $jumlah;
        $this->berat = $brt;
	}

    public function render()
    {
        $provinsi = Province::get();
        $kurir = Courier::get();
        return view('livewire.cart-index', ['provinsi' => $provinsi, 'kurir' => $kurir]);
    }

    public function submit(Request $request)
    {
        dd($request);
        $data = Cart::get();
        $this->cart = $data;
        return redirect()->route('payment', ['string' => 'baba']);
        // dd('haha');
    }
    public function removeItem($productId)
    {
    	// dd($productId);
    	Cart::remove($productId);
    	$this->cart = Cart::get();
    	$this->emit('productRemoved');
        $get_total = Cart::get()['products'];
        $jumlah = 0;
        $brt= 0;
        foreach ($get_total as $total) {
            $jumlah = $jumlah + $total->subtotal;
            $brt = $brt + $total->berat;
        }
        $this->total = $jumlah;
        $this->berat = $brt;

    } 

    public function kosong()
    {
        // dd('haha');
    	Cart::clear(); 
    	$this->emit('clearCart');
    	$this->cart = Cart::get();
    }
}
