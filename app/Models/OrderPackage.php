<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_package_id';

    protected $fillable = [
        'order_id',
        'menu_package_id',
        'chef_id',
        'quantity',
        'note',
        'status',
    ];

    /**
     * Get the order that this package belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the menu item associated with this package item.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_package_id');
    }
}
