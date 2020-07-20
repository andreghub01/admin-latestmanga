<?php

namespace App\Models;

use App\Models\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','slug' ,'status','image', 'id_category' ,'id_wordpress', 'id_wordpress_media','id_wordpress_tag', 'content','alternative','author',
        'language','detail_status','genres','rating','views'
    ];

    protected $hidden = [

    ];

    public function result()
    {
        return $this->hasMany(Result::class,'id_comic');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'id_category','id');
    }
    // public function getImageAttribute($value)
    // {
    //     return url('comics/' . $value);
    // }
}
