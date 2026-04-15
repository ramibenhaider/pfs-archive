<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\User\MyNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'admin_id',
        'is_active',
        'myNotes'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::Class, 'user_permissions');
    }

    public function myNotes()
    {
        return $this->hasMany(MyNote::class);
    }

    public function hasPermission(string $permission)
    {
        return $this->is_active && $this->permissions->contains('name', $permission);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'createEmployee' => 'boolean',
            'deleteEmployee' => 'boolean',
            'updateEmployee' => 'boolean',
            'createDoc' => 'boolean',
            'showDoc' => 'boolean',
            'deleteDoc' => 'boolean',
        ];
    }
}
