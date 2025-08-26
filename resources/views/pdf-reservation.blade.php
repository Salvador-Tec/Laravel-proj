<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Header avec trois parties</title>
  <style>
    /* Style général du body */
    body {
      font-family: "amiri" , sans-serif; 
      margin: 0;
      padding: 0;
      
    }

    .firstcadre{
     border: 1px solid black;      /* Bordure noire autour du header */
      background-color: #f4f4f4; 
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
      margin-top:10px;
      width: 100%;
      height: 30px;
      font-size: 12px;
}
    /* Style du header */
    header {
      display: flex;                /* Utilisation de flexbox pour aligner les parties horizontalement */
      justify-content: space-between; /* Espacement entre les parties */
      align-items: center;          /* Centrer verticalement les éléments */
      height: 150px;                /* Hauteur augmentée pour rendre la partie plus grande */
      padding: 10px;
      border: 1px solid black;      /* Bordure noire autour du header */
      background-color: #f4f4f4;    /* Fond gris clair */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
    }

    /* Style pour chaque partie du header */
    .partie-gauche, .partie-centrale, .partie-droite {
      width: 30%;   
      height: 100px;                /* Chaque partie occupe 30% de la largeur du header */                /* Augmentation de espace interne */
      text-align: center;
      background-color: #f4f4f4; /* Fond blanc transparent */
      border-radius: 5px;           /* Coins arrondis */
      padding-left: 5px;
      padding-right: 5px;                  /* Positionné en haut du header */


    }

    /* Classes spécifiques pour chaque partie */
    .partie-gauche {
      padding-bottom: 60px;
      width: 30%;
      transform: translateY(-10%);
    }

    .partie-centrale {
      position: absolute;              /* Position absolue pour la partie centrale */
      top: 10px;                       /* Positionné en haut du header */
      left: 50%;                       /* Centré horizontalement */
      transform: translateX(-50%);     /* Correction de alignement pour être parfaitement centré */
      padding-bottom: 50px;
    }

    .partie-droite {
    /* Fond blanc transparent */
      position: absolute;              /* Position absolue pour la partie droite */
      top: 0px;                       /* Aligner avec le haut du header */
      left: 83%;                       /* Positionner à droite de la partie centrale */
      transform: translateX(-50%);     /* Centrer horizontalement par rapport à son propre bloc */
      padding-bottom: 50px;
    }

    .cadre-matricule{
        width: 40%;                  /* 15% de la largeur de la page */
      height: 40px;               /* Hauteur de la page */
      background-color: #f4f4f4;   /* Fond gris clair */
      border: 1px solid black; 
   
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */
      display: flex;
      flex-direction: column;       /* Organiser les éléments en colonne */
      gap: 10px;                    /* Espacement entre les lignes */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
      margin-top:0;
      padding-right: 160px;     /* Ajouter un peu de padding pour laisser un espace au bas */
      border-bottom: 1px solid black;
      padding-top: 5px;
      
    }

    .cadre-important{
      width: 40%;                  /* 15% de la largeur de la page */
      height: 40px;               /* Hauteur de la page */
      background-color: #f4f4f4;   /* Fond gris clair */
      border: 1px solid black; 
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */
      display: flex;
      flex-direction: column;       /* Organiser les éléments en colonne */
      gap: 10px;                    /* Espacement entre les lignes */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
      margin-top:0;
      padding-right: 160px;     /* Ajouter un peu de padding pour laisser un espace au bas */
      border-bottom: 1px solid black;
      padding-top: 5px;
      padding-bottom: 10px;
      margin-left: 5px;
    }

    /* Style du cadre à gauche */
    .cadre-gauche {
      width: 50%;                  /* 15% de la largeur de la page */
      height: 120px;               /* Hauteur de la page */
      border: 1px solid black; 
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */
      display: flex;
      flex-direction: column;       /* Organiser les éléments en colonne */
      gap: 10px;                    /* Espacement entre les lignes */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
      margin-top:0;
      padding-right: 0px;     /* Ajouter un peu de padding pour laisser un espace au bas */
      border-bottom: 35px solid black;
      padding-top: 5px;
      padding-bottom: 39px;         /* Padding en bas */
      border-bottom: 1px solid black; /* Bordure noire en bas */      
    }

    .cadre-voiture{
      width: 50%;                  /* 15% de la largeur de la page */
      height: 140px;               /* Hauteur de la page */  /* Fond gris clair */
      border: 1px solid black; 
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */
      display: flex;
      flex-direction: column;       /* Organiser les éléments en colonne */
      gap: 10px;                    /* Espacement entre les lignes */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
     
      padding-right: 0px;     /* Ajouter un peu de padding pour laisser un espace au bas */
      border-bottom: 40px solid black;
      padding-top: 5px;
      padding-bottom: 39px;         /* Padding en bas */
      border-bottom: 1px solid black;
    }

    .cadre-img{
      width: 40%;                  /* 15% de la largeur de la page */
      height: 100px;   
      padding-right: 70px;            /* Hauteur de la page */
      border: 1px solid black; 
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */                  /* Espacement entre les lignes */        /* Nécessaire pour le positionnement absolu des éléments enfants */
      margin-top:0;    /* Ajouter un peu de padding pour laisser un espace au bas */
      border-bottom: 35px solid black;        /* Padding en bas */
      border-bottom: 1px solid black;
      padding-bottom: 55px;
    }

    .cadre_second{
      width: 70%;                  /* 15% de la largeur de la page */
      height: 30px;               /* Hauteur de la page */
      background-color: #f4f4f4;   /* Fond gris clair */
      border: 1px solid black; 
      padding: 5px;
      box-sizing: border-box;       /* Inclure le padding dans la largeur et la hauteur */
      display: flex;
      flex-direction: column;       /* Organiser les éléments en colonne */
      gap: 10px;                    /* Espacement entre les lignes */
      position: relative;           /* Nécessaire pour le positionnement absolu des éléments enfants */
      padding-right: 100px;
      border-bottom: 1px solid black;
      padding-bottom: 20px;
      bottom: 30px;
    }

    .cadre_info {
    font-size: 8px; /* Taille du texte réduite */
    line-height: 1.2; /* Ajuste l’espacement entre les lignes */
    width: 78%; /* S'assure que le div prend toute la largeur */
    background-color: #f4f4f4; /* Fond gris clair */
    border: 1px solid black; /* Bordure noire */
    padding: 5px; /* Ajoute un peu d'espace intérieur */
    box-sizing: border-box; /* Inclut le padding dans la largeur */
    text-align: justify; /* Justifie le texte pour qu'il occupe toute la largeur */
    word-spacing: -1px; /* Réduit légèrement l'espace entre les mots */
    hyphens: auto; /* Active la césure automatique pour éviter les gros espaces */
    margin-bottom: -12px;

}




    /* Style pour la balise <hr> */
    hr {
      width: 50%;                 /* Étend la ligne sur toute la largeur du cadre */
      border: 0;                   /* Supprime les bordures par défaut */
      border-top: 1px solid black; /* Crée une bordure horizontale noire */
      margin: 0;                   /* Élimine les marges autour de la ligne */
      padding: 0;                  /* Élimine les espacements autour de la ligne */
      box-sizing: border-box;      /* Assure que la largeur de la ligne est 100% y compris les bordures */
      padding-right: 170px; 
      padding-top: 5px; 
}
.vh{
    padding-right: 244px; 
}
.demi{
  padding-right: 10px; 
}


