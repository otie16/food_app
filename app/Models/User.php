<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// JWT contract
// use Kalnoy\Nestedset\NodeTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
  use HasFactory, Notifiable, SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'name',
    'email',
    'role',
    'password'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function getJWTIdentifier() {
    return $this->getKey();
  }
  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims() {
    return [];
  }

  public function item() {
        return $this->hasMany(VendorItem::class);
    }

    public function order() {
      return $this->hasMany(Order::class);
    }

    public function restaurants() {
      return $this->hasMany(Restaurant::class);
    }

    public function carts() {
      return $this->hasOne(Cart::class);
    }

    public function address()
    {
      return $this->hasMany(Address::class);
    }
  }
