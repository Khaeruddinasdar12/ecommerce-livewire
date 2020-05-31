<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $data = DB::table('transaksis')
                ->where('status', '!=', '2')
                ->where('bukti', '!=', '')
                ->where('created_at', '<=', \Carbon\Carbon::now()->subMinutes(5)->toDateTimeString())
                ->get();
                
                foreach ($data as $datas) {
                    $stoks = \App\Riwayat::where('id_transaksi', $datas->id)->get();
                    foreach($stoks as $stok) {
                        $kurangi_stok = \App\Product::find($stok->id_product);
                        $kurangi_stok->stok = $kurangi_stok->stok + $stok->jumlah;
                        $kurangi_stok->save();
                    }
                    $delete = DB::table('transaksis')->where('id', $datas->id)->delete();
                    // $stok = \App\Riwayat::where('id_transaksi', $datas->id)
                    // ->update([
                    //     'status' => 'kosong',
                    // ]);

                    // $delete = DB::table('transaksis')->where('id', $datas->id)->delete();
                }
                // $data->delete();
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
