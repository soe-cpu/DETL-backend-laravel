<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, UUID;

    use HasFactory, UUID;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
    ];

}
