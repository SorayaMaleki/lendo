<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\base\BaseRepository;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * Binds the model to Contact class.
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}
