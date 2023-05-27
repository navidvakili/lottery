<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryMember extends Model
{
    use HasFactory;
    protected $fillable = ['lottery_id', 'client_id', 'vahed'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }
}
