<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable =
    [
        'id', 
        'company_name',
        'street_address',
        'repesenttative_name',   
    ];

    public function getCreate(){
        $companies= DB::table('companies')
        ->get();

        return $companies;
    }

    
}
