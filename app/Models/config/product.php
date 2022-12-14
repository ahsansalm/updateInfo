<?php

namespace App\Models\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\config\brand;
class product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(brand::class, 'product_id', 'id');
    }
}
