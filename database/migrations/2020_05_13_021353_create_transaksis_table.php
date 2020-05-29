<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('phone');
            $table->string('alamat_lengkap');
            $table->string('id_alamat');
            $table->integer('total');
            $table->integer('ongkir');
            $table->string('service');
            $table->string('bukti')->nullable();
            $table->enum('show_user', [0, 1]);
            $table->string('kurir');
            $table->integer('user_id');
            $table->enum('status', [0, 1, 2]);
            $table->integer('admin_id')->nullable();
            $table->timestamps();
        });
        // $table->enum('trip', ['n', 'y']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
