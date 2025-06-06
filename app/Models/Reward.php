<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    protected $fillable = ['partner_id', 'name', 'description', 'cost', 'stock'];

    public function partner(): BelongsTo {
        return $this->belongsTo(User::class, 'partner_id');
    }
}
