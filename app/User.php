<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use \Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'province_id', 'access_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        public function sendPasswordResetNotification($token)
        {
            // Your your own implementation.
            $this->notify(new Notifications\MailResetPasswordNotification($token));
        }
    */


    public function user_province()
    {
        return $this->hasOne('App\Province', 'id', 'province_id');
    }
}
