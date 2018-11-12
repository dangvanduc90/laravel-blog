<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flights';
    public $timestamps = true;
    protected $fillable = [
        'name', 'airline', 'is_admin'
    ];
    protected $visible = [
        'name', 'airline', 'is_admin'
    ];

    protected $appends = ['is_admin'];
    public function getIsAdminAttribute()
    {
        return $this->attributes['is_admin'] == 'yes';
    }
}
