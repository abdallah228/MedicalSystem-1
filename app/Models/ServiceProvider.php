<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
    use SoftDeletes;

    protected $table = 'service_providers';
    protected $guarded = [];

    protected $casts = [
        'lat'=>'double',
        'long'=>'double',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class,'service_provider_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }

    public function getLogoAttribute($value)
    {
        return $value = asset('uploads/serviceProviders/'.$value);
    }

}
