<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('income_categories', function($table){
			$table->foreign('parent_id')->references('id')->on('income_categories')->onUpdate('cascade')->onDelete('restrict');
		});

		Schema::table('expense_categories', function($table){
			$table->foreign('parent_id')->references('id')->on('expense_categories')->onUpdate('cascade')->onDelete('restrict');
		});

		Schema::table('income_items', function($table){
			$table->foreign('category_id')->references('id')->on('income_categories')->onUpdate('cascade')->onDelete('restrict');
		});

		Schema::table('expense_items', function($table){
			$table->foreign('category_id')->references('id')->on('expense_categories')->onUpdate('cascade')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('income_categories', function($table){
			$table->dropForeign('income_categories_parent_id_foreign');
		});

		Schema::table('expense_categories', function($table){
			$table->dropForeign('expense_categories_parent_id_foreign');
		});

		Schema::table('income_items', function($table){
			$table->dropForeign('income_items_category_id_foreign');
		});

		Schema::table('expense_items', function($table){
			$table->dropForeign('expense_items_category_id_foreign');
		});
	}

}
