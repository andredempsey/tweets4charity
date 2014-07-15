<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectedCharitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charities_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('charity_id')->unsigned();
			$table->unique(array('user_id', 'charity_id'));
			$table->decimal('alloted_percent', 5, 2);
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('charity_id')->references('id')->on('charities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('selected_charities', function(Blueprint $table)
		{
			Schema::drop('selected_charities');
		});
	}

}
