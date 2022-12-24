<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayCreditsNoti extends Model
{
    use HasFactory;
    protected $table = 'user_pay_credits_notis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function data(){
        return $this->hasOne(Register::class, 'user_id','userId');
    }
}
