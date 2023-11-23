<?php

namespace Tests\Unit;

use App\Helpers\SmsText;
use App\Models\Customer;
use App\Models\Order;
use PHPUnit\Framework\TestCase;

class SmsTextTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_generate_text()
    {
        $customer["name"]="soraya";
        $smsText=(new SmsText())->generateText($customer);
        $this->assertEquals($smsText,"Dear soraya,Your order has been registered successfully.Thank you.");
    }
}
