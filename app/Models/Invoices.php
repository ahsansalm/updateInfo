<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcel;
class Invoices extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


    public function neww(){
        return $this->hasOne(Parcel::class, 'id','productId');
       }
    public function user(){
        return $this->hasOne(Register::class, 'user_id','user_id');
    }

    public function servicedata(){
        return $this->hasOne(service::class, 'id','service_id');
    }
    public function register(){
        return $this->hasOne(User::class, 'id','user_id');
    }
}
