<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('donor_id')->unsigned();
			$table->string('token',150)->unique();
			$table->decimal('amount_per_tweet', 5, 2);
			$table->decimal('amount', 5, 2);
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			Schema::drop('transactions');
		});
	}

}
