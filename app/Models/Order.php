<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 

    protected $fillable = [
        'product',
        'quantity',
        'price_per_product',
        'merchandiser',
        'product_id',
        'merchandiser_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function merchandiser()
    {
        return $this->belongsTo(Merchandiser::class, 'merchandiser_id');
    }
}
