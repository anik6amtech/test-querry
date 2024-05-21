<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserDetails extends BaseModel
{
    use HasUuids;

    protected $fillable = ['user_id', 'address', 'phone', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
