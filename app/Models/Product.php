<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'quantity',
        'price',
    ];

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'product_id', 'product_id');
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class, 'product_id', 'product_id');
    }
}
