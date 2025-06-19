<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'name',
        'category',
        'menu_package_id',
        'description',
        'price',
        'image_path',
    ];
}
