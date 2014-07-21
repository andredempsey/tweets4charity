<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('distributions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('charity_id')->unsigned();
			$table->integer('transaction_id')->unsigned();
			$table->decimal('amount', 5, 2);
			$table->boolean('check_sent')->default(False);
			$table->date('distributed_on');
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			$table->foreign('charity_id')->references('id')->on('charities');
			$table->foreign('transaction_id')->references('id')->on('transactions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('distributions', function(Blueprint $table)
		{
			Schema::drop('distributions');
		});
	}

}
