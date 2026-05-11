<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_document_type extends Model
{
    protected $fillable =
    [
        'name',
        'nameEn'
    ];

    public function company_documents()
    {
        return $this->hasMany(Company_document::class);
    }
}
