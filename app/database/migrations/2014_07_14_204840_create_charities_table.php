<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->unique();
			$table->string('charity_name', 100);
			$table->string('tax_id', 100)->nullable;
			$table->string('tax_pdf', 250)->nullable;
			$table->string('phone', 20);
			$table->string('street', 50);
			$table->string('city', 50);
			$table->string('state', 10);
			$table->string('zip', 50);
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::table('charities', function(Blueprint $table)
		{
			Schema::drop('charities');
		});
	}

}
