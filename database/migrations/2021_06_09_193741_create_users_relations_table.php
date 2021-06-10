<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_relations', function (Blueprint $table) {
            $table->id();
            $table->integer('who_id')->unsigned()->index();
            $table->integer('target_id')->unsigned()->index();
            $table->string('type')->nullable()->default('ignore');
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
        Schema::dropIfExists('users_relations');
    }
}
