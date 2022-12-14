<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemReply extends Model
{
    use HasFactory;
    protected $table = 'problem_replies';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function product(){
        return $this->hasOne(Parcel::class, 'id','productId');
       }
       
    public function profile(){
        return $this->hasOne(Register::class, 'user_id','adminId');
    }
}
