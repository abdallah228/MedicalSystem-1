<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $table = 'services';
    protected $guarded = [];


    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class,'service_provider_id');
    }
       public function getImageAttribute($value)
    {
        return $value = asset('uploads/services/'.$value);
    }

}
