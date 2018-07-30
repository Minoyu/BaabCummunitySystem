<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    //
    use SoftDeletes;
    protected $table = 'news';
    protected $guarded = [];

    //news-newsCategory many-one
    public function newsCategory(){
        return $this->belongsTo(NewsCategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
