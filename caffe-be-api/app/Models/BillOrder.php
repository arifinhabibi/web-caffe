<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOrder extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $guarded = [];

    public function menuOrders(){
        return $this->hasMany(MenuOrder::class);
    }
}
