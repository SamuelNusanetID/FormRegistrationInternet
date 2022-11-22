<?php

use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\NewCustomerController;
use App\Http\Controllers\User\OldCustomerController;
use Google\Service\Compute\Resource\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return redirect('/');
})->name('login');

Route::get('dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::get('/', [HomeController::class, 'index']);

Route::get('/new-member', [HomeController::class, 'newcustomerclass']);
Route::get('/new-member/personal/{id_customer}', [NewCustomerController::class, 'indexPersonal']);
Route::post('/new-member/personal/{id_customer}', [NewCustomerController::class, 'indexPersonal']);
Route::post('/new-member/personal', [NewCustomerController::class, 'storePersonal']);
Route::get('/new-member/bussiness/{id_customer}', [NewCustomerController::class, 'indexBussiness']);
Route::post('/new-member/bussiness/{id_customer}', [NewCustomerController::class, 'indexBussiness']);
Route::post('/new-member/bussiness', [NewCustomerController::class, 'storeBussiness']);
Route::get('/old-member', [OldCustomerController::class, 'index']);
Route::post('/old-member/{class_customer}/{id_customer}', [OldCustomerController::class, 'showDataCustomer']);

Route::get('/generate', [NewCustomerController::class, 'generateNewLink']);
