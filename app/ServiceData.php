<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceData extends Model
{
    protected $fillable = [
        'service_id','title',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function service(){
    	return $this->belongsTo('App\Service', 'id');
	}
}
