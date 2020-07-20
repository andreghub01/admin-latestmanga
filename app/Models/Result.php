<?php

namespace App\Models;

use App\Models\Comic;
use App\Models\Web;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_comic', 'id_web', 'short_url', 'last_chapter','last_update', 'regex', 'date_scraping','status'
    ];

    protected $hidden = [

    ];

    public function comic()
    {
        return $this->belongsTo(Comic::class,'id_comic','id');
    }

    public function web()
    {
        return $this->belongsTo(Web::class,'id_web','id');
    }

    // protected $table = 'results';
}
