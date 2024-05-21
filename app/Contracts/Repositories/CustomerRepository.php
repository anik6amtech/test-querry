<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepository;
use App\Contracts\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    // Implement repository methods here
}
