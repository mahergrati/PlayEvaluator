<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'name', 'cin', 'role', 'team', 'score'
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
}
