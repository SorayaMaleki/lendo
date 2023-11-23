<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use App\Helpers\SmsText;
use App\Models\User;
use App\Services\sms\SmsFactory;
use Exception;

class SmsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param object $notifiable
     * @param Notification $notification
     * @return void
     * @throws Exception
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $param = $notification->toSms($notifiable);
        $smsStrategy = SMSFactory::setProviderInstance($param["provider"]);
        $smsStrategy->send($param);
    }
}
