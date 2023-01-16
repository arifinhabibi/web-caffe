<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuOrder extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $guarded = [];


    public function billOrder(){
        return $this->belongsTo(BillOrder::class);
    }

    protected $hidden = ['bill_order_id'];
}
