<?php

namespace App\Models;

use App\Models\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Web extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','url', 'status','xpath_chapter', 'xpath_last_update'
    ];

    protected $hidden = [

    ];

    public function result()
    {
        return $this->hasMany(Result::class,'id_web');
    }
}
