<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }
    public function departament() {
        return $this->belongsTo('App\Models\Departament');
    }
    public function image() {
        return $this->belongsTo('App\Models\Image');
    }

    public function sales() {
        return $this->belongsToMany('App\Models\Sale')->withPivot('quantity', 'value')->withTimestamps();
    }
}
