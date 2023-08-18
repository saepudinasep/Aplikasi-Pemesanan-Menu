<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header_Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'header_orders';



    // public function setIdAttribute($value)
    // {
    //     $prefix = 'PM';
    //     $zeroes = str_repeat('0', 5 - strlen($value));
    //     $this->attributes['id'] = $prefix . $zeroes . $value;
    // }

    /**
     * Get the user that owns the Header_Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the table that owns the Header_Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }

    /**
     * Get all of the detailOrder for the Header_Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailOrder()
    {
        return $this->hasMany(Detail_Order::class, 'order_id', 'id');
    }
}
