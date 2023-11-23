<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\base\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * Binds the model to Contact class.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
}
