<?php

namespace App\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'target_id',
        'product_id',
        'reason',
        'rating_id',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function rating(){
        return $this->belongsTo(Rating::class, 'rating_id');
    }
}
