<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepository;
use App\Contracts\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // Implement repository methods here
}
