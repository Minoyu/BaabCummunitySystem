<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jcc\LaravelVote\CanBeVoted;

class NewsReply extends Model
{
    //
    use SoftDeletes,CanBeVoted;
    protected $table = 'news_replies';
    protected $guarded = [];

    public function news(){
        return $this->belongsTo(News::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
