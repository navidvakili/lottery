<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lottery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'group_id', 'default'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function toggleDefault()
    {
        if ($this->default != 1) {
            Lottery::where('id', '>', 0)->update(['default' => 0]);
            $this->update(['default' => !$this->default]);
        }
    }
}
