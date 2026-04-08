<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        'airline_name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
