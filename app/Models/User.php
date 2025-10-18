<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject{
    use Authenticatable, Authorizable, HasFactory;
protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'username', 'email', 'password', 'image', 'comision', 'status', 'kind', 'stock_id', 'created_at', 'celular'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    // 🔹 Métodos requeridos por JWTSubject:
    public function getJWTIdentifier()
    {
        return $this->getKey(); // normalmente el 'id'
    }

    public function getJWTCustomClaims()
    {
        return []; // puedes agregar datos adicionales si quieres
    }
}
