<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Management extends Model
{
    protected $fillable = [
        'management_name'
    ];

    public function employees()
    {
        return $this->HasMany(Employee::class);
    }
}
