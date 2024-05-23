<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends BaseModel
{

    use HasUuids;

   protected $fillable = ['id','name', 'email', 'created_at', 'updated_at'];

    public function userDetails()
    {
        return $this->hasOne(UserDetails::class);
    }
}
