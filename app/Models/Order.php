<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);

    }
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function apiUser()
    {
        return $this->belongsTo(User::class,'user_id')->select('id','name');
    }
}
