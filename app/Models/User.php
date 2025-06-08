<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    public function student(): HasOne {
        return $this->hasOne(Student::class);
    }

    public function teacher(): HasOne {
        return $this->hasOne(Teacher::class);
    }

    public function partner(): HasOne {
        return $this->hasOne(Partner::class);
    }

    public function wallet(): HasOne {
        return $this->hasOne(Wallet::class);
    }

    public function sentTransactions(): HasMany {
        return $this->hasMany(Transaction::class, 'from_user_id');
    }

    public function receivedTransactions(): HasMany {
        return $this->hasMany(Transaction::class, 'to_user_id');
    }

    public function rewards(): HasMany {
        return $this->hasMany(Reward::class, 'partner_id');
    }

    public function redemptions(): HasMany {
        return $this->hasMany(Redemption::class, 'student_id');
    }

    public function adjustWalletBalance(float $amount): void
    {
        $this->wallet->balance += $amount;
        $this->wallet->save();
    }
}
