<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table= 'products';
    protected $primary_key='id';
    protected $fillable = [
        'name',
    	'price',	
        'sale_price',
        'color',
        'brand_id',
        'product_code'	,
        'gender'	,
        'function'	,
        'stock'	,
        'description'	,
        'image'	,
        'is-active',
    ];

    public function getBrandData(){
        return $this->hasOne(Brands::class,'id','brand_id');
    }
    
}
