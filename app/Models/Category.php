<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class,'category_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function getIconAttribute($value)
    {
        return $value = asset('uploads/categories/'.$value);
    }

}
