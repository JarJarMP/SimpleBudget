<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDatabase extends Migration
{
	public function up()
	{
		// Settings
		Schema::create('settings', function(Blueprint $table){
			$table->string('sett_key', 255);
			$table->string('sett_value', 255);
			$table->primary('sett_key');
		});

		// Users
		Schema::create('users', function(Blueprint $table){
			// Columns for Laravel user management, such as auth
			$table->increments('id');
			$table->string('email', 255);
			$table->string('password', 70);
			$table->timestamps();
			$table->rememberToken();
		});

		// Expense categories
		Schema::create('expense_categories', function(Blueprint $table) {
			// Columns for Baum Nested
			$table->increments('id');
			$table->integer('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			// Columns for Simple Budget
			$table->string('name', 100);

			// Columns for Baum Nested
			$table->timestamps();
		});

		// Income categories
		Schema::create('income_categories', function(Blueprint $table) {
			// Columns for Baum Nested
			$table->increments('id');
			$table->integer('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			// Columns for Simple Budget
			$table->string('name', 100);

			// Columns for Baum Nested
			$table->timestamps();
		});

		// Expense items
		Schema::create('expense_items', function(Blueprint $table){
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->float('amount');
			$table->string('title', 255);
			$table->text('note')->nullable();
			$table->date('expense_date');
		});

		// Income items
		Schema::create('income_items', function(Blueprint $table){
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->float('amount');
			$table->string('title', 255);
			$table->text('note')->nullable();
			$table->date('income_date');
		});
	}

	public function down()
	{
		// Income items
		Schema::drop('income_items');

		// Expense items
		Schema::drop('expense_items');

		// Income categories table
		Schema::drop('income_categories');

		// Expense categories table
		Schema::drop('expense_categories');

		// Users table
		Schema::drop('users');

		// Settings table
		Schema::drop('settings');
	}

}
