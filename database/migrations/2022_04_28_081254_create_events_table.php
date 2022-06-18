<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('host_id');
            $table->string('name', 100);
            $table->string('introduction', 500)->nullable();
            $table->string('location', 255)->nullable();
            $table->dateTime('start_time', 0);
            $table->dateTime('end_time', 0)->nullable();
            $table->string('code', 8)->unique();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
