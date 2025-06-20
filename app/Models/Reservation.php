<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservasi_id';

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'number_of_guests',
        'reservation_time',
        'status',
    ];
}
