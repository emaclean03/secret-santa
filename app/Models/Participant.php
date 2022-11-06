<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent(){
        return $this->belongsTo(self::class , 'participant_id');
    }

    public function exclude(){
        return $this->belongsTo(self::class , 'excluded_participant');
    }

    public function children(){
        return $this->hasMany(self::class , 'id');
    }
}
