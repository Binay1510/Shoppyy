<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primarykey='id';
    protected $fillable = [
        'user_id'	,
        'sub_total',
        'shipping'	,
        'tax_amount'	,
        'tax_rate'	,
        'amount',

    ];

    public function CustomerData(){
        return $this->hasOne(User::class, 'id','user_id')->select('id','fname');
    }
    public function lineItemsData(){
        return $this->hasMany(LineItem::class, 'order_id','id');
    }

}
