<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->string('group_id')->default('')->after('id');
        });

        // Backfill existing shifts: group by the old concatenation key
        $shifts = DB::table('shifts')->get();
        $groups = $shifts->groupBy(fn ($s) =>
            $s->name.'|'.$s->description.'|'.$s->start_time.'|'.$s->end_time.'|'.($s->category ?? '')
        );

        foreach ($groups as $group) {
            $groupId = (string) Str::uuid();
            $ids = $group->pluck('id')->toArray();
            DB::table('shifts')->whereIn('id', $ids)->update(['group_id' => $groupId]);
        }

        Schema::table('shifts', function (Blueprint $table) {
            $table->string('group_id')->default(null)->change();
            $table->index('group_id');
        });
    }

    public function down(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
};
