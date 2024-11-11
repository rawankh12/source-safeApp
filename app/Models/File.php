<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        "updated_at",
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_files')->withPivot('status', 'type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
