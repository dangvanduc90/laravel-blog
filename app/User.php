<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar_link',
        'first_name'
    ];

    // Defining An Accessor
    public function getAvatarLinkAttribute()
    {
        if ($this->attributes['avatar']) {
            return 'upload/user/' . $this->attributes['user'] . '/avatar/' . $this->attributes['avatar'];
        }
        return \Avatar::create($this->attributes['name'])->toBase64();
    }

    // Defining An Accessor
    public function getFirstNameAttribute()
    {
        return ucfirst($this->attributes['name']);
    }
    // Defining A mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function phone()
    {
        return $this->hasOne('App\Phone');
    }

    public function flight()
    {
        return $this->hasMany('App\Flight');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users')
            ->using(RoleUser::class)
            ->withTimestamps()
            ->withPivot('id as role_users_id')
            ->wherePivot('id', 1);
    }
}
