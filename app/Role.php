<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'slug',
        'permission',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function roles()
    {
        return $this->hasMany('App\RoleUser');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }
}
