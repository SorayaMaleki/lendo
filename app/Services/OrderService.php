<?php

namespace App\Services;

use App\Helpers\SmsText;
use App\Http\Requests\RegisterOrder;
use App\Notifications\SMS\OTPNotification;
use App\Notifications\SmsNotification;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Services\sms\SmsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class OrderService implements OrderInterface
{
    /**
     * Binds repository.
     */
    public function __construct(
        public OrderRepositoryInterface    $orderRepository,
        public CustomerRepositoryInterface $customerRepository
    ){}

    /**
     * register an order
     */
    public function registerOrder(RegisterOrder $request): Model
    {
        $customer = $this->customerRepository->find($request->customer_id);
        $status = $customer->bank_account_number ? "CHECK_HAVING_ACCOUNT" : "OPENING_BANK_ACCOUNT";
        $request->merge(['status' => $status]);
        $order= $this->orderRepository->create($request->all());

        //send SMS notification to customer
        Notification::send($customer, new SmsNotification($customer));
        return $order;

    }
}
