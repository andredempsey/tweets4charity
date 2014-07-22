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
			$table->string('first_name', 20);
			$table->string('last_name', 20);
			$table->string('twitter_handle', 20)->unique();
			$table->string('oauth_token', 100);
			$table->string('oauth_token_secret', 100);
			$table->string('user_id', 50);
			$table->string('profile_picture_link', 200);
			$table->string('email', 50);
			$table->string('password', 200);
			$table->enum('role_id', array('admin', 'donor', 'charity'));
			$table->boolean('is_active')->default(False);
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
