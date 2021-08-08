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

    public function A() {
        return $this->hasOne(User::class,"A");
    }

    public function B() {
        return $this->hasOne(User::class, "B");
    }
}
