<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('income_items', function(Blueprint $table){
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->float('amount');
			$table->string('title', 255);
			$table->text('note')->nullable();
			$table->date('income_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('income_items');
	}

}
