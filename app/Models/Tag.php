<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'id_wordpress_tag'
    ];

    protected $hidden = [

    ];
}
