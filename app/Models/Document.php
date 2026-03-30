<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable =
    [
        'docuement_type_id',
        'employee_id',
        'file_path',
        'comment'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function document_type()
    {
        return $this->belongsTo(Document_type::class);
    }
}
