<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'detail_orders';

    protected $fillable = ['order_id', 'menu_id', 'qty', 'price', 'status'];

    /**
     * Get the order that owns the Detail_Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Header_Order::class, 'order_id', 'id');
    }

    /**
     * Get the menu that owns the Detail_Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
