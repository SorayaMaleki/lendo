<?php

namespace Tests\Feature\Business;


use App\Models\Business;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelper;

class RegisterOrderTest extends TestCase
{

    use RefreshDatabase;
    use TestHelper;

    private const ROUTE = 'register_order';

    protected $customer;

    /**
     * Setup the test environment.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @dataProvider ordersDataProvider
     */
    public function validateBusinessFields($fieldName, $testVal, $errorMessage, $format = [])
    {
        $standardAttributes = Order::factory([$fieldName => $testVal])->raw();

        $expectedResponse = $this->getValidationErrorResponse([
            $fieldName => [__($errorMessage, ['attribute' => __("validation.attributes.$fieldName"), ...$format])],
        ]);
        $this->postJson(route(self::ROUTE), $standardAttributes)
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }


    /**
     * Data providers of business.
     * @return array
     */
    public function ordersDataProvider(): array
    {
        return [
            'test customer_id is required' => ['customer_id', '', 'validation.required'],
            'test customer_id is valid' => ['customer_id', 155, 'validation.exists'],
            'test amount is required' => ['amount', '', 'validation.required'],
            'test amount is valid' => ['amount', 14, 'validation.in'],
            'test invoice_count is required' => ['invoice_count', '', 'validation.required'],
            'test invoice_count is valid' => ['invoice_count', 140000, 'validation.in'],
        ];
    }


    /** @test */
    public function it_saves_order_for_customer_with_bank_account_number()
    {
        $customer = Customer::factory(["bank_account_number"=>"621717179875847"])->create();
        $attributes = Order::factory(["customer_id"=>$customer->id])->raw();
        $response=$this->postJson(route(self::ROUTE), $attributes)
            ->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "body" => [
                "invoice_count",
                "amount",
                "customer_id",
                "status",
                "updated_at",
                "created_at",
                "id",
            ]]);
        $result = json_decode(json_encode($response))->baseResponse->original;
        $this->assertTrue($result->status);
        $this->assertEquals(200, $result->status_code);
        $this->assertEquals("success", $result->message[0]);
        $this->assertEquals($attributes['customer_id'], $result->body->customer_id);
        $this->assertEquals($attributes["invoice_count"], $result->body->invoice_count);
        $this->assertEquals($attributes["amount"], $result->body->amount);
        $this->assertEquals("CHECK_HAVING_ACCOUNT",$result->body->status);
        $this->assertDatabaseHas('orders',
            [
                "invoice_count" => $attributes["invoice_count"],
                "amount" => $attributes["amount"],
                "status" => "CHECK_HAVING_ACCOUNT",
                "customer_id" => $attributes["customer_id"],
            ]
        );
    }

    /** @test */
    public function it_saves_order_for_customer_without_bank_account_number()
    {
        $customer = Customer::factory(["bank_account_number"=>""])->create();
        $attributes = Order::factory(["customer_id"=>$customer->id])->raw();
        $response=$this->postJson(route(self::ROUTE), $attributes)
            ->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "body" => [
                "invoice_count",
                "amount",
                "customer_id",
                "status",
                "updated_at",
                "created_at",
                "id",
            ]]);
        $result = json_decode(json_encode($response))->baseResponse->original;
        $this->assertTrue($result->status);
        $this->assertEquals(200, $result->status_code);
        $this->assertEquals("success", $result->message[0]);
        $this->assertEquals($attributes['customer_id'], $result->body->customer_id);
        $this->assertEquals($attributes["invoice_count"], $result->body->invoice_count);
        $this->assertEquals($attributes["amount"], $result->body->amount);
        $this->assertEquals("OPENING_BANK_ACCOUNT",$result->body->status);
        $this->assertDatabaseHas('orders',
            [
                "invoice_count" => $attributes["invoice_count"],
                "amount" => $attributes["amount"],
                "status" => "OPENING_BANK_ACCOUNT",
                "customer_id" => $attributes["customer_id"],
            ]
        );
    }
}
