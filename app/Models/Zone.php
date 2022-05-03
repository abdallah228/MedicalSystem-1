<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;
    protected $table = 'zones';
    protected $guarded = [];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class,'zone_id');
    }

    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class,'zone_id');
    }
}
