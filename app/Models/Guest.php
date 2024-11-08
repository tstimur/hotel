<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'guests';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'country'
    ];

}
