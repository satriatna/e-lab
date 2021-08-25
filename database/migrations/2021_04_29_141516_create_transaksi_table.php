<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admin')->onDelete('cascade');
            $table->foreignId('alat_id')->nullable()->references('id')->on('alat')->onDelete('cascade');
            $table->enum('status', ['loan_pending','loan_dismiss','loan_approved','return_pending','return_approved','return_dismiss'])->nullable();
            $table->enum('status_pinjam',['loan_approved','loan_dismiss','loan_pending'])->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->date('dari_tanggal')->nullable();
            $table->date('sampai_tanggal')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->string('denda')->nullable();
            $table->string('keterangan_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
