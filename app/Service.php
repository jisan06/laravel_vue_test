<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function serviceData() {
        return $this->hasMany('App\ServiceData','service_id');
    }

    public function passenger() {
        return $this->belongsTo('App\Passenger','service_id');
    }
}
