<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Administrator extends Authenticatable implements JWTSubject
{
    public const ROLE_USER = 10;
    public const ROLE_ADMIN = 90;

    protected $fillable = ['name', 'email', 'password'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * JWTのsubject claimとなる識別子を取得
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * JWTに追加されるcustom claimsを含むキーバリュー配列を返す
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
