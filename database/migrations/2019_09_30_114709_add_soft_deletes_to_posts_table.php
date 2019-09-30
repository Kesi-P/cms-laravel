<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()   //help us to modify the post table
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->softDeletesTz(); //auto generat deleted_at table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  //when you call delete method on the model
    {
        Schema::table('posts', function (Blueprint $table) {
             $table->dropColumn('deleted_at');
        });
    }
}
