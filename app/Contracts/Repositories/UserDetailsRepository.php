<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepository;
use App\Contracts\Interfaces\UserDetailsRepositoryInterface;
use App\Models\UserDetails;

class UserDetailsRepository extends BaseRepository implements UserDetailsRepositoryInterface
{
    public function __construct(UserDetails $model)
    {
        parent::__construct($model);
    }

    // Implement repository methods here
}
