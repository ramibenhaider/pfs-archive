<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable =
    [
        'name',
        'id_number',
        'expiry_date_id',
        'management_id',
        'nationality_id',
        'job_number',
        'passport_number',
        'phone_number'
    ];

    public function nationlaity()
    {
        return $this->BelongsTo(Nationality::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function management()
    {
        return $this->belongsTo(Management::class);
    }
}
