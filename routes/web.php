<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});


//el que muestre una vista debe tener index
Route::get('/regis',[RegisterController::class, 'index'])->name('register');
Route::post('/regis',[RegisterController::class, 'store']);





