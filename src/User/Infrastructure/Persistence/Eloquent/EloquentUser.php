<?php

namespace App\User\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class EloquentUser extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $table = 'users';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'email',
        'password'
    ];
}
