<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->string('ref_no');
      $table->string('trx_id')->unique();
      $table->foreignId('user_id')->constrained('users', 'id');
      $table->foreignId('source_id')->constrained('users', 'id');
      $table->tinyInteger('type')->comment('1 => income, 2 => expense');
      $table->decimal('amount', 20, 2);
      $table->text('description')->nullable();
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
    Schema::dropIfExists('transactions');
  }
}
