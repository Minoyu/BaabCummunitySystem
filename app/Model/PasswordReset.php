<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    //
    protected $table = 'password_resets';
    protected $guarded = [];

    public $timestamps = false;
    protected $primaryKey = 'email';

    public function user(){
        $user = User::where('email',$this->email)->first();
        return $user;
    }

}
