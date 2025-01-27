@extends('layouts.myapp') {{-- Hérite de la mise en page principale --}}

@section('content')
<div class="container mx-auto mt-8">
<h2 class="text-2xl font-bold mb-6 ml-4">Liste des Clients</h2>

    {{-- Message de succès ou d'erreur --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table des clients --}}
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Prénom</th>
                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                    <th class="border border-gray-300 px-4 py-2">Nationalité</th>
                    <th class="border border-gray-300 px-4 py-2">Numéro d'Identité</th>
                    <th class="border border-gray-300 px-4 py-2">Numéro de Permis</th>
                    <th class="border border-gray-300 px-4 py-2">Adresse</th>
                    <th class="border border-gray-300 px-4 py-2">Numéro de Téléphone</th>
                    <th class="border border-gray-300 px-4 py-2">Cartes</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="@if(request('highlight') && request('highlight') == $client->identity_number) selected-row @endif">
                    <td class="border border-gray-300 px-4 py-2">{{ $client->last_name}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->first_name}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->nationality }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->identity_number }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->driver_license_number }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->address }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $client->mobile_number }}</td>
                   <td class="border border-gray-300 px-4 py-2">
    @if(is_array($client->gallery) && count($client->gallery) > 0)
        <!-- Bouton pour ouvrir la modale -->
        <button class="btn-super-attractive" onclick="openModal({{ $client->id }})">
            <i class="bi bi-image"></i> Voir les images
        </button>

        <!-- Modale Personnalisée -->
        <div id="modal{{ $client->id }}" class="modal-overlay">
            <div class="modal-content">
                <!-- Nouveau bouton de fermeture -->
                <button class="close-btn" onclick="closeModal({{ $client->id }})">X</button>
                <div class="modal-images">
                    @foreach ($client->gallery as $image)
                        <img src="{{ asset($image) }}" alt="Image du client" class="modal-image">
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p>Aucune image disponible</p>
    @endif
</td>

                    <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('deleteUser', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <Style> /*général pour le bouton attractif */
.btn-super-attractive {
    background: linear-gradient(45deg,rgb(175, 172, 170),rgb(53, 51, 52)); /* Dégradé de couleurs */
    color: white; /* Couleur du texte */
    font-size: 16px; /* Taille du texte */
    padding: 12px 24px; /* Espacement interne */
    border: none; /* Pas de bordure */
    border-radius: 50px; /* Coins arrondis */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Ombre douce */
    cursor: pointer; /* Curseur pointeur */
    transition: all 0.3s ease; /* Transition fluide */
}

.btn-super-attractive:hover {
    background: linear-gradient(45deg, rgb(175, 172, 170), rgb(53, 51, 52))); /* Inversion du dégradé */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* Augmentation de l'ombre */
    transform: scale(1.1); /* Zoom léger */
}

.btn-super-attractive i {
    margin-right: 10px; /* Espacement entre l'icône et le texte */
    font-size: 20px; /* Taille de l'icône */
}

/* Overlay de la modale */
/* Overlay de la modale */
.modal-overlay {
    display: none; /* Par défaut, la modale est masquée */
    position: fixed; /* Position fixe sur l'écran */
    top: 0;
    left: 0;
    width: 100%; /* Prend toute la largeur de l'écran */
    height: 100%; /* Prend toute la hauteur de l'écran */
    background: rgba(0, 0, 0, 0.9); /* Fond noir semi-transparent */
    justify-content: center; /* Centrer horizontalement */
    align-items: center; /* Centrer verticalement */
    z-index: 1000; /* Position au-dessus des autres éléments */
}

/* Contenu de la modale */
.modal-content {
    background-color: transparent; /* Fond transparent pour intégrer les images directement */
    width: 100%; /* Largeur pleine écran */
    height: 100%; /* Hauteur pleine écran */
    display: flex; /* Disposition flex */
    flex-direction: column; /* Colonnes flexibles */
    justify-content: center; /* Centrer verticalement */
    align-items: center; /* Centrer horizontalement */
    overflow: hidden; /* Supprime les débordements */
    position: relative; /* Nécessaire pour le bouton de fermeture */
}

/* Grille des images */
.modal-images {
    display: grid; /* Disposition en grille */
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Colonnes flexibles */
    gap: 20px; /* Espacement entre les images */
    width: 100%; /* Largeur complète */
    height: 100%; /* Hauteur complète */
    padding: 20px; /* Marges internes */
    overflow-y: auto; /* Scroll vertical si besoin */
}

/* Images dans la modale */
.modal-image {
    width: 100%; /* Largeur complète de la colonne */
    height: auto; /* Garde les proportions */
    max-height: 80vh; /* Limite la hauteur à 80% de la fenêtre */
    border-radius: 8px; /* Coins arrondis */
    object-fit: cover; /* Remplir l'espace sans déformation */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Effets au survol */
}

.modal-image:hover {
    transform: scale(1.05); /* Zoom léger */
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.5); /* Ombre lumineuse au survol */
}

/* Bouton de fermeture */
.close-btn {
    position: absolute; /* Position absolue */
    top: 20px; /* Décalage du haut */
    right: 20px; /* Décalage de la droite */
    background-color: red; /* Fond rouge */
    color: white; /* Texte blanc */
    border: none; /* Pas de bordure */
    padding: 15px; /* Taille interne */
    font-size: 24px; /* Taille du texte */
    cursor: pointer; /* Curseur pointeur */
    border-radius: 50%; /* Bouton circulaire */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Ombre */
    z-index: 1001; /* Par-dessus les images */
    transition: transform 0.3s ease, background-color 0.3s ease; /* Transitions */
}

.close-btn:hover {
    background-color: darkred; /* Rouge plus foncé au survol */
    transform: scale(1.2); /* Zoom léger */
}

/* Ajout d'une animation d'apparition pour la modale */
.modal-overlay.active {
    display: flex; /* Affiche la modale (centrée) */
    animation: fadeIn 0.4s ease; /* Animation d'apparition fluide */
}

@keyframes fadeIn {
    from {
        opacity: 0; /* Départ transparent */
    }
    to {
        opacity: 1; /* Apparition complète */
    }
}

</style>

    <script>
        function openModal(clientId) {
            // Ouvre la modale en affichant l'overlay
            var modal = document.getElementById("modal" + clientId);
            modal.style.display = "flex";
        }

        function closeModal(clientId) {
            // Ferme la modale en masquant l'overlay
            var modal = document.getElementById("modal" + clientId);
            modal.style.display = "none";
        }

        // Ferme la modale si l'utilisateur clique en dehors de la modale
        window.onclick = function(event) {
            var modals = document.querySelectorAll('.modal-overlay');
            modals.forEach(function(modal) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const highlightedRow = document.querySelector('tr.bg-green-100');
            if (highlightedRow) {
                highlightedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>

    {{-- Pagination --}}
    <div class="mt-4">
    </div>
</div>
@endsection
