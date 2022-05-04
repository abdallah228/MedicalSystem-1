<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

}
