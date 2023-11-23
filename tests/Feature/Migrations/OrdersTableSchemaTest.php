<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OrdersTableSchemaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('orders', [
                'amount',
                'invoice_count',
                'customer_id',
                'status',
            ])
        );
    }
}
