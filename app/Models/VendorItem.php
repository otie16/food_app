<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'units',
        // 'image',
        'description',
    ];

    // protected $table = 'mac_foods';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $table = 'vendor_items';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
