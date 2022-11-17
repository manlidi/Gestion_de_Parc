<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionUserController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\ReparerController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VisiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.index');
});
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('admin_demandes', [DemandeController::class, 'indexAdmin'])->name('admin_demandes');
Route::get('adminDemandeApprouve', [DemandeController::class, 'indexAdminApprouve'])->name('adminDemandeApprouve');

Route::get('addReparationDetail/{id}', [DemandeController::class, 'addReparationDetail'])->name('addReparationDetail');
Route::get('demandeApprouve', [DemandeController::class, 'indexApprouve']);
Route::get('demanderVoiture', [DemandeController::class, 'createVoiture'])->name('demanderVoiture');
Route::get('demanderChauffeur', [DemandeController::class, 'createChauffeur'])->name('demanderChauffeur');
Route::get('rendreDemande/{id}/{type}', [DemandeController::class, 'rendreDemande'])->name('rendreDemande');
Route::get('desapprouverDemande/{id}/{type}', [DemandeController::class, 'desapprouverDemande'])->name('desapprouverDemande');
Route::get('rejeterDemande/{id}/{type}', [DemandeController::class, 'rejeterDemande'])->name('rejeterDemande');
Route::get('demanderReparation', [DemandeController::class, 'createReparation'])->name('demanderReparation');
Route::get('validerDemande/{id}/{type}', [DemandeController::class, 'validerDemande'])->name('validerDemande')->whereNumber('id');
Route::post('saveDemande/{type}', [DemandeController::class, 'store'])->name('saveDemande');
Route::post('saveDemandeReparation/{id}', [DemandeController::class, 'saveDemandeReparation'])->name('saveDemandeReparation');
Route::get('updateDemandeVoiture/{id}', [DemandeController::class, 'updateDemandeVoiture'])->name('updateDemandeVoiture');
Route::get('updateDemandeChauffeur/{id}', [DemandeController::class, 'updateDemandeChauffeur'])->name('updateDemandeChauffeur');
Route::post('updateDemande/{id}/{type}', [DemandeController::class, 'update'])->name('updateDemande');


Route::middleware(['auth', 'role:Administrateur'])->group(function () {
    Route::get('structures', [StructureController::class, 'index'])->name('structures');
    Route::get('addstructures', [StructureController::class, 'show']);
    Route::post('savestructures', [StructureController::class, 'create']);
    Route::get('editstructures/{id}', [StructureController::class, 'edit']);
    Route::put('upstructures/{id}', [StructureController::class, 'update']);
    Route::get('delstructures/{id}', [StructureController::class, 'destroy']);

    Route::get('assurance', [AssuranceController::class, 'index'])->name('assurance');
    Route::get('addassurance/{id}', [AssuranceController::class, 'create']);
    Route::post('postA', [AssuranceController::class, 'save']);
    Route::get('editass/{id}', [AssuranceController::class, 'edit']);
    Route::put('updateass/{id}', [AssuranceController::class, 'update']);
    Route::get('deleteass/{id}', [AssuranceController::class, 'destroy']);

    Route::get('voitures', [VoitureController::class, 'index'])->name('voitures');
    Route::get('addvoitures', [VoitureController::class, 'create']);
    Route::post('savevoitures', [VoitureController::class, 'store']);
    Route::get('get/piece/{id}', [VoitureController::class, "piece"]);
    Route::get('detailsvoiture/{id}', [VoitureController::class, "details"]);
    Route::put('remisevoiture', [VoitureController::class, "upe"]);

    Route::get('missions', [MissionController::class, 'index'])->name('missions');
    Route::get('addmissions', [MissionController::class, 'create']);
    Route::post('savemission', [MissionController::class, 'store']);
    Route::put('up/{id}', [MissionController::class, 'edit'])->name('up');
    Route::get('del/{id}', [MissionController::class, 'destroy']);


    Route::get('det/{id}', [MissionUserController::class, 'index'])->name('det');
    Route::get('rendreAllVoiture/{id}', [MissionUserController::class, 'rendreVoiture'])->name(('rendreAllVoiture'));
    Route::get('addchauf/{id}', [MissionUserController::class, 'create']);
    Route::put('addKmDebut/{id}', [MissionUserController::class, 'addKmDebut'])->name('addKmDebut');
    Route::put('addChauffeure/{id}', [MissionUserController::class, 'addChauffeure'])->name('addChauffeure');
    Route::post('savechauffeurs/{id}', [MissionUserController::class, 'store']);


    Route::get('chauffeurs', [ChauffeurController::class, 'index'])->name('chauffeurs');
    Route::get('addchauffeur', [ChauffeurController::class, 'create']);
    Route::post('storechauffeurs', [ChauffeurController::class, 'store']);

    Route::post('terminerVisteAll', [VisiteController::class, 'terminerVisteStore'])->name('terminerVisteAll');
    Route::post('terminerViste/{id}', [VisiteController::class, 'terminerVisteStore'])->name('terminerViste');
    Route::get('terminerViste/{id}', [VisiteController::class, 'terminerViste'])->name('terminerViste');
    Route::get('terminerVidange/{id}', [VisiteController::class, 'terminerVidange'])->name('terminerVidange');
    Route::post('actionVoiture', [VisiteController::class, 'actionVoiture'])->name('actionVoiture');

    Route::get('garages', [GarageController::class, 'index'])->name('garages');
    Route::get('addgarage', [GarageController::class, 'create']);
    Route::post('savegarage', [GarageController::class, 'store']);

    Route::get('pieces', [PieceController::class, 'index'])->name('pieces');
    Route::get('createpiece', [PieceController::class, 'create']);
    Route::post('savepiece', [PieceController::class, 'store']);

    Route::get('listereparation', [ReparerController::class, 'index'])->name('listereparation');
    Route::get('reparations', [ReparerController::class, 'create']);
    Route::post('createreparation', [ReparerController::class, 'store']);

    Route::get('notif', [NotificationController::class, 'index'])->name('notif');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('loginusers', [AuthController::class, 'create']);
Route::get('register', [AuthController::class, 'show']);
Route::post('registerusers', [AuthController::class, 'store']);
Route::get('signout', [AuthController::class, 'destroy']);
