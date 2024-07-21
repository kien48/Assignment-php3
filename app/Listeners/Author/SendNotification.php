<?php

namespace App\Listeners\Author;

use App\Events\Author\CreateUserAuthor;
use Illuminate\Support\Facades\Mail;

class SendNotification
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
    public function handle(CreateUserAuthor $event): void
    {
        $data = [
            'name' => $event->name,
            'email' => $event->email,
            'password' => $event->password
        ];

        // Gửi email
        Mail::send('admin.auth.authors.mailregister', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject('Đăng ký tác giả thành công');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
