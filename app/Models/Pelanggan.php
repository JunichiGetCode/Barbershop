<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    // Izinkan kolom ini diisi form
    protected $fillable = ['nama', 'no_hp'];
}