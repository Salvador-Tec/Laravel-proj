<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Assurez-vous d'importer le modèle Client
use App\Models\Reservation;


class ClientController extends Controller

{
    public function index()
{
    $clients = Client::all(); // ou ->paginate(10) si pagination
    return view('admin.clients', compact('clients'));
}

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

public function searchClients(Request $request)
{   
    // Récupérer le CIN de la requête
    $cin = $request->input('cin');
    
    // Recherche des clients par CIN ou récupération de tous les clients
    if ($cin) {
        $clients = Client::where('identity_number', 'like', '%' . $cin . '%')->paginate(10);
    } else {
        $clients = Client::paginate(10);
    }

    // Vérifier que les images existent pour chaque client et les décoder si nécessaire
    foreach ($clients as $client) {
        if ($client->gallery) {
            $client->gallery = json_decode($client->gallery); // Si les images sont stockées en JSON, les convertir en tableau
        }
    }

    // Retourner la vue avec les clients et le CIN pour afficher dans le formulaire de recherche
    return view('admin.users', compact('clients', 'cin'));
}

public function edit($id)
{
    // Récupérer le client à partir de l'ID
    $client = Client::findOrFail($id);
    
    // Retourner la vue avec les données du client
    return view('clients.edit', compact('client'));
}

// App\Http\Controllers\ClientController.php

public function update(Request $request, $id)
{
    // Validate the input data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'place_of_birth' => 'required|string|max:255',
        'nationality' => 'required|string|max:255',
        'identity_number' => 'required|string|max:255|unique:clients,identity_number,'.$id,
        'driver_license_number' => 'required|string|max:255|unique:clients,driver_license_number,'.$id,
        'address' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:15',
        'gallery.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the client to update
    $client = Client::findOrFail($id);

    // Update basic client data
    $client->update($request->except('gallery'));

    // Handle gallery image upload
    if ($request->hasFile('gallery')) {
        $imagePaths = [];
        
        // Initialize with existing images if they exist
        if ($client->gallery) {
            $imagePaths = json_decode($client->gallery, true);
        }

        // Store new images
        foreach ($request->file('gallery') as $image) {
            $path = $image->store('images/clients', 'public');
            $imagePaths[] = $path;
        }

        // Save the updated gallery image paths
        $client->gallery = json_encode($imagePaths);
        $client->save();
    }
    return redirect()->route('users', $client->id)->with('success', 'Client mis à jour avec succès');

}
public function show($id)
{
    $client = Client::findOrFail($id);
    
    // Récupérer toutes les réservations où le client est impliqué
    $reservationsAsMain = Reservation::where('identity_number', $client->identity_number)
        ->with('car')
        ->get();
        
    $reservationsAsSecondary = Reservation::where('identity_number_conducteur', $client->identity_number)
        ->with('car')
        ->get();
    
    // Fusionner les deux collections
    $allReservations = $reservationsAsMain->merge($reservationsAsSecondary);
    
    return view('clients.show', [
        'client' => $client,
        'allReservations' => $allReservations
    ]);
}

public function detailsClients($id)
{
    $client = Client::findOrFail($id);
    
    
    // Récupérer toutes les réservations où le client est impliqué
    $reservationsAsMain = Reservation::where('identity_number', $client->identity_number)
        ->with('car')
        ->get();
        
    $reservationsAsSecondary = Reservation::where('identity_number_conducteur', $client->identity_number)
        ->with('car')
        ->get();
    
    // Fusionner les deux collections
    $allReservations = $reservationsAsMain->merge($reservationsAsSecondary);
    
    return view('clients.detailsclients', [
        'client' => $client,
        'allReservations' => $allReservations
    ]);
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
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');

    } catch (\Exception $e) {
        // En cas d'erreur, rediriger avec un message d'erreur
        return redirect()->route('clients.index')->with('error', 'Erreur lors de la suppression du client.');
    }
}

public function store(Request $request)
{
    $client = new Client();

    // Données du client principal
    $client->first_name = $request->first_name;
    $client->last_name = $request->last_name;
    $client->identity_number = $request->identity_number;
    $client->driver_license_number = $request->driver_license_number;
    $client->identity_date = $request->identity_date;
    $client->license_date = $request->license_date;
    $client->date_of_birth = $request->date_of_birth;
    $client->place_of_birth = $request->place_of_birth;
    $client->nationality = $request->nationality;
    $client->address = $request->address;
    $client->mobile_number = $request->mobile_number;

    // Galerie principale
    if ($request->hasFile('gallery')) {
        $images = [];
        foreach ($request->file('gallery') as $image) {
            $path = $image->store('client_gallery', 'public');
            $images[] = $path;
        }
        $client->gallery = json_encode($images);
    }

    // Vérifiez si les données du conducteur secondaire existent avant de les ajouter
    if ($request->has('first_name_conducteur') && $request->first_name_conducteur) {
        $client->first_name_conducteur = $request->first_name_conducteur;
        $client->last_name_conducteur = $request->last_name_conducteur;
        $client->identity_number_conducteur = $request->identity_number_conducteur;
        $client->driver_license_number_conducteur = $request->driver_license_number_conducteur;
        $client->identity_date_conducteur = $request->identity_date_conducteur;
        $client->license_date_conducteur = $request->license_date_conducteur;
        $client->date_of_birth_conducteur = $request->date_of_birth_conducteur;
        $client->place_of_birth_conducteur = $request->place_of_birth_conducteur;
        $client->nationality_conducteur = $request->nationality_conducteur;
        $client->address_conducteur = $request->address_conducteur;
        $client->mobile_number_conducteur = $request->mobile_number_conducteur;

        // Galerie du conducteur secondaire
        if ($request->hasFile('gallery_conducteur')) {
            $images = [];
            foreach ($request->file('gallery_conducteur') as $image) {
                $path = $image->store('conducteur_gallery', 'public');
                $images[] = $path;
            }
            $client->gallery_conducteur = json_encode($images);
        }
    }

    // Sauvegarde du client
    $client->save();

    return redirect()->back()->with('success', 'Client enregistré avec conducteur secondaire !');
}

public function toggleBlock($id)
{
    $client = Client::findOrFail($id);
    $client->is_blocked = !$client->is_blocked;
    $client->save();

    return response()->json(['success' => true, 'is_blocked' => $client->is_blocked]);
}

} 