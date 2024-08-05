<?php

namespace App\Listeners;

use App\Events\ChangePassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotificationChangePassword implements ShouldQueue
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
    public function handle(ChangePassword $event): void
    {
        $data = [
            'name' => $event->name,
            'email' => $event->email,
            'password' => $event->password
        ];
        // Gửi email
        Mail::send('admin.auth.authors.mailregister', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])
                ->subject('Bạn đã đổi mật khẩu thành công');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
