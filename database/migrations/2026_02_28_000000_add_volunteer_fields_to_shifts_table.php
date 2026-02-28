<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->string('volunteer_name')->nullable()->after('user_id');
            $table->string('volunteer_contact')->nullable()->after('volunteer_name');
        });
    }

    public function down(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn(['volunteer_name', 'volunteer_contact']);
        });
    }
};
