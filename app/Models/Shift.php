<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
