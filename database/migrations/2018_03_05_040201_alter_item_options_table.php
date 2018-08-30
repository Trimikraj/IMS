<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_options', function (Blueprint $table) {
            $table->integer('item_id');
            $table->integer('item_field_id');
            $table->boolean('is_required');
            $table->string('option_type');
            $table->integer('display_order');
            $table->text('value');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_options', function (Blueprint $table) {
            //
        });
    }
}
