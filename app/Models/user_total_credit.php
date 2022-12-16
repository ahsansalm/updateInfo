<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_total_credit extends Model
{
    protected $table = 'user_total_credits';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    use HasFactory;
}
