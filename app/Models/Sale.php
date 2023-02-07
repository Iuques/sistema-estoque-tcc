<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity', 'value')->withTimestamps();
    }
}