.vide{
    padding: 0;
    width: 100%;
    padding-left: 10px;
}

.champ{
  width: 100px;  /* Largeur personnalisée */
  height: 10px;  /* Hauteur personnalisée */
  text-align: right;
}



.important{
    position: relative;              /* Position absolue pour la partie droite */
    top: 7px;                       /* Aligner avec le haut du header */
    left: 250px;                       /* Positionner à droite de la partie centrale */
    transform: translateX(-60%);     /* Centrer horizontalement par rapport à son propre bloc */
    padding-bottom: 100px;
    width: 100%;
    

}
.droit{
    position: absolute;              /* Position absolue pour la partie droite */
    top: 215px;                       /* Aligner avec le haut du header */
    left: 83%;                       /* Positionner à droite de la partie centrale */
    transform: translateX(-50%);     /* Centrer horizontalement par rapport à son propre bloc */
    padding-bottom: 200px;
    margin-left: 0px;
    width: 60%;
    padding-right: 100px;
}

.ligne {
    font-size: 12px;
    padding-left: 10px;
    padding-top: 3px;
    
    
}
.data {
  color: blue;  /* Applique une couleur bleue aux données */
  font-size: 11px;
 width: 100%;
}
.ligne_bas{
    font-size: 12px;
    padding-left: 10px;
    padding-top: 3px;
    padding-bottom: 1px;
}
.Carburant{   
    font-size: 12px;
    padding-left: 10px;
    transform: translateY(-30%); 
    padding-bottom: 1px;
    flex-grow: 1;
}
.icon{
  transform: translateY(30%); 
  width: 50%;
}

