<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->string('type')->nullable();
            $table->string('data_id')->nullable();
            $table->string('model')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('medias');
    }
};
