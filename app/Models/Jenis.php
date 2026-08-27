<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';

    protected $fillable = [
        'user_id',
        'nama_jenis',
    ];

     public function User ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
     public function produk()
    {
        return $this->hasMany(produk::class, 'jenis_id');
    }
    
}
