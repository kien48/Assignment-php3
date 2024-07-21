<?php

namespace App\Listeners\Author;

use App\Events\Author\UnLockAuthor;
use Illuminate\Support\Facades\Mail;

class SendNotificationUnLock
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
    public function handle(UnLockAuthor $event): void
    {
        $data = [
            'name' => $event->name,
            'email' => $event->email,
        ];

        // Gửi email
        Mail::send('admin.auth.authors.maillockup', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject('Bạn đã được mở khóa tài khoản');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
