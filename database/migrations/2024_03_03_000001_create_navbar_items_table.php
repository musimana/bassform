<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('navbar_items', function (Blueprint $table) {
            $table->id();
            $table->integer('navbar_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->integer('display_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('navbar_items');
    }
};
