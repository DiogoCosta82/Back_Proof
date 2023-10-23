<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndicateurData;

class IndicateurDataController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $indicateurData = new IndicateurData([
            'user_id' => $data['user_id'],
            'dossier_id' => $data['dossier_id'],
            'indicateur_id' => $data['indicateur_id'],
            'texte_indicateur' => $data['texte_indicateur'],
            'liens_preuve' => $data['liens_preuve'],
        ]);

        $indicateurData->save();

        return response()->json(['status' => 'success'],201);
    }
}
