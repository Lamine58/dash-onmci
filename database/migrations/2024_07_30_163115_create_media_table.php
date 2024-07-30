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
            $table->string('type');
            $table->string('data_id');
            $table->string('model');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('medias');
    }
};
