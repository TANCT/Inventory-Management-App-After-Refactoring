<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Merchandiser extends User
{
    protected $table = 'merchandisers';

    public function orders()
    {
        return $this->hasMany(Order::class, 'merchandiser_id');
    }
}
