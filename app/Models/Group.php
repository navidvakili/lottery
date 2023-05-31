<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function members()
    {
        return $this->hasMany(Client::class, 'group_id', 'id');
    }

    public function lottery()
    {
        return $this->hasMany(Lottery::class, 'group_id', 'id');
    }
}
