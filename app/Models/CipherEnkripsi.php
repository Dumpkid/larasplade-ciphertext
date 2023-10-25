<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CipherEnkripsi extends Model
{
    use HasFactory;

    protected $fillable = ['plainteks','enkripsi_key','cipherteks','dekripsi_key'];
    protected $table = 'cipherteks';
}
