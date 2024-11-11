<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Command\WhereamiCommand;

class Group extends Model
{
    use HasFactory;
    protected $table = "groups";
    protected $fillable = ['name', 'description', 'user_create'];

    protected $hidden = [
        'created_at',
        "updated_at",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups', 'group_id', 'user_id')->withPivot('status');
    }

    public function acceptedfiles()
    {
        return $this->belongsToMany(File::class, 'group_files', 'group_id', 'file_id')
            ->wherePivot('type', 'accepted')
            ->withPivot('status', 'type');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'group_files', 'group_id', 'file_id')
            ->withPivot('status', 'type');
    }

    public function freefiles()
    {
        return $this->belongsToMany(File::class, 'group_files', 'group_id', 'file_id')
            ->withPivot('status', 'type')
            ->wherePivot('status', 'free');
    }

    public function pendingfiles()
    {
        return $this->belongsToMany(File::class, 'group_files')
            ->withPivot('type')
            ->wherePivot('type', 'pending');
    }

    public function blockedfiles()
    {
        return $this->belongsToMany(File::class, 'group_files')
            ->withPivot('status')
            ->wherePivot('status', 'blocked');
    }

}
