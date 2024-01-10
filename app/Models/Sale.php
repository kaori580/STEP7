<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    // use HasFactory;
    protected $table = 'Sale';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['id', 'version', 'min_version'];


            public function products()
            {
                return $this->belongsTo('App\Models\Product');
            }
            
}





