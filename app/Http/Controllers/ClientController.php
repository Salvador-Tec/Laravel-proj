<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Assurez-vous d'importer le modèle Client


class ClientController extends Controller

{
    
    public function indexclient(Request $request)
{
    // Récupérer les clients triés par date de création et paginés
    $clients = Client::orderBy('created_at', 'desc')->paginate(10);

    // Vérifier que les images existent pour chaque client et les décoder si nécessaire
    foreach ($clients as $client) {
        if ($client->gallery) {
            $client->gallery = json_decode($client->gallery); // Si les images sont stockées en JSON, les convertir en tableau
        }
    }

    // Récupérer l'ID du client sélectionné via la requête (ou null par défaut)
    $selectedClientId = $request->input('selectedClient');

    // Retourner la vue avec les clients et l'ID du client sélectionné
    return view('admin.users', compact('clients', 'selectedClientId'));
}

    


    public function showClientByCIN($cin)
{
    try {
        // Rechercher le client par son numéro d'identité
        $client = Client::where('identity_number', $cin)->firstOrFail();

        // Retourner la vue des utilisateurs avec le client sélectionné
        return redirect()->route('users', ['selectedClient' => $client->id]);

    } catch (\Exception $e) {
        // Rediriger en cas d'erreur
        return redirect()->route('users')->with('error', 'Client introuvable.');
    }
}
    public function deleteUser($id)
{
    try {
        // Récupérer le client par son ID
        $client = Client::findOrFail($id);

        // Supprimer le client
        $client->delete();

        // Rediriger avec un message de succès
        return redirect()->route('users')->with('success', 'Client supprimé avec succès.');

    } catch (\Exception $e) {
        // En cas d'erreur, rediriger avec un message d'erreur
        return redirect()->route('users')->with('error', 'Erreur lors de la suppression du client.');
    }
}
}
