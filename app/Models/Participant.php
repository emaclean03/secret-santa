<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function secretList(): BelongsTo
    {
        return $this->belongsTo(SecretList::class);
    }
}
