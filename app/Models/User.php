<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Http\Controllers\CriarContaController;

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


    public function log_in(String $email){
        return DB::connection()->select('select * from users WHERE email =?', [$email]);
    }

    public function getByID(String $id){
        return DB::connection()->select('select * from users WHERE id=?', [$id]);
    }

    public function criarConta($dados){
        try{
            $connection = DB::connection()->insert('INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)',[$dados['nome'], $dados['email'], $dados['senha']]);
            $lastID = DB::getPdo()->lastInsertId();
            return ['result' => $connection, 'lastid' => $lastID];
        } catch (QueryException $ex){
            return  ['result' => false];
        }
    }
}
