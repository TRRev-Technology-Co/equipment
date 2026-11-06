<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'user_id'])]
class Equipment extends Model
{
    protected $table = 'equipments';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
