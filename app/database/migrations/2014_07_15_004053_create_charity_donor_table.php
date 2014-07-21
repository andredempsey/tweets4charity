<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityDonorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charity_donor', function(Blueprint $table)
		{
			$table->integer('donor_id')->unsigned();
			$table->integer('charity_id')->unsigned();
			$table->unique(array('donor_id', 'charity_id'));
			$table->decimal('allotted_percent', 5, 2);
			$table->boolean('is_active')->default(True);
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
			$table->primary(array('donor_id', 'charity_id'));

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('charity_donor', function(Blueprint $table)
		{
			Schema::drop('charity_donor');
		});
	}

}
