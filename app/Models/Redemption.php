<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Redemption extends Model
{
    protected $fillable = ['student_id', 'reward_id', 'status'];

    public function student(): BelongsTo {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function reward(): BelongsTo {
        return $this->belongsTo(Reward::class);
    }
}
