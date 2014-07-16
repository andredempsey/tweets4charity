<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('twitter_handle', 20)->unique();
			$table->string('profile_picture_link', 200);
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 50);
			$table->string('password', 20);
			$table->decimal('amount_per_tweet');
			$table->decimal('monthly_goal');
			$table->integer('report_frequency');
			$table->boolean('is_admin')->default(False);
			$table->boolean('is_active')->default(True);
			$table->string('remember_token', 100)->nullable;
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
		Schema::table('users', function(Blueprint $table)
		{
			Schema::drop('users');
		});
	}

}
