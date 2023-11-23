<?php
namespace App\Services;
use App\Http\Requests\RegisterOrder;

interface OrderInterface{
    public function registerOrder(RegisterOrder $request);
}
