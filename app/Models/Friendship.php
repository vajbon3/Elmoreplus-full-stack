<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    public $fillable = [
        "A",
        "B"
    ];

    public function one(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,"id","B");
    }

    public function two(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, "id","B");
    }
}
