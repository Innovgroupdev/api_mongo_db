<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'comptes';

    public function compte(){
        return $this->belongsTo(Client::class);
    }
    public function agence(){
        return $this->belongsTo(Agence::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    protected $fillable = ['numero', 'M','sold','client_id','agence_id'];
}