.cautionnement{
  position: absolute;              /* Position absolue pour la partie droite */
    top: 200px;                       /* Aligner avec le haut du header */
    left: 30%;                       /* Positionner à droite de la partie centrale */
    transform: translateX(-50%);     /* Centrer horizontalement par rapport à son propre bloc */
   
    margin-left: 0px;
    width: 60%;
    padding-right: 100px;
}
.paiement{
    transform: translateY(-100%);             /* Position absolue pour la partie droite */                       /* Positionner à droite de la partie centrale */
    transform: translateX(-1%);     /* Centrer horizontalement par rapport à son propre bloc */
    width: 80%;
}
.imp{
  font-size: 12px;
  padding-left: 10px;
}
.rmq{
  font-size: 12px;
  padding-left: 10px;
}


.type{
  font-size: 12px;
  height: 20px;
  padding-left: 10px;
  width: 100%;
}
.mat{
  font-size: 12px;
  padding-left: 10px;
}

.police{
font-size: 13px;
bottom: 10%;
margin-top: 5px;
color: rgb(216, 46, 46);

}
.police_info{
  font-size: 13px;
color: rgb(216, 46, 46); 
transform: translateY(-100%);
  margin-top: -7px;
  margin-bottom: -20px;
}
.police_facture{
  font-size: 13px;
margin-bottom: 10px;
color: rgb(216, 46, 46); 
transform: translateY(-100%);
margin-top: 0;

}

.police_location{
  width: 100%;
  font-size: 13px;
  color: rgb(216, 46, 46); 
  transform: translateY(-100%); 
}
.police_cautionnement{
  font-size: 13px;
  color: rgb(216, 46, 46); 
  transform: translateY(-100%); 
}
.NB {
  font-size: 11px;
  transform: translateY(-70%); 
  text-align: center; /* Centre le texte à l'intérieur de l'élément */
  width: 100%;  /* Assure que l'élément prend toute la largeur */
  margin: 0 auto; /* Centre l'élément horizontalement */
}

.police_paiement{
  transform: translateY(-100%);
  margin-top: 10px;
  margin-bottom: 20px;
  font-size: 13px;
  color: rgb(216, 46, 46); 
}
.N{
  font-size: 11px;
  top: 10px;
}
label{
  font-size: 11px;
  padding-top: 100px;
}
.l_2{
  position: relative;
  margin-bottom:10px; 
  padding-right: 100px;
  top: 8px;
  width: 100%;
}
.checkbox{
  height: 15px;
}
.loc{
  font-size: 13px;
}

