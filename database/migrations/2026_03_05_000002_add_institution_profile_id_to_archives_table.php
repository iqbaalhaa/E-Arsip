<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('archives', 'institution_profile_id')) {
            Schema::table('archives', function (Blueprint $table) {
                $table->foreignId('institution_profile_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('archives', 'institution_profile_id')) {
            Schema::table('archives', function (Blueprint $table) {
                $table->dropConstrainedForeignId('institution_profile_id');
            });
        }
    }
};
