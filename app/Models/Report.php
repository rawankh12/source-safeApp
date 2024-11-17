<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "reports";

    protected $fillable = [
        'report',
        'user_id',
        'file_id',
        'group_id'
    ];

    protected $hidden = [
        'created_at',
        "updated_at",
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
