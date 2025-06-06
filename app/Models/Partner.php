<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    protected $fillable = ['user_id', 'company_name', 'cnpj'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
