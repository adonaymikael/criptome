<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class criptomoedas extends Model
{
    use HasFactory;
    protected $table = 'criptomoedas';

    protected $fillable = [
        'apiID',
        'users_id',
    ];
    protected $hidden = [
        'users_id'
    ];

    public function insert_moeda(String $userID, String $moedaID){
        return DB::connection()->insert('INSERT INTO criptomoedas (apiID, users_id) VALUES (?, ?)',[$moedaID, $userID]);
    }

    public function verifica_moeda(String $userID, String $moedaID){
        return DB::connection()->select('SELECT * FROM criptomoedas WHERE apiID = ? AND users_id = ?',[$moedaID, $userID]);
    }

    public function getByUserID(String $userID){
        return DB::connection()->select('SELECT * FROM criptomoedas WHERE users_id = ?',[$userID]);
    }

}
