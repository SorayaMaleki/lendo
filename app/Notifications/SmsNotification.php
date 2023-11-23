<?php

namespace App\Notifications;

use App\Broadcasting\SmsChannel;
use App\Helpers\SmsText;
use App\Models\Customer;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SmsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Customer $customer)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     * @throws Exception
     */
    public function toSms($notifiable)
    {
        $param['receiver_id'] = $this->customer->mobile;
        $param['message'] = SmsText::generateText($this->customer);
        $param['type'] = "simple";
        $param['provider'] = "parsasms";// Change this to 'kavehnegar' for a different strategy
        return $param;
    }
}
