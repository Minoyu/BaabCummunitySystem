<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndexHeadline extends Model
{
    //
    use SoftDeletes;
    protected $table = 'index_headlines';
    protected $guarded = [];
}
