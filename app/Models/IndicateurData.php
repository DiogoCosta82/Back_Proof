<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicateurData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dossier_id',
        'indicateur_id',
        'texte_indicateur',
        'liens_preuve',
    ];
}
