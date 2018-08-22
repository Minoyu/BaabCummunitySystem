<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndexCarousel extends Model
{
    //
    use SoftDeletes;
    protected $table = 'index_carousels';
    protected $guarded = [];
}
