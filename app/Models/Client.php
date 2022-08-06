<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Client extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'clients';

    public function comptes(){
        return $this->hasMany(Compte::class);
    }

    protected $fillable = [
        'nom', 'prenom','datenais','lieu','quartier'
    ];
}
