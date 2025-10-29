<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, LogsActivity,SoftDeletes;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                "first_name",
                "last_name",
                "email",
                "phone",
                "role",
                "email_verified_at",
                "password",
                "status",
            ])
            ->useLogName('User')
            ->logOnlyDirty();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'email_verified_at',
        'password',
        'status',
    ];

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
            'password'          => 'hashed',
        ];
    }

    /**
     * Get the full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the created_at attribute as a Carbon instance.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAtAttribute(): \Carbon\Carbon
    {
        return \Carbon\Carbon::parse($this->attributes['created_at']);
    }

    /**
     * Get the updated_at attribute as a Carbon instance.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAtAttribute(): \Carbon\Carbon
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at']);
    }
}
