<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';
    protected $primaryKey = 'status_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'status_name',
    ];

    public function histories()
    {
        return $this->hasMany(OrderStatusHistory::class, 'status_id', 'status_id');
    }
}
