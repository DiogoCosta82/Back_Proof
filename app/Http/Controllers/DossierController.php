<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use Illuminate\Support\Facades\Log; 


class DossierController extends Controller
{
    public function checkDossier(Request $request)
    {
        $userId = $request->input('user_id');  // Récupérer le user_id de la requête
        $dossier = Dossier::where('user_id', $userId)->first();  // Rechercher un dossier avec ce user_id
    
        if ($dossier) {
            return response()->json(['n_dossier' => $dossier->n_dossier]);
        } else {
            return response()->json(['n_dossier' => null]);
        }
    }
    

    public function createDossier(Request $request)
{
    try {
        $userId = $request->input('user_id');  // Récupérer le user_id depuis la requête
        $nDossier = $request->input('n_dossier'); // Récupérer le n_dossier depuis la requête
        
        if ($userId && $nDossier) {
            $dossier = new Dossier();
            $dossier->user_id = $userId;
            $dossier->n_dossier = $nDossier;
            $dossier->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Informations manquantes dans la requête'], 400);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de la création du dossier'], 500);
    }
}
public function getDossiers()
{
    // Récupérer tous les dossiers avec le numéro de dossier et le nom de l'entreprise
    $dossiers = Dossier::select('dossiers.n_dossier', 'users.enterprise')
        ->leftJoin('users', 'dossiers.user_id', '=', 'users.id')
        ->get();

    return response()->json($dossiers);
}
    
}
