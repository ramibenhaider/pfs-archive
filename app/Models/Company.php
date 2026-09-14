<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function company_documents()
    {
        return $this->hasMany(Company_document::class);
    }
}
