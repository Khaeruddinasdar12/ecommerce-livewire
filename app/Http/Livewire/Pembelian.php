<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Transaksi;
class Pembelian extends Component
{
    use WithPagination;
    public function render()
    {
        $data = Transaksi::where('user_id', \Auth::user()->id)
        ->where('show_user', '1')
        ->orderBy('created_at', 'desc')
        ->paginate(8);
         // dd($data);
        return view('livewire.pembelian' , ['data' => $data]);
        // return view('livewire.pembelian');
    }

    public function hapus($id)
    {
    	$set_show = Transaksi::find($id);
    	$set_show->show_user = '0';
    	$set_show->save();
    	$this->data = Transaksi::where('user_id', \Auth::user()->id)->where('show_user', '1')->get();
    }
}
