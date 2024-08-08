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
        Schema::table('settings', function (Blueprint $table) {
            $table->longtext('about')->nullable();
            $table->longtext('mission')->nullable();
            $table->longtext('team')->nullable();
            $table->longtext('organigram')->nullable();
            $table->longtext('register')->nullable();
            $table->longtext('radiation')->nullable();
            $table->longtext('good_behavior')->nullable();
            $table->longtext('informed_consent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['about', 'mission', 'team', 'organigram', 'register', 'radiation', 'good_behavior', 'informed_consent']);
        });
    }
};
