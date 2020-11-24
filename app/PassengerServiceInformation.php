<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengerServiceInformation extends Model
{
    protected $fillable = [
        'passenger_id','service_data_id','service_data_value'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function passenger(){
    	return $this->belongsTo('App\Passenger', 'id');
	}

	 public function serviceData() {
        return $this->hasMany('App\ServiceData','service_data_id');
    }
}
