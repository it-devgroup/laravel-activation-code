<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateActivationCodes
 */
class CreateActivationCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            '{{TABLE_NAME}}',
            function (Blueprint $table) {
                $table->id();
                $table->string('receiver')->nullable();
                $table->string('code')->index();
                $table->string('type')->index()->nullable();
                $table->integer('record_id')->nullable();
                $table->integer('attempt')->default(0);
                $table->dateTime('expires_at')->nullable();
                $table->dateTime('created_at')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{TABLE_NAME}}');
    }
}
