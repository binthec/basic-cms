<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topimages', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('status');
            $table->string('extention')->nullable();
            $table->timestamps();
        });

        Schema::create('action_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('remote_address');
            $table->string('route');
            $table->string('method');
            $table->text('request');
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });

        //パーティショニングのため、SQL直書き
        DB::statement("
			ALTER TABLE action_logs
			DROP PRIMARY KEY,
			ADD PRIMARY KEY (id, created_at)
		");

        DB::statement("
			ALTER TABLE action_logs
			PARTITION BY RANGE COLUMNS(created_at) (
			PARTITION p201701 VALUES LESS THAN ('2017-01-01 00:00:00'),
			PARTITION p201801 VALUES LESS THAN ('2018-01-01 00:00:00'),
			PARTITION p201901 VALUES LESS THAN ('2019-01-01 00:00:00'),
			PARTITION p202001 VALUES LESS THAN ('2020-01-01 00:00:00'),
			PARTITION p202101 VALUES LESS THAN ('2021-01-01 00:00:00'),
			PARTITION p202201 VALUES LESS THAN ('2022-01-01 00:00:00'),
			PARTITION p202301 VALUES LESS THAN ('2023-01-01 00:00:00'),
			PARTITION p202401 VALUES LESS THAN ('2024-01-01 00:00:00'),
			PARTITION p202501 VALUES LESS THAN ('2025-01-01 00:00:00'),
			PARTITION p202601 VALUES LESS THAN ('2026-01-01 00:00:00'),
			PARTITION p202701 VALUES LESS THAN ('2027-01-01 00:00:00'),
			PARTITION p202801 VALUES LESS THAN ('2028-01-01 00:00:00'),
			PARTITION p202901 VALUES LESS THAN ('2029-01-01 00:00:00'),
			PARTITION p203001 VALUES LESS THAN ('2030-01-01 00:00:00'),
			PARTITION p203101 VALUES LESS THAN ('2031-01-01 00:00:00'),
			PARTITION p203201 VALUES LESS THAN ('2032-01-01 00:00:00'),
			PARTITION p203301 VALUES LESS THAN ('2033-01-01 00:00:00'),
			PARTITION p203401 VALUES LESS THAN ('2034-01-01 00:00:00'),
			PARTITION p203501 VALUES LESS THAN ('2035-01-01 00:00:00'),
			PARTITION p203601 VALUES LESS THAN ('2036-01-01 00:00:00'),
			PARTITION p203701 VALUES LESS THAN ('2037-01-01 00:00:00'),
			PARTITION p203801 VALUES LESS THAN ('2038-01-01 00:00:00'),
			PARTITION p203901 VALUES LESS THAN ('2039-01-01 00:00:00'),
			PARTITION p204001 VALUES LESS THAN ('2040-01-01 00:00:00')
			);
		");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topimages');
        Schema::dropIfExists('action_logs');
    }
}