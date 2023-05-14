<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Uuid;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'is_admin',
        'writter_id',
        'reader_id',
        'last_login',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function writter()
    {
        return $this->hasOne(writter::class);
    }

    public function reader()
    {
        return $this->hasOne(reader::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = config('app.frontend_url') . "/reset-password=" . $token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
