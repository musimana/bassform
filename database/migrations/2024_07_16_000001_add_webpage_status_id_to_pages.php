<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        if (!Schema::hasColumn('pages', 'webpage_status_id')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->integer('webpage_status_id')->nullable()->after('id');
            });
        }
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        if (Schema::hasColumn('pages', 'webpage_status_id')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('webpage_status_id');
            });
        }
    }
};
