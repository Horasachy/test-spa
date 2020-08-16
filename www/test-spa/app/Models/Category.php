<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'external_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'category_id', 'id');
    }

}
