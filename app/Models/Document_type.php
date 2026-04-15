<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    protected $fillable =
    [
        'type',
        'typeEn'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
