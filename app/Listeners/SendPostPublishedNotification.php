<?php

namespace App\Listeners;

use App\Mail\PostPublished;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Mail;

class SendPostPublishedNotification
{
    public function handle($event)
    {
        $subscribers = NewsLetter::subscribed()->get();

        foreach ($subscribers as $subscriber) {
            Mail::queue(new PostPublished($event->post, $subscriber->email));
        }
    }
}

