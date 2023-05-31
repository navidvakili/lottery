<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function lotteryMember()
    {
        return $this->hasMany(LotteryMember::class, 'client_id', 'id');
    }
}
