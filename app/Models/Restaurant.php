<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    public function item()
    {
        return $this->hasMany(VendorItem::class);
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
