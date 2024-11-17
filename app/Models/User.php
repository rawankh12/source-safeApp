<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')
            ->wherePivot('status', 'accepted')
            ->withPivot('status');
    }

    public function groupss()
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')
            // ->wherePivot('status', 'pending')
            ->withPivot('status');
    }

    public function lgroups()
    {
        return $this->belongsToMany(Group::class, 'user_groups')
            ->withPivot('status');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }
    public function createdGroups()
    {
        return $this->hasMany(Group::class, 'user_create', 'name');  // ربط created_by (اسم المستخدم) مع name (اسم المستخدم في جدول users)
    }
}
