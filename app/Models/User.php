<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $table = 'users';
    // Specify the primary key
    protected $primaryKey = 'employee_id';

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
        'email',
        'password',
        'is_active',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_active',
        'is_admin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the is_active attribute as a boolean.
     *
     * @return bool
     */
    public function getEmpStatusAttribute()
    {
        return $this->is_active
            ? '<span class="badge bg-success text-white">Active</span>'
            : '<span class="badge bg-danger text-white">Inactive</span>';
    }

    /**
     * Get the is_admin attribute as a boolean.
     *
     * @return bool
     */
    public function getAdminStatusAttribute()
    {
        return $this->is_admin
            ? '<span class="badge bg-primary text-white">Admin</span>'
            : '<span class="badge bg-secondary text-white">CRM Staff</span>';
    }

    public function getRouteKeyName()
    {
        return 'employee_id';
    }
}
