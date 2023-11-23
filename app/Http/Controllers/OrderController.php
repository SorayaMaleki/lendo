<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOrder;
use App\Repositories\CustomerRepositoryInterface;
use App\Services\OrderService;
use App\Traits\Response\ApiResponse;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * use ApiResponse for all responses
     */
    use ApiResponse;

    /**
     * Binds service.
     */
    public function __construct(public OrderService $orderService)
    {
    }

    /**
     * register an order
     */
    public function registerOrder(RegisterOrder $request): JsonResponse
    {
        $order = $this->orderService->registerOrder($request);
        return $this->successResponse($order, ["success"], 200);
    }
}
