<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function compte(){
        return $this->belongsTo(Compte::class);
    }
    public function typetransaction(){
        return $this->belongsTo(Typetransaction::class);
    }
    protected $fillable = ['dateT','prixT','M'];
}
