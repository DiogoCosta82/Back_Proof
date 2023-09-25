<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;

class DossierController extends Controller
{
    // Assurez-vous que l'utilisateur est authentifié pour ces méthodes
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function checkDossier(Request $request)
    {
        $user = Auth::user(); // Récupère l'utilisateur actuellement authentifié
        $dossier = Dossier::where('user_id', $user->id)->first();

        if ($dossier) {
            return response()->json(['numero' => $dossier->numero]);
        } else {
            return response()->json(['numero' => null]);
        }
    }

    public function createDossier(Request $request)
    {
        $user = Auth::user(); // Récupère l'utilisateur actuellement authentifié
        $dossier = new Dossier();
        $dossier->user_id = $user->id;
        $dossier->numero = $request->numero;
        $dossier->save();

        return response()->json(['success' => true]);
    }
}
