<?php

use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IncrementController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\OperatingController;
use App\Http\Controllers\OperatingPartialController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PartialController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PresuntivePaymentController;
use App\Http\Controllers\RemissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('user', UserController::class);
Route::resource('document', DocumentController::class);
Route::resource('role', RoleController::class);
Route::resource('department', DepartmentController::class);
Route::resource('municipality', MunicipalityController::class);
Route::resource('company', CompanyController::class);
Route::resource('category', CategoryController::class);
Route::resource('operation', OperationController::class);
Route::resource('remission', RemissionController::class);
Route::resource('operating', OperatingController::class);
Route::resource('partial', PartialController::class);
Route::resource('operatingPartial', OperatingPartialController::class);
Route::resource('bank', BankController::class);
Route::resource('paymentMethod', PaymentMethodController::class);
Route::resource('payment', PaymentController::class);
Route::resource('advance', AdvanceController::class);
Route::resource('presuntive', PresuntivePaymentController::class);
Route::resource('increment', IncrementController::class);


Route::get('inactive', [UserController::class, 'inactive'])->name('inactive');
Route::get('status/{id}', [UserController::class, 'status'])->name('status');

Route::get('remission/showPdfRemission/{id}', [RemissionController::class, 'showPdfRemission'])->name('showPdfRemission');
Route::get('remission/EntegaPartial/{id}', [RemissionController::class, 'EntregaPartial'])->name('EntregaPartial');
Route::get('remission/EntegaTotal/{id}', [RemissionController::class, 'EntregaTotal'])->name('EntregaTotal');

Route::get('partial/showPdfPartial/{id}', [PartialController::class, 'showPdfPartial'])->name('showPdfPartial');
Route::post('storetotal', [PaymentController::class, 'storetotal'])->name('storetotal');
Route::get('storeCreate', [PaymentController::class, 'storeCreate'])->name('storeCreate');

Route::get('payment/showPdfPayment/{id}', [PaymentController::class, 'showPdfPayment'])->name('showPdfPayment');

Route::get('aprobation/{id}', [PartialController::class, 'aprobation'])->name('aprobation');


