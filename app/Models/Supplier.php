<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'name',
        'phone',
    ];

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'supplier_id', 'supplier_id');
    }
}
