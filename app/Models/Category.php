<?php

namespace App\Models;
use App\Models\Comic;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'id_wordpress_category'
    ];

    protected $hidden = [

    ];

    public function comic()
    {
        return $this->hasMany(Comic::class,'id_category');
    }

}
