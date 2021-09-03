<?php

namespace App\Infrastructure\User\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class EloquentUser extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $table = 'users';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'email',
        'password'
    ];
}
