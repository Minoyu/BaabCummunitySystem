<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCarousel extends Model
{
    //
    use SoftDeletes;
    protected $table = 'news_carousels';
    protected $guarded = [];
}
