<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCharityDonor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('charity_donor', function(Blueprint $table)
		{
			$table->foreign('donor_id')->references('id')->on('donors');
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
		Schema::table('charity_donor', function(Blueprint $table)
		{
			$table->dropForeign('donor_id');
			$table->dropForeign('charity_id');
		});
	}

}
