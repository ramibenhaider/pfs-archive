<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable =
    [
        'employee_id',
        'title',
        'note'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
//########## Any user cann interaction with this notes ###############