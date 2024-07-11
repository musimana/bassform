<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        if (Schema::hasColumn('pages', 'subtitle')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('subtitle');
            });
        }

        if (Schema::hasColumn('pages', 'content')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('content');
            });
        }

        if (Schema::hasColumn('pages', 'meta_title')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_title');
            });
        }
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        if (!Schema::hasColumn('pages', 'subtitle')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('subtitle')->nullable()->after('title');
            });
        }

        if (!Schema::hasColumn('pages', 'content')) {
            Schema::table('users', function (Blueprint $table) {
                $table->text('content')->nullable()->after('subtitle');
            });
        }

        if (!Schema::hasColumn('pages', 'meta_title')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('meta_title')->nullable()->after('content');
            });
        }
    }
};
