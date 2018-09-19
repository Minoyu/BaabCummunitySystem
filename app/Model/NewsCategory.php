<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    //
    use SoftDeletes;
    protected $table = 'news_categories';
    protected $guarded = [];

    public function news(){
        return $this->hasMany(News::class);
    }
}
