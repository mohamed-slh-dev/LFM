<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->char('contract_name', 150)->nullable();
            $table->integer('contract_type')->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->longText('subject')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('document')->nullable();

            $table->char('address', 150)->nullable();
            $table->char('city', 150)->nullable();
            $table->char('state', 150)->nullable();
            $table->char('country', 150)->nullable();
            $table->char('phone', 150)->nullable();
            $table->char('notes', 150)->nullable();

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
        Schema::dropIfExists('contracts');
    }
}
