<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * attributes to be translated.
     * @var array|string[]
     */
    public array $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'merchant_id',
        'status'
    ];


    /**
     * store belongs to one merchant.
     */
    public function merchant()
    {
        return $this->belongsTo(User::Class);
    }
}
