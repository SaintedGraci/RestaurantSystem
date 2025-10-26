<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'link',
        'description',
        'image',
        'group_name',
        'price',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
