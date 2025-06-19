<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'reservasi_id',
        'event_id',
        'voucher_id',
        'order_type',
        'total_payment',
    ];

    /**
     * Mendapatkan user yang membuat pesanan.
     */
    public function user()
    {
        // Pastikan Anda memiliki model User
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendapatkan detail dari pesanan.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * Mendapatkan paket dari pesanan.
     */
    public function orderPackages()
    {
        return $this->hasMany(OrderPackage::class, 'order_id');
    }
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservasi_id');
    }
}
