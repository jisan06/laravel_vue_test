<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = [
        'service_id', 'name', 'passport', 'email', 'mobile',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function service() {
        return $this->belongsTo('App\Service','id');
    }

    public function passengerServiceInformation() {
        return $this->hasMany('App\PassengerServiceInformation','passenger_id');
    }
}
