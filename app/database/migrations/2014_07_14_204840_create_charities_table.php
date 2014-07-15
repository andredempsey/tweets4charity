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
			$table->string('twitter_handle', 20)->nullable;
			$table->string('charity_name', 100)->unique();
			$table->string('tax_id', 100)->unique();
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 50);
			$table->string('phone', 20);
			$table->string('street', 50);
			$table->string('city', 50);
			$table->string('state', 10);
			$table->string('zip', 50);
			$table->string('password', 20);
			$table->boolean('is_active')->default(False);
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
