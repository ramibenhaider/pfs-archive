<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_document extends Model
{
    protected $fillable =
    [
        'company_document_type_id',
        'original_name',
        'file_path',
        'comment',
        'airline_id'
    ];

    public function company_document_type()
    {
        return $this->belongsTo(Company_document_type::class);
    }
    
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
