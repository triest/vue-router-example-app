<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginsKeysForUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('children_id')->after('settings')->nullable()->default(null);
            $table->integer('alcohol_id')->after('children_id')->nullable()->default(null);
            $table->integer('smoking_id')->after('alcohol_id')->nullable()->default(null);
            $table->integer('body_type_id')->after('smoking_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('children_id');
            $table->dropColumn('alcohol_id');
            $table->dropColumn('smoking_id');
            $table->dropColumn('body_type_id');
        });
    }
}
