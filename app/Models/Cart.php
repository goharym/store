<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'consumer_id',
        'product_id',
        'quantity'
    ];

    /**
     * get product data via relation.
     */
    public function product()
    {
        return $this->belongsTo(Product::Class);
    }
}
