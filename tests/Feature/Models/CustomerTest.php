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

class CustomerTestTest extends TestCase
{
    use RefreshDatabase;
    public function testInsertData()
    {
        $data = Customer::factory()->make()->toArray();
        Customer::create($data);
        $this->assertDatabaseHas("customers", $data);
    }
    public function testCustomerRelationWithOrder()
    {
        $count = rand(1, 10);
        $customer=Customer::factory()
            ->has(Order::factory()->count($count))
            ->create();
        $this->assertCount($count, $customer->orders);
        $this->assertTrue($customer->orders->first() instanceof Order);
    }

}
