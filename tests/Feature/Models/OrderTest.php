<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Permission;
use App\Models\TempMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\models\ModelHelperTesting;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    public function testInsertData()
    {
        $data = Order::factory()->make()->toArray();
        Order::create($data);
        $this->assertDatabaseHas("orders", $data);
    }
    public function testCustomerRelationWithOrder()
    {
        $order=Order::factory()->create();
        $this->assertTrue(isset($order->customer_id));
        $this->assertTrue($order->customer->first() instanceof Customer);
    }

}
