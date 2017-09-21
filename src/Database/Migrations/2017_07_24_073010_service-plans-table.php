<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_plans', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('sim_sessions');
            $table->unsignedInteger('interim_updates');
            $table->unsignedInteger('validity');
            $table->enum('validity_unit', \AccessManager\Constants\Time::TIME_DURATION_UNITS );
            $table->float('price');
        });

        Schema::create('service_plan_primary_policies', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('service_plan_id');
            $table->unsignedInteger('min_up');
            $table->enum('min_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('min_down');
            $table->enum('min_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_up');
            $table->enum('max_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_down');
            $table->enum('max_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );

            $table->foreign('service_plan_id')
                ->references('id')->on('service_plans')
                ->onDelete('cascade');
        });


        Schema::create('service_plan_limits', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('service_plan_id');
            $table->unsignedInteger('time_limit')->nullable();
            $table->enum('time_unit', \AccessManager\Constants\Time::TIME_LIMIT_UNITS);
            $table->unsignedInteger('data_limit')->nullable();
            $table->enum('data_unit', \AccessManager\Constants\Data::DATA_LIMIT_UNITS);
            $table->unsignedInteger('reset_every')->nullable();
            $table->enum('reset_every_unit', \AccessManager\Constants\Time::TIME_DURATION_UNITS);

            $table->foreign('service_plan_id')
                ->references('id')->on('service_plans')
                ->onDelete('cascade');
        });

        Schema::create('service_plan_aq_policies', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->unsignedInteger('service_plan_id');
            $table->unsignedInteger('min_up');
            $table->enum('min_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('min_down');
            $table->enum('min_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_up');
            $table->enum('max_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_down');
            $table->enum('max_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );

            $table->foreign('service_plan_id')
                ->references('id')->on('service_plans')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_plan_aq_policies');
        Schema::dropIfExists('service_plan_limits');
        Schema::dropIfExists('service_plan_primary_policies');
        Schema::dropIfExists('service_plans');
    }
}
