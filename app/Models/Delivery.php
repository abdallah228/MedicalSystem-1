<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;

    protected $table = 'deliveries';
    protected $guarded = [];


    protected $casts = [
        'lat'=>'double',
        'long'=>'double',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }

}
