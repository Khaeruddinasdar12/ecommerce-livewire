<?php

namespace App\Helpers;
use App\Product;
class Cart
{
	public function __construct()
	{
		if($this->get() == null) {
			$this->set($this->empty());
		}
	}

	public function add(Product $product)
	{
		$cart = $this->get();
		$product->setAttribute('jumlah', 1);
		$product->setAttribute('subtotal', $product->harga);

		array_push($cart['products'], $product);
		$this->set($cart);
	} 

	public function update(Product $product,int $jumlah) //mengupdate jumlah dan berat di keranjang belanja
	{
		// dd($jumlah);
		$cart = $this->get();
		// $product->setAttribute('jumlah', 1);
		$no = 0;
		foreach($cart['products'] as $test){
			if($cart['products'][$no]['id'] == $product->id) {
				$cart['products'][$no]['jumlah'] = $jumlah;
				$cart['products'][$no]['subtotal'] = $jumlah * $product->harga;
				$cart['products'][$no]['berat'] = $jumlah * $product->berat;
				$dataperubahan = $cart['products'][$no];
				$this->set($cart);
				return $dataperubahan;
			}
			$no++;
		}
		// $this->set($cart);
		
	}

	public function empty()
	{
		return [
			'products' => [],
		];
	}
	public function get()
	{
		return session()->get('cart');
	}

	public function set($cart)
	{
		session()->put('cart', $cart);
	}

	public function remove(int $productId)
	{
		// dd('haha');
		$cart = $this->get();
		array_splice($cart['products'], array_search($productId, array_column($cart['products'], 'id')),1);

		$this->set($cart); 
	}

	public function clear()
	{
		$this->set($this->empty());
	}

}