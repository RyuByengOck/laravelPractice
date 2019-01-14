<?php

namespace App\Listeners;

//use App\Events\article.created;

class ArticlesEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  article.created  $event
     * @return void
     */
    public function handle(\App\Events\ArticlesEvent $event)
    {
        if ($event->action === 'created') {
            \Log::info(sprintf(
                '새로운 포럼 글이 등록 되었습니다.: %s',
                $event->article->title
            ));
        }
        //
    }
}
