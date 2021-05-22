<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactRunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_run', function (Blueprint $table) {
            $table->primary(['run_id', 'contact_id']);
            $table->foreignId('run_id')
                ->constrained('runs')
                ->onDelete('cascade');
            $table->foreignId('contact_id')
                ->constrained('contacts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_run');
    }
}
