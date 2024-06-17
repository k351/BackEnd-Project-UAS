<?php

namespace App\Models;

use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
    protected $table = 'buy_history';
=======

    protected $table = 'buy_history';
    
>>>>>>> Stashed changes
    protected $fillable =[
        "customer_id",
        "total",
        "transaction_date"
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
