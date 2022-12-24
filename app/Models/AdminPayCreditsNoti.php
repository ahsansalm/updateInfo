<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPayCreditsNoti extends Model
{
    use HasFactory;
    protected $table = 'admin_pay_credits_notis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}

