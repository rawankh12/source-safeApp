<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'id', 'type', 'data', 'read_at','notifiable_id','notifiable_type'
    ];

    // استدعاء العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
