<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RadarController;

use App\Http\Controllers\clientCarController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\addNewAdminController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminAuth\LoginAdminController;
use App\Models\User;
use App\Models\Car;
use App\Models\Reservation;
use App\Http\Controllers\NonameController;
use App\Http\Controllers\ClientController;

use Illuminate\Support\Facades\DB;




// ------------------- guest routes --------------------------------------- //
Route::get('/', function () {
    $cars = Car::take(6)->where('status', '=', 'available')->get();
    return view('home', compact('cars'));
})->name('home');

Route::get('/cars', [clientCarController::class, 'index'])->name('cars');
//Route::get('/cars/search', [carSearchController::class, 'search'])->name('carSearch');

Route::get('location', function () {
    return view('location');
})->name('location');



Route::get('contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::get('admin/login', [LoginAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginAdminController::class, 'login'])->name('admin.login.submit');

Route::redirect('/admin', 'admin/login');

Route::get('/privacy_policy',
function () {
    return view('Privacy_Policy');
})->name('privacy_policy');

Route::get('/terms_conditions',
function () {
    return view('Terms_Conditions');
})->name('terms_conditions');


// -------------------------------------------------------------------------//




// ------------------- admin routes --------------------------------------- //

Route::prefix('admin')->middleware('admin')->group(function () {


    Route::get(
        '/dashboard',
        adminDashboardController::class
    )->name('adminDashboard');

    Route::get('/formulaire/{id}', [adminDashboardController::class, 'afficherFormulaire'])->name('admin.formulaire');


    Route::resource('cars', CarController::class);
    Route::get(
        '/client-details/{id}',
        [ReservationController::class, 'showClientDetails']
    )->name('admin.client.details');
    // Route::resource('reservations', ReservationController::class);
    Route::get('/users', function () {

        $admins = User::where('role', 'admin')->get();
        $clients = User::where('role', 'client')->paginate(5);

        return view('admin.users', compact('admins', 'clients'));
    })->name('users');

    Route::get('/updatePayment/{reservation}', [ReservationController::class, 'editPayment'])->name('editPayment');
    Route::put('/updatePayment/{reservation}', [ReservationController::class, 'updatePayment'])->name('updatePayment');

    Route::get('/updateReservation/{reservation}', [ReservationController::class, 'editStatus'])->name('editStatus');
    Route::put('/updateReservation/{reservation}', [ReservationController::class, 'updateStatus'])->name('updateStatus');

    Route::get('/addAdmin', [usersController::class, 'create'])->name('addAdmin');
    Route::post('/addAdmin', [addNewAdminController::class, 'register'])->name('addNewAdmin');
    // Route::delete('/deleteUser/{user}', [usersController::class, 'destroy'])->name('deleteUser');

    Route::get('/userDetails/{user}', [usersController::class, 'show'])->name('userDetails');
    Route::post('/admin/search', [CarController::class, 'search'])->name('car.search');
});
Route::get('/reservation/{id}/generate-pdf', [ReservationController::class, 'generatePDF'])->name('reservation.generatePDF');
Route::put('/reservation/{reservation}/update-payment', [PaymentController::class, 'updatePayment'])->name('reservation.updatePayment');

Route::get('/api/reserved-dates', [ReservationController::class, 'getReservedDates']);


// --------------------------------------------------------------------------//



// ------------------- client routes --------------------------------------- //
Route::get('/users/cin/{cin}', [ClientController::class, 'showClientByCIN'])->name('users.byCIN');


Route::get('/users', [ClientController::class, 'indexclient'])->name('users');

Route::get('/clients', [ClientController::class, 'indexclient'])->name('users');
Route::delete('/client/{id}', [ClientController::class, 'deleteUser'])->name('deleteUser');


Route::post('/login/{car_id?}', [LoginController::class, 'login'])->name('login');
Route::post('/login/{car_id}', [LoginController::class, 'login'])->name('login');
Route::get('/cin/{car_id}', [LoginController::class, 'enterCin'])->name('cin');
Route::post('/cin/{car_id}', [LoginController::class, 'enterCin'])->name('cin');
Route::post('/cin/login/{car_id}', [LoginController::class, 'login'])->name('cin.login');


Route::put('reservation/update/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
Route::prefix('reservations')->group(function() {
    route::get('invoice/{reservation}', [invoiceController::class, 'invoice'])->name('invoice');

    // Afficher le formulaire pour créer une nouvelle réservation pour une voiture spécifique
    Route::get('/create/{car_id}', [ReservationController::class, 'create'])->name('reservations.create');
    
    //Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/reservations', [ReservationController::class, 'index'])
        ->name('clientReservation');
        

    // Editer la méthode de paiement d'une réservation
    Route::get('/payment/edit/{reservation}', [ReservationController::class, 'editPayment'])->name('reservations.editPayment');
    Route::post('/payment/update/{reservation}', [ReservationController::class, 'updatePayment'])->name('reservations.updatePayment');
    
    // Editer le statut d'une réservation
    Route::get('/status/edit/{reservation}', [ReservationController::class, 'editStatus'])->name('reservations.editStatus');
    Route::post('/status/update/{reservation}', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
    
    // Afficher une réservation spécifique
    Route::get('/show/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    
    // Modifier une réservation (fonction non implémentée dans le contrôleur mais peut être utilisée)
    Route::get('/edit/{reservation}', [ReservationController::class, 'edit'])->name('reservations.edit');
   // Route::post('/update/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    
    // Supprimer une réservation (fonction non implémentée dans le contrôleur)
    Route::delete('/destroy/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('car/reservation/{car}', [CarController::class, 'show'])->name('car.reservation');
    // Enregistrer une nouvelle réservation pour une voiture spécifique
    Route::post('/reservation/{car_id}', [ReservationController::class, 'store'])->name('reservation.store');
    
    

});

Route::get('/cars/{car_id}/reserved-dates', [ReservationController::class, 'getReservedDates'])
    ->name('cars.reservedDates');


    Route::get('/api/check-availability', [ReservationController::class, 'checkAvailability']);


Route::get('/car-search', [CarController::class, 'filterCars'])->name('carSearch');
// Unique route for available cars listing with date filtering
Route::get('/cars/available', [CarController::class, 'availableCars'])->name('cars.available');


    Route::get('/search-cars', [CarController::class, 'searchCars']);
    Route::get('/car/{id}/reserve', [CarController::class, 'reserve'])->name('car.reserve');

    Route::get('/clients/search', [ClientController::class, 'searchClients'])->name('clients.search');

   Route::get('/cars/filter', [CarController::class, 'filterByMatricule'])->name('cars.filter');
//---------------------------------------------------------------------------//
Auth::routes();
Route::get('/check-driver', [DriverController::class, 'check']);
Route::get('/check-in', function () {
    $cin = request('cin');
    $driver = DB::table('conducteurs')->where('cin', $cin)->first();

    return response()->json($driver);
});
Route::get('/formulaire', [ReservationController::class, 'showForm'])->name('formulaire');
Route::post('/formulaire', [ReservationController::class, 'handleCIN'])->name('formulaire.post');
Route::get('/check-cin/{cin}', [ReservationController::class, 'checkCin'])->name('checkCin');
Route::post('/reservation/toggle-status/{id}', [\App\Http\Controllers\ReservationController::class, 'toggleStatus']);

Route::get('/admin/client-details', function () {
    return view('admin.clientDetails');
})->name('admin.client.details');


Route::put('/admin/formulaire/{id}', [ReservationController::class, 'update'])->name('admin.formulaire');


// web.php
Route::get('/admin/contrat/{id}', [AdminDashboardController::class, 'showContrat'])->name('reservation.showContrat');
  

// Route pour traiter la mise à jour (PUT/PATCH)
// Route pour afficher le formulaire d'édition (GET)
Route::get('clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');

// Route pour traiter la mise à jour (PUT/PATCH)
Route::put('clients/{client}', [ClientController::class, 'update'])->name('clients.update');
// routes/web.php
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

Route::post('/reservations/{reservation}/update-price', 
    [ReservationController::class, 'updatePrice'])
    ->name('reservations.update-price')
    ->middleware('auth');

    Route::put('/admin/formulaire/{id}', [AdminDashboardController::class, 'update'])->name('admin.formulaire.update');
    Route::put('/admin/reservation/{id}', [ReservationController::class, 'update'])->name('admin.update');
    // routes/api.php


Route::get('/reservations/{carId}/active', [ReservationController::class, 'getActiveReservations']);
Route::get('/admin/active-departures', [AdminDashboardController::class, 'activeDepartures'])
    ->name('admin.active_departures');
    Route::get('/admin/reservations-depart', function (Request $request) {
        $date = $request->query('date'); // format : YYYY-MM-DD
    
        return Reservation::whereDate('start_date', $date)->with('voiture')->get();
    });
    Route::get('/cars/{car}', [CarController::class, 'displayCarDetails'])->name('cars.details');
    Route::post('/assurances', [AssuranceController::class, 'store'])->name('assurances.store');

    Route::post('/entretiens', [EntretienController::class, 'store'])->name('entretiens.store');

    Route::post('/visites-techniques', [VisiteTechniqueController::class, 'store'])->name('visites-techniques.store');
Route::get('assurances/create/{car}', [AssuranceController::class, 'create'])->name('assurances.create');
Route::get('entretiens/create/{car}', [EntretiensController::class, 'create'])->name('entretiens.create');
Route::get('visites-techniques/create/{car}', [VisitesTechniquesController::class, 'create'])->name('visites-techniques.create');
// Routes pour les entretiens
Route::resource('entretiens', EntretienController::class)->except(['index', 'show']);

// Routes pour les visites techniques
Route::resource('visites-techniques', VisiteTechniqueController::class)->except(['index', 'show']);


Route::resource('assurances', AssuranceController::class); // Pluriel correct
Route::delete('/reservation/{id}', [\App\Http\Controllers\ReservationController::class, 'destroy']);
Route::get('/voiture/{id}', [CarController::class, 'viewCar'])->name('admin.voiture');
Route::get('/reservations/actives', [ReservationController::class, 'actives'])->name('reservations.actives');
Route::put('/cars/{id}/edit', [CarController::class, 'editCar'])->name('cars.editCar');
Route::post('/reservation/prolong/{id}', [ReservationController::class, 'prolong']);
Route::post('/clients/{id}/toggle-block', [ClientController::class, 'toggleBlock'])->name('clients.toggle-block');
Route::get('/verify-code', [ReservationController::class, 'verifyCode'])->name('verify.code');
Route::post('/reservation/verifier', [ReservationController::class, 'verifierCode'])->name('reservation.verifier');
Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservation.show');
Route::get('/admin/reservations/impayees', [adminDashboardController::class, 'reservationsImpayees'])->name('admin.reservationsImpayees');


Route::get('/cars/{id}/radar', [CarController::class, 'Radar'])->name('cars.radar');
Route::get('/radars', [RadarController::class, 'show'])->name('admin.radar');
Route::post('/cars/radars', [RadarController::class, 'store'])->name('cars.radars.store');
Route::get('/radars/create', [App\Http\Controllers\RadarController::class, 'create'])->name('radars.create');
Route::get('/radars', [RadarController::class, 'index'])->name('cars.radar');
Route::put('/radars/{id}', [RadarController::class, 'update'])->name('radars.update');
Route::get('/total-clients-admins', [UserController::class, 'totalClientsAdmins']);
Route::get('/radars/cars-by-date', [RadarController::class, 'getCarsByDate'])->name('radars.cars-by-date');
Route::get('/noname', [NonameController::class, 'show']);

Route::get('/voitures/dispo', function () {
    return view('admin.cardi');
})->name('voitures.dispo');


Route::get('/admin/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/details/{id}', [ClientController::class, 'detailsClients'])->name('clients.details');

Route::get('/admin/calendrier/{car}', [CarController::class, 'showCalendar'])->name('admin.calendrier');

Route::get('/thankyou/{reservation}', [ReservationController::class, 'thankyou'])->name('thankyou');

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/car-list', function () {
    $cars = Car::paginate(12);
    return view('car-list', compact('cars'));
});
