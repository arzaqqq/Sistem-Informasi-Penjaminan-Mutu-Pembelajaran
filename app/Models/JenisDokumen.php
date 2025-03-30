<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $guarded = [];

     public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}
