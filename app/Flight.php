<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flights';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'airline',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
