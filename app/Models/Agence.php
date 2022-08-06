<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'agences';

    public function comptes(){
        return $this->hasMany(Compte::class);
    }

    protected $fillable = [
        'libelle','numero', 'adresse','tel'
    ];
}
