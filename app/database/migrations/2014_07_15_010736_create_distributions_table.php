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
			$table->integer('user_charity_join_id')->unsigned();
			$table->integer('transaction_id')->unsigned();
			$table->decimal('distributed_amt', 5, 2);
			$table->date('distribution_date');
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			$table->foreign('user_charity_join_id')->references('id')->on('selected_charities');
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
