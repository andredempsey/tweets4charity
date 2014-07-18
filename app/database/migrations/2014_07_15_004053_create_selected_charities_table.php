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
		Schema::create('charity_user', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('charity_id')->unsigned();
			$table->unique(array('user_id', 'charity_id'));
			$table->decimal('allotted_percent', 5, 2);
			$table->boolean('is_active')->default(True);
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('charity_id')->references('id')->on('charities');
			$table->primary(array('user_id', 'charity_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('charity_user', function(Blueprint $table)
		{
			Schema::drop('charity_user');
		});
	}

}
