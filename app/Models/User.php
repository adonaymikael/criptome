<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];
    protected $hidden = [
        'senha'
    ];


    public function log_in(String $user, String $senha){
        return DB::connection()->select('select * from users WHERE email =? and senha =?', [$user, $senha]);
    }

    public function getByID(String $id){
        return DB::connection()->select('select * from users WHERE id=?', [$id]);
    }
}
