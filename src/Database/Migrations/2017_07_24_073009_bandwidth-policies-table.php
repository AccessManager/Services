<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BandwidthPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bw_policies', function(Blueprint $t){
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->string('name');
            $t->integer('min_up')->unsigned();
            $t->enum('min_up_unit',['Kbps','Mbps']);
            $t->integer('min_down')->unsigned();
            $t->enum('min_down_unit',['Kbps','Mbps']);
            $t->integer('max_up')->unsigned();
            $t->enum('max_up_unit',['Kbps','Mbps']);
            $t->integer('max_down')->unsigned();
            $t->enum('max_down_unit',['Kbps','Mbps']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bw_policies');
    }
}
