<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'job',
        'reason',
        'handler_id'
    ];
}
