<?php


use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\{SupportController};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/supports/{id}', [SupportController::class, 'destroy'])->name('supports.destroy');

Route::put('/supports/{id}/update', [SupportController::class,'update'])->name('supports.update');
Route::put('/supports/{id}/updatelocal', [SupportController::class,'updatelocalizacao'])->name('supports.updatelocal');
Route::put('/supports/{id}/updateitens', [SupportController::class,'updateitens'])->name('supports.updateitens');
Route::put('/supports/{id}/troca', [SupportController::class, 'troca'])->name('supports.troca');


Route::get('/supports/{id}/edit', [SupportController::class,'edit'])->name('supports.edit');

Route::get('/supports/{id}/editlocal', [SupportController::class,'editlocal'])->name('supports.editlocal');

Route::get('/supports/{id}/additem', [SupportController::class,'additem'])->name('supports.additem');
Route::get('/supports/{id}/troca', [SupportController::class, 'troca'])->name('supports.troca');

Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');

Route::get('/contato',[SiteController::class, 'contact']);

Route::get('/supports',[SupportController::class, 'index'])->name('supports.index');

Route::get('/supports/create',[SupportController::class, 'create'])->name ('supports.create');

Route::get ('/supports/{id}',[SupportController::class, 'show'])->name('supports.show');

Route::post('/supports/trocar', [SupportController::class,'trocarItems'])->name('trocarItems.explorador');

});



require __DIR__.'/auth.php';



