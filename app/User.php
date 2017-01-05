<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'ID';

    //Custom Username
    public function findForPassport($identifier) {
        return User::where('Username', $identifier)->first();
    }

    //Custom Login
    public function validateForPassportPasswordGrant($password){
        return Hash::check($password, $this->Password);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
/*
    protected $fillable = [
        'name', 'email', 'password',
    ];
*/
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
/*
    protected $hidden = [
        'password', 'remember_token',
    ];
*/


}
