<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * attributes to be translated.
     * @var array|string[]
     */
    public array $translatedAttributes = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'store_id',
        'status',
        'price',
        'vat_type',
        'vat_amount',
    ];

    /**
     * Set vat amount.
     * @param $vat_amount
     */
    public function setVatAmountAttribute($vat_amount)
    {
        $this->attributes['vat_amount'] = $vat_amount / 100;
    }

    /**
     * get category data via relation.
     */
    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    /**
     * get store data via relation.
     */
    public function store()
    {
        return $this->belongsTo(Store::Class);
    }

}
