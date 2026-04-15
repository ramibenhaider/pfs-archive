<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyNote extends Model
{
    protected $fillable = [
        'title',
        'note',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
