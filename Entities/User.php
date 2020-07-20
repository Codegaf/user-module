<?php

namespace Modules\User\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Hash;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCreatedAtAttribute($value) {
        $date = Carbon::parse($value);
        return $date->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($value) {
        $date = Carbon::parse($value);
        return $date->format('d/m/Y');
    }
}
