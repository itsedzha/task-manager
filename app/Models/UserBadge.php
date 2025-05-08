<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'badge_5_tasks',
        'badge_10_priority',
        'badge_deadline',
        'badge_20_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
