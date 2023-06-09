<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_sets', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->unique()->nullable();
            $table->string('title', 70)->nullable();
            $table->string('description', 160)->nullable();
            $table->string('keywords', 255)->nullable();
            $table->decimal('priority', $precision = 1, $scale = 1)->default(0.5);
            $table->string('changefreq')->default('weekly');
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
        Schema::dropIfExists('seo_sets');
    }
};
