<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SecretList extends Model
{
    use HasFactory;
    use Multitenantable;

    protected $guarded = [];

    protected $casts = [
        'event_date'  => 'date:m-d-Y',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function participant(): HasMany {
        return $this->hasMany(Participant::class);
    }

}
