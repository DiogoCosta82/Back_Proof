<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'n_dossier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
