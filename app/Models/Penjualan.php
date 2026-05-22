<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

   class Penjualan extends Model
{

    use HasFactory;
    protected $table = 'penjualan';

    protected $fillable = [
        'users_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status'
    ];

     public function User ()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
     public function itemPenjualan()
    {
        return $this->hasMany(itemPenjualan::class, 'penjualan_id');
    }
    
    //
}
