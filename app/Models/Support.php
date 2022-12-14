<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $table = 'supports';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function profile(){
        return $this->hasOne(Register::class, 'user_id','userId');
       }
    public function product(){
    return $this->hasOne(Parcel::class, 'id','productId');
    }
}
