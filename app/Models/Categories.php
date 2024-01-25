<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";
    protected $fillable = [
        'id',
        'name',
        'type',
    ];

    protected $casts = [
        'id' => 'string',
    ];
    public function category()
    {
        return $this->hasMany(Transactions::class, 'category_id');
    }
}
