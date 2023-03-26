<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;
    protected $dates = [
        'created_at' ,
        'updated_at'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
