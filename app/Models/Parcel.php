<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    protected $table = 'parcels';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function parcel(){
        return $this->hasOne(Invoices::class, 'productId','id');
       }
    public function user(){
    return $this->hasOne(Register::class, 'user_id','userId');
    }
    public function servicedata(){
        return $this->hasOne(service::class, 'id','serviceRequest');
    }
    public function register(){
        return $this->hasOne(User::class, 'id','userId');
    }
}
