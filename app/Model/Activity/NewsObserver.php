<?php

namespace App\Model\Activity;

use App\Model\News;
use App\Model\NewsReply;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class NewsObserver{

    /**
     * xss防护
     * @param News $news
     */
    public function saving(News $news){
        $news->content = clean($news->content,'topic_content');
    }

}