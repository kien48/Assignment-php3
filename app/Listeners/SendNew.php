<?php

namespace App\Listeners;

use App\Events\News;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNew implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(News $event): void
    {
        $data = [
            'name' => $event->name,
            'author_name' => $event->author_name,
            'email' => $event->email,
            'title' => $event->title,
            'link' => $event->link,
        ];

        // Gửi email
        try{
            Mail::send('admin.auth.editors.mail-news', $data, function($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject('Tác giả '.$data['author_name'].' đã đăng bài viết mới: '.$data['title']);
            });
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
        }
        echo "Basic Email Sent. Check your inbox.";
    }
}