footer {
  width: 100%;

  padding-left: 10%;
  transform: translateY(80%);

}


/* Section gauche dans le footer */
.footer-left {
  height: 20%;
    text-align: left;
    font-size: 12px; 
    transform: translateX(-100%);
    padding-left: 10%;
}


/* Section droite dans le footer */
.footer-right {
    text-align: right;
    font-size: 12px; 
    transform: translateX(-100%); 
    width: 100%;
    padding-left: 70%;
    padding-right: 100%;
  
}

.boldA {
      font-weight: bold;
      font-size: 11px;
      width: 100%;
      transform: translateX(-100%); 
    }
.bold {
      font-weight: bold;  /* Texte en gras */
      font-size: 11px;  /* Taille de police */
      width: 100%;  /* Largeur totale */
      text-align: center;  /* Centre le texte */
      display: block;  /* Permet d'appliquer text-align sur une span */
      transform: none; /* Supprime translateX(-100%) qui décale le texte */
}

    /* Style pour le tableau */
    table {
      width: 100%; /* Tableau prend toute la largeur disponible */
      border-collapse: collapse; /* Supprime les espaces entre les bordures */
       /* Espacement vertical autour du tableau */
       transform: translateY(-15%);
      margin: 0;
      
    }

    /* Style pour les cellules */
    td, th {
      border: 1px solid black; /* Bordure autour des cellules */
      padding: 1px; /* Espacement interne dans chaque cellule */
      text-align: left; /* Alignement centré du texte */
      font-size: 16px; 
      width: 60;
      padding-bottom: 5px;
    }
    

    /* Style pour l'en-tête du tableau */
    th {
      background-color: #f4f4f4; /* Fond gris clair pour l'en-tête */
      font-weight: bold; /* Texte en gras */
      font-size: 16px; 
      text-align: left;
    }

    /* Style pour les lignes */
    tr:nth-child(even) {
      background-color: #f9f9f9; /* Couleur de fond pour les lignes paires */
    }

    tr:nth-child(odd) {
      background-color: #ffffff; /* Couleur de fond pour les lignes impaires */
    }

    /* Ajout d'un survol (hover) sur les lignes */
    tr:hover {
      background-color: #d3e4f0; /* Couleur de fond au survol */
    }

    .tab_duree{                     
      width: 30%;
      transform: translateY(-13%);
      
      padding: 0;
      
    }

    .temps{
      margin-left: 10px;
    }
    .ccc{
      width: 20%;
      transform: translateX(-3%);
    }


    .image{
        width: 353px;
        height: 160px;
        padding: 0;
       
    }   

        /* Style spécifique pour le tableau Facture */
    .table-facture {
       width: 80%;
       
        transform: translateY(-10%);
       
         /* Centré horizontalement avec espacement au-dessus */
        border-collapse: collapse; /* Supprime les espaces entre les bordures */
    }

    .table-facture th, .table-facture td {
    border: 1px solid black; /* Bordures des cellules */
    text-align: left; /* Texte centré */
    font-size: 13px; /* Taille du texte */
    }

    .table-facture th {
    background-color: #e8e8e8; /* Fond gris clair pour l'en-tête */
    font-weight: bold; /* Texte en gras */
    }

    .table-facture tr:nth-child(even) {
    background-color: #f9f9f9; /* Fond pour les lignes paires */
    }

    .table-facture tr:nth-child(odd) {
    background-color: #ffffff; /* Fond pour les lignes impaires */
    }

    .table-facture tr:hover {
    background-color: #d3e4f0; /* Fond au survol */
    }
    .loc{
    font-size: 11px;
    font-weight: bold;
   
    }
    .rue{
    font-size: 11px;
    padding: 0;
    bottom: 0;
    transform: translateY(10%);
    }
.city{
  font-size: 11px;
  bottom: 0;
  padding: 0;
  transform: translateY(-80%);
}
.tel{
  font-size: 11px;
  bottom: 0;
  padding: 0;
  transform: translateY(-100%);
}
.email{
  font-size: 11px;
  bottom: 0;
  padding: 0;
  transform: translateY(-100%);
}
.fcb{
  font-size: 11px;
  bottom: 0;
  padding: 0;
  transform: translateY(-100%);
}

.rouge {
    border: 1px solid rgb(198, 25, 25); /* Appliquer une bordure rouge */
    padding:0;
    margin: 10px 0; /* Optionnel : ajuster les marges autour du trait */
    width: 100%;
}

.img-logo {
    width: 250px;
   padding-top: 10px;
    height: auto;  /* Keeps the aspect ratio */
}
.add{
    text-align: center;
    font-size: 12px;
    transform: translateY(-80%);
    font-weight: bold; 
}

.fcb i {
    margin-right: 8px; /* Space between icon and text */
    font-size: 12px; /* Adjust icon size */
    color: #e42f3b; /* Facebook blue color */
}

.email i {
    margin-right: 8px; /* Space between the icon and text */
    vertical-align: middle; /* Aligns the icon with the text */
    font-size: 12px; /* Adjusts the size of the icon */
    color: #e42f3b;
    width: 10%;
}

.tel i {
    margin-right: 8px; /* Space between the icon and the number */
    vertical-align: middle; /* Aligns the icons with the text */
    font-size: 12px; /* Adjust the size of the icons */
    color: #e42f3b;
}
.important{
    position: relative;              /* Position absolue pour la partie droite */
    top: 7px;                       /* Aligner avec le haut du header */
    left: 250px;                       /* Positionner à droite de la partie centrale */
    transform: translateX(-60%);     /* Centrer horizontalement par rapport à son propre bloc */
    padding-bottom: 100px;
    width: 100%;
}

.cadre-important{
   /* Taille du texte réduite */
     /* Ajuste l’espacement entre les lignes */
    width: 75%; /* S'assure que le div prend toute la largeur */
    height:20%;
    border: 1px solid black; /* Bordure noire */
    /* Ajoute un peu d'espace intérieur */
    box-sizing: border-box; /* Inclut le padding dans la largeur */
    text-align: justify; /* Justifie le texte pour qu'il occupe toute la largeur */
    word-spacing: -1px; /* Réduit légèrement l'espace entre les mots */
    hyphens: auto; /* Active la césure automatique pour éviter les gros espaces */
    margin-bottom: 5px;
    padding-right: 10px;
    }
    .rmq{
  font-size: 11px;
  padding-left: 10px;
  width: 100%;
  margin-bottom: 30px;
}



.titre{
    font-size: 15px; /* Adjust the size of the icons */
    font-weight: bold;
    margin-bottom: -7px; /* Réduire l'espacement entre ce titre et le suivant */
    margin-top: 0px; /* Réduire l'espacement entre ce titre et le suivant */
    color: #e42f3b;
    
}
@font-face {
        font-family: 'Scheherazade';
        src: url('{{ public_path('fonts/Scheherazade-Regular.ttf') }}');
    }

  /* Styles pour les textes en arabe */
[lang="ar"] {
    font-family: 'DejaVu Sans', sans-serif; /* Police spécifique pour l'arabe */
    text-align: center; /* Aligner le texte à droite */
    line-height: 0.7; /* Espacement entre les lignes */
    margin: 8px 0; /* Espacement autour des blocs de texte */
}
[lang="arb"] {
    font-family: 'DejaVu Sans', sans-serif; /* Police spécifique pour l'arabe */
    text-align: right; /* Aligner le texte à droite */
    line-height: 0; /* Espacement entre les lignes */
    margin: 0px 0; /* Espacement autour des blocs de texte */
    top: -20px; /* Ajustez la valeur pour lever l'écriture */

}

    .icon {
  width: 25px; /* Réduire la taille de l'image */
  height: 25px; /* Réduire la taille de l'image */
  margin-right: 5px; /* Espacement entre l'image et le texte */
}
   

  </style>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

  <header>
    <div class="partie-gauche"><p class="titre">Sigma Prime</p>
      <p class="loc">Location des Voitures</p>
      <hr class="rouge">
      <p class="rue">Rue d'Espoir-Cité El Maahad</p>
      <p class="city">Béni Khiar 8060</p>
      <p class="tel">
        <i class="fas fa-phone"></i> 72230105 
        <i class="fas fa-mobile-alt"></i> 98660031
    </p>
    
      <p class="email">
        <i class="fas fa-envelope"></i> sigmarentcar@gmail.com
    </p>
    
      <p class="fcb">
        <i class="fab fa-facebook"></i> Sigma Rent a Car Nabeul
    </p>
    
    </div>
    <div class="partie-centrale">
        <img src="C:\xampp\htdocs\SigmaPrime-master\storage\app\images\logos\LOGOtext.png"  class="img-logo">
        <p class="add">M.F: 1783181/G/A/M/000</p>
    </div>
    <div class="partie-droite" ><p class="titre" lang="ar">Sigma Prime</p>
      <p class="loc" lang="ar">Location des Voitures</p>
      <hr class="rouge">
      <p class="rue" lang="ar">Rue d'Espoir-Cité El Maahad</p>
      <p class="city" lang="ar">Béni Khiar 8060</p>
      <p class="tel">
        <i class="fas fa-phone"></i> 72230105 
        <i class="fas fa-mobile-alt"></i> 98660031
    </p>
    
      <p class="email">
        <i class="fas fa-envelope"></i> sigmarentcar@gmail.com
    </p>
    
      <p class="fcb">
        <i class="fab fa-facebook"></i> Sigma Rent a Car Nabeul
    </p>
    
    </div>
  </header>

  <div class="firstcadre">
    <p>&nbsp;&nbsp;&nbsp;Contrat de location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span lang="arb"></span> </p>
     
  </div>

  <div> 
    <p class="police">Identité de location </p>

    <!-- Le cadre à gauche avec des lignes -->
<div class="cadre-gauche">
    <div class="ligne">Nom et Prénom : <span class="data">{{ $reservation->first_name }} {{ $reservation->last_name }}</span></div>
    <hr class="pre">

    <div class="ligne">Date et Lieu de Naissance : <span class="data">{{ $reservation->date_of_birth }}&nbsp;&nbsp;&nbsp;</span> à  <span class="data"> {{ $reservation->place_of_birth }}</span></div>
    <hr class="pre">

    <div class="ligne">Nationalité : <span class="data">{{ $reservation->nationality }}</span></div>
    <hr class="pre">

    <div class="ligne">Pièce d'Identité N° : <span class="data">{{ $reservation->identity_number }} &nbsp;&nbsp;&nbsp;&nbsp;</span> Du: <span class="data"> &nbsp;{{ $reservation->identity_date }}</span></div>
    <hr class="pre">

    <div class="ligne">Permis N° : <span class="data">{{ $reservation->driver_license_number }} &nbsp;&nbsp;&nbsp;&nbsp;</span> Du: <span class="data"> &nbsp; {{ $reservation->license_date }}</span></div>
    <hr class="pre">

    <div class="ligne">Adresse : <span class="data">{{ $reservation->address }}</span></div>
    <hr class="pre">

    <div class="ligne">Mobile : <span class="data">{{ $reservation->mobile_number }}</span></div>
</div>

</div>


  <div class="width"> <p class="police">Conducteur supplémentaire :</p> 
  <!-- Le cadre à gauche avec des lignes -->
  <div class="cadre-gauche">
    <div class="ligne"> Nom et Prènom : </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne">Date et Lieu de Naissance : </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne">Nationalité : </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne">Pièce d\'Identité N°</div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne">Permis N° </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne">Adresse </div>
  </div>  
  </div>


  <div> <p class="police">Etat de la voiture  :</p>  
  <!-- Le cadre à gauche avec des lignes -->
  <div class="cadre-img">
    <img src="C:\xampp\htdocs\SigmaPrime-master\storage\app\images\cn.jpg" class="image">

  </div>  
  </div>

  <!-- Le cadre à gauche avec des lignes -->
  <div class="cadre-voiture">
    <div class="ligne_bas"> (=) Eraflure </div>
    <hr class="demi"> <!-- Ligne horizontale -->
    <div class="vertical-line"></div>
    <div class="ligne_bas">(*) Bosse </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne_bas">Km Départ </div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne_bas">Km Retour</div>
    <hr> <!-- Ligne horizontale -->
<div class="Carburant">
  Carburant &nbsp;&nbsp;&nbsp; Départ  
  <img src="C:\xampp\htdocs\SigmaPrime-master\storage\app\images\Carburant.png" class="icon"> 
  Retour 
  <img src="C:\xampp\htdocs\SigmaPrime-master\storage\app\images\Carburant.png" class="icon">  
</div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne_bas">Retour de secours</div>
    <hr> <!-- Ligne horizontale -->
    <div class="ligne_bas">Auto-radio </div>
  </div>  
  

  <div class="droit"> <p class="police">Véhicule  :</p>
    <!-- Le cadre à gauche avec des lignes -->
    <div class="cadre-matricule">
      <div class="mat"> Matricule: <span class="data">{{ $car->matricule }} </div>
      <hr class="vh"> <!-- Ligne horizontale -->
      <div class="type">Marque et Type <span class="data">{{ $car->brand }}{{ $car->model }}</div>
    </div>  

<div class="important"> 
    <div class="cadre-important">
        <div class="imp"> Important : L'assurance couvre pas les dégats occasionnées    aux pneumatique Pris le glace, optique avant et arrière, remorquage et     vol qui sont exclusivement à la charge de locataire.</div>
        
        <hr class="ch"> <!-- Ligne horizontale -->
        <div class="rmq">Remarque : Le kilométrage est limité à 400 Km/jour tout excés est facture à base de 200 millime / km et le retard sera taxé à 20 dt/H</div>
      </div> 
</div>


    
<div class="tab_duree">
<div ><p class="police_location">Durée de la location :</p>  
    <!-- Le cadre à gauche avec des lignes -->
    <div>
      <table class="temps">
        <tr class="ccc">
          <th style="font-size: 12px;">NBJ</th>
          <th style="font-size: 12px; ">Date</th>
          <th style="font-size: 12px;">Heure</th>
          <th style="font-size: 12px;">Lieu</th>
        </tr>
        <tr class="ccc">
          <td style="font-size: 12px;">Livraison</td>
          <td class="vide"><span class="data">{{ $reservation->start_date }}</td>
          <td class="vide"><span class="data">{{ $reservation->delivery_time }}</td>
          <td class="vide"></td>
        </tr>
        <tr class="ccc">
          <td style="font-size: 12px; ">Retour</td>
          <td class="vide"><span class="data">{{ $reservation->end_date }}</td>
          <td class="vide"><span class="data">{{ $reservation->return_time }}</td>
          <td class="vide"></td>
        </tr>
        <tr class="ccc">
          <td style="font-size: 12px; ">Prolongation</td>
          <td class="vide"></td>
          <td class="vide"></td>
          <td class="vide"></td>
        </tr>
      </table>
    </div>  
    </div>
</div>


  <div class="cautionnement"><p class="police_cautionnement">Cautionnement :</p> 
    <p class="NB">NB: Avance pour tout dégat subit au véhicule suite d'un accident ou mal utilisation</p>
  </div>


<div class="tab_prix">
    <div ><p class="police_facture">Facture :</p>  
        <!-- Le cadre à gauche avec des lignes -->
        <div>
          <table class="table-facture">
            <tr >
              <td class="duree" style="font-size: 12px; ">Durée de location</td>
              <td class="champ"><span class="data">{{ $reservation->days}}</td>
              <td class="champ"></td>
            </tr>
            <tr>
                <td style="font-size: 12px; ">Prix par jour</td>
                <td class="champ"><span class="data">{{ $reservation->price_per_day}}</td>
                <td class="champ"></td>
              </tr>
              <tr>
                <td style="font-size: 12px; ">Autre charge</td>
                <td class="champ"></td>
                <td class="champ"></td>
              </tr>
              <tr>
                <td style="font-size: 12px; ">Total HT</td>
                <td class="champ"><span class="data">{{ $reservation->total_price}}</td>
                <td class="champ"></td>
              </tr>
              <tr>
                <td style="font-size: 12px; ">TVA 19%</td>
                <td class="champ"></td>
                <td class="champ"></td>
              </tr>
              <tr>
                <td style="font-size: 12px; ">Doit de Timbre</td>
                <td class="champ"></td>
                <td class="champ"></td>
              </tr>
              <tr>
                <td style="font-size: 12px; ">Total Facture</td>
                <td class="champ"></td>
                <td class="champ"></td>
              </tr>
          </table>
        </div>  
        </div>
    </div>

    <div class="paiement"><p class="police_paiement">Modalité de paiement :</p> 
    <div class="cadre_second">
      <label>Chèque</label>
      <input type="checkbox" class="checkbox">
      <label>&nbsp;&nbsp;Carte Crédit</label>
      <input type="checkbox" class="checkbox">
      <label>&nbsp;&nbsp;Espèce</label>
      <input type="checkbox" class="checkbox">
      <hr class="l_2"/>  
      <p class="N">N°</p>
    </div>
    </div>

  <div><p class="police_info">Informations Importantes</p>
  <div class="cadre_info"> 1-en cas d'accident le locataire doit payer une franchise égale 4% de la valeur de la voiture s'il appliqué toutes les conditions du contrat 
 et dans le cas conntraire, il doit payer toutes les frais.
 2-l'assurence tout risque n'inclue pas les dommages causés aux phares, rétroviseurs, pare -chocs avant et arrière, peinture de voiture et toutes perte d'équipements comme : papier, clefs et radios
 cassettes qui sont à la charge du locataire 3, le client paye l'usure mécanique provenant d'une
 négligence de la part du locataire ou du 2 ème conducteur. le remorquage de la voiture en cas
 d'accident ou d'une panne est à la charge du locataire. 4- Le client doit présenter ce document en cas
 de besoin.</div>

  </div>
  

<footer>
   <div class="footer-left">
     <span class="boldA"> Nom et signature de l'agent</span>
    </div>
    <div class="footer-right">
      J\'ai lu les informations et les conditions recto verso et je les accepte&nbsp;
      <span class="bold">&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;Signature du client</span>
    </div>
  </footer>

  

</body>
<div class="image-container">
    <img src="C:\xampp\htdocs\SigmaPrime-master\storage\app\images\contrat_2 - Copien.png" alt="contrat_2">
</div>
<style>
 .image-container {
    text-align: center;  /* Centre l'image horizontalement */
    margin: 0px auto;    /* Ajoute un espacement autour de l'image */
    width: 140%;         /* Définit la largeur à 100% de son conteneur */
    max-width: 600px;    /* Définir une largeur maximale pour l'image */
    margin-top: -80px;   /* Déplace l'image vers le haut */
}

.image-container img {
    width: 140%;         /* L'image prendra toute la largeur de son conteneur */
    height: auto;        /* Garde les proportions de l'image */
    display: block;      /* Permet de supprimer les marges supplémentaires sous l'image */
    margin: 0 auto;      /* Centre l'image */
}


</style>
</html>

