<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupFile extends Model
{
    use HasFactory;
    protected $table = "group-files";
    protected $fillable = ['file_id','group_id','status','type'];
    protected $hidden = [
        'created_at',
        "updated_at",
    ];
}
