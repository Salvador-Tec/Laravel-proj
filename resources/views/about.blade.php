@extends('layouts.myapp')
@section('content')
<!-- Lien vers le CSS spécialisé About -->
<link rel="stylesheet" href="assets/css/about.css">

<!--<< Breadcrumb Section Start >>-->

<div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/images/MarouVoiture.jpg');">
    <div class="container">
        <div class="page-heading">
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                <li>
                    <a href="/">accueil</a>
                </li>
                <li>
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li>Qui sommes nous</li>
            </ul>
            <h1 class="wow fadeInUp" data-wow-delay=".5s">Qui sommes nous</h1>
        </div>
    </div>
</div>

<!-- About Section Start -->
<section class="about-section fix section-padding">
    <div class="container">
        <div class="about-wrapper-2">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="about-image">
                        <img src="assets/images/01.png" alt="about-image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <img src="assets/images/sub-icon.png" alt="icon-img" class="wow fadeInUp">
                            <span class="wow fadeInUp" data-wow-delay=".2s">Pourquoi choisir SIGMA Rent à Car ?</span>
                        </div>
                        <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".6s">
                            SIGMA Rent à Car se distingue par son engagement à offrir à chaque client une expérience de location simple,
                             fiable et personnalisée. Grâce à une flotte moderne et variée
                              (citadines, berlines, SUV et utilitaires),
                               nous répondons à tous les besoins et budgets,
                                tout en garantissant des véhicules entretenus et sécurisés.
                                 Nos tarifs transparents sans frais cachés, 
                                 notre service d'assistance disponible 7 j/7 et nos options flexibles 
                                 (retraits et retours 24 h/24, aller simple, kilométrage étendu) 
                                 assurent une tranquillité d'esprit totale. Choisir SIGMA Rent à Car,
                                  c'est opter pour la qualité, la réactivité 
                                  et la sérénité lors de chacun de vos déplacements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection