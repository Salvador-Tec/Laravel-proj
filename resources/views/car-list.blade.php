@extends('layouts.myapp')
@section('content')
<div class="widget-banner-car-listing banner-car-listing-list">
                <div class="themesflat-container full">
                    <div class="banner-car-listing">
                       <div>seknfosnfosnf</div>
                        <h1 class="title text-white">Sigma <span class="text-red">Rent </span> Car Nabeul </h1>
                    </div>
                </div>
            </div>
            
            <!-- car-listing-list -->
            <div class="widget-car-listing-list">
                <div class="themesflat-container">
                    <div class="row car-listing-list">
                        <div class="col-md-12 col-lg-3">
                            <div class="search-filter-listing-car">
                                <div class="filter-header-list">
                                    <h6 class="title-filter">Chercher</h6>
                                    <div class="btn-filter">
                                        <i class="icon-Grid-view"></i>
                                    </div>
                                </div>
                                <form id="filter-list-car-side-bar" class="list-filter" action="{{ route('carSearch') }}" method="GET">
                                   
                                   
                                    <!-- Lieu de départ -->
                        <div class="form-group">
                            <div class="group-select">
                                @php
                                    $villes = ['Tunis','Nabeul','Ariana','Béja','Ben Arous','Bizerte','Gabès','Gafsa','Jendouba','Kairouan','Kasserine','Kébili','Le Kef','Mahdia','La Manouba','Monastir','Sfax','Sidi Bouzid','Siliana','Sousse','Tataouine','Tozeur','Zaghouan'];
                                @endphp
                                <select name="pickup_location" class="form-control">
                                    <option value="">-- lieu de depart --</option>
                                    @foreach($villes as $v)
                                        <option value="{{ $v }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Lieu de retour -->
                        <div class="form-group">
                            <div class="group-select">
                                <select name="return_location" class="form-control">
                                    <option value="">-- lieu de retour --</option>
                                    @foreach($villes as $v)
                                        <option value="{{ $v }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                    <div class="form-group">
                            <div class="group-select">
                                <div id="datepicker-depart" class="input-group date">
                                    <input class="form-control date-input" type="text" name="start_date" placeholder="Date de départ" value="{{ request('start_date') }}" readonly>
                                    <span class="input-group-addon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                </div>
                                <input class="form-control time-input" type="time" name="delivery_time" placeholder="Heure de départ">
                            </div>
                        </div>

                        <!-- Date de retour -->
                        <div class="form-group">
                            <div class="group-select">
                                <div id="datepicker-retour" class="input-group date">
                                    <input class="form-control date-input" type="text" name="end_date" placeholder="Date de retour" value="{{ request('end_date') }}" readonly>
                                    <span class="input-group-addon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    
                                </div>
                                <input class="form-control time-input" type="time" name="return_time" placeholder="Heure de retour">
                            </div>
                        </div>
                        <div class="form-group">
                                            <button type="submit" class="button-search-listing">
                                                <i class="icon-search-1"></i>
                                                Chercher
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-9 listing-list-car-wrap">
                            <form action="https://themesflat.co/" class="tf-my-listing-search">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="showing">Affichage {{ $cars->firstItem() ?? 0 }}-{{ $cars->lastItem() ?? 0 }} sur <span class="text-red">{{ $cars->total() }}</span> résultats</p>
                                    </div>
                                   
                                </div>
                                <div class="tab-listing-all">
                                    <div class="condition-tab-wrap tf-search-condition-tab">
                                        <div class="nav" id="nav-tab" role="tablist">
                                            <a class=" btn-condition-filter active" id="all-tab" data-bs-toggle="tab"
                                                data-bs-target="#all" role="tab" aria-controls="all"
                                                aria-selected="true">
                                                Toute <span class="number-list">({{ $cars->total() }})</span>
                                            </a>
                                            <a class=" btn-condition-filter" id="new-tab" data-bs-toggle="tab"
                                                data-bs-target="#new" role="tab" aria-controls="new"
                                                aria-selected="false">
                                                Nouvelle <span class="number-list">({{ $cars->count() }})</span>
                                            </a>
                                         
                                        </div>
                                    </div>
                                    <div class="toolbar-list">
                                        <div class="form-group">
                                            <a class="btn-display-listing-grid active">
                                                <i class="icon-th-list"></i>
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn-display-listing-list">
                                                <i class="icon-line-height"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            {{-- Cars grid/list --}}
                            <div class="row">
                                @foreach($cars as $car)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                                <img src="{{ $car->image ? asset('storage/'.$car->image) : asset('public/storage/images/default-car.png') }}" alt="{{ $car->brand }} {{ $car->model }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                           
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                                                <p class="card-text mb-1">Moteur: {{ $car->engine }}</p>
                                                <p class="card-text mb-1">Boîte: {{ $car->gearbox_type }}</p>
                                                                                                <p class="card-text text-red fw-bold">{{ number_format($car->price_per_day, 0) }} DT / jour</p>
                                                <form action="{{ route('cin', ['car_id' => $car->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 1rem 0;"
                                                        class="rounded-md bg-danger text-sm font-medium text-white">
                                                        <i class="fa-solid fa-calendar-check mr-1" style="margin-right: 0.5rem;"></i>
                                                        Réserver
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <style>
  /* Ta mise en forme existante */
  .pagination { 
    margin-top: 100px;  
    justify-content: center !important;
    display: flex !important;
    /* === Couleurs Bootstrap 5 pour la pagination === */
    --bs-pagination-color: #dc3545;                 /* texte "rouge" */
    --bs-pagination-hover-color: #dc3545;           
    --bs-pagination-focus-color: #dc3545;

    --bs-pagination-border-color: #dc3545;          /* bordures rouges */
    --bs-pagination-hover-border-color: #dc3545;

    --bs-pagination-bg: #fff;                       /* fond normal blanc */
    --bs-pagination-hover-bg: #fff5f5;              /* fond survol rosé */

    --bs-pagination-active-bg: #dc3545;             /* page active rouge */
    --bs-pagination-active-border-color: #dc3545;
    --bs-pagination-active-color: #fff;             /* texte blanc */

    --bs-pagination-disabled-color: #f1aeb5;        /* état disabled rosé */
    --bs-pagination-disabled-bg: #fff;
    --bs-pagination-disabled-border-color: #f1aeb5;
  }

  nav[role="navigation"] { display:flex; justify-content:center; width:100%; }

  .pagination .page-item { margin: 0 3px; }
  .pagination .page-link {
    padding: .25rem .5rem;
    font-size: .80rem;
    line-height: 1.1;
    border-radius: .35rem;
  }

  /* Fallback si variables non prises en compte */
  .pagination .page-link { color:#dc3545; border-color:#dc3545; }
  .pagination .page-link:hover { color:#dc3545; }
  .pagination .page-item.active .page-link { background:#dc3545; border-color:#dc3545; color:#fff; }
  .pagination .page-item.disabled .page-link { color:#f1aeb5; border-color:#f1aeb5; }
</style>


                            <div class="d-flex justify-content-center mt-3">
                                {{ $cars->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>


                            </div>
                            </div>
                            </div>
                            </div>
@endsection