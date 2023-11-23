<?php

namespace App\Helpers;


use App\Models\Customer;
use Illuminate\Http\Request;

class SmsText implements SmsTextInterface
{
    /**
     * @param Customer $customer
     * @return string
     */
    public static function generateText(Customer $customer)
    {
        return "Dear {$customer->name},Your order has been registered successfully.Thank you.";
    }
}
