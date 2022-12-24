<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCredit extends Model
{
    use HasFactory;
    protected $table = 'used_credits';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
