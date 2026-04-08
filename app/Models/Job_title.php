<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_title extends Model
{
    protected $fillable = [
        'job_title_name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
