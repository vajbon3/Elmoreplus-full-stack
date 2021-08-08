<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function whose() {
        return $this->belongsTo(User::class, "to");
    }

    public function from() {
        return $this->belongsTo(User::class, "subject");
    }
}
