<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $appends = ['profit_percent','profit'];



    public function getProfitPercentAttribute(){
        $profit = $this->sale_price - $this->purchase_price ;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
    public function getProfitAttribute(){
        $profit = $this->sale_price - $this->purchase_price ;
        return number_format($profit,2);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class , 'product_order');
    }
}
