<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'price', 'units', 'description', 'image',
    ];

    // protected $table = 'mac_foods';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
