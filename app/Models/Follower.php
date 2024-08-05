<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class,'member_id');
    }

}
