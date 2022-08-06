<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compteepargne extends Compte
{
    use HasFactory;
    protected $fillable = ['T'];
}
