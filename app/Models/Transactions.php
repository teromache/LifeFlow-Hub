<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "transactions";

    protected $fillable = [
        'type',
        'category_id',
        'amount',
        'date',
        'note',
        'image_url'
    ];

    protected $casts = [
        'id' => 'string',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
