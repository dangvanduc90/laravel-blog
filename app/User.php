<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Event;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
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
//        \Log::info($this->attributes);
//        if ($this->attributes['avatar']) {
//            return 'upload/user/' . $this->attributes['user'] . '/avatar/' . $this->attributes['avatar'];
//        }
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

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users')
            ->using(RoleUser::class)
            ->withTimestamps()
            ->withPivot('id as role_users_id')
            ->wherePivot('id', 1);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCountry($query, $type)
    {
        return $query->where('country_id', $type);
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($item) {
            Event::fire('item.created', $item);
        });

        static::updated(function ($item) {
            Event::fire('item.updated', $item);
        });

        static::deleted(function ($item) {
            Event::fire('item.deleted', $item);
        });
    }
}
