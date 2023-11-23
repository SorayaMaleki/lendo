<?php
namespace App\Helpers;

use App\Models\Customer;

interface SmsTextInterface{
    public static function generateText(Customer $customer) ;
}
