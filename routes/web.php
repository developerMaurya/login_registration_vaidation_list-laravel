<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/',[EmployeeController::class,'login'])->name('login');
Route::post('/login',[EmployeeController::class,'handlelogin'])->name('handlelogin');
Route::get('/userRegistration',[EmployeeController::class,'userRegistration'])->name('userRegister');
Route::post('/userRegistration',[EmployeeController::class,'handleuserRegistration'])->name('handleuserRegistration');
Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
// Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index')->middleware('auth');


Route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
Route::post('/employees',[EmployeeController::class,'store'])->name('employees.store');
Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');


// user 
Route::get('/homepage', [EmployeeController::class, 'homepage'])->name('homepage');
Route::get('/logout', [EmployeeController::class, 'logout'])->name('logout');





// use App\Http\Controllers\EmployeeController;

// Route::get('/', [EmployeeController::class, 'login'])->name('login');
// Route::post('/login', [EmployeeController::class, 'handlelogin'])->name('handlelogin');
// Route::get('/userRegistration', [EmployeeController::class, 'userRegistration'])->name('userRegister');
// Route::post('/userRegistration', [EmployeeController::class, 'handleuserRegistration'])->name('handleuserRegistration');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
//     Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
//     Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
//     Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
//     Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
//     Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    
//     Route::get('/homepage', [EmployeeController::class, 'homepage'])->name('homepage');
//     Route::get('/logout', [EmployeeController::class, 'logout'])->name('logout');
// });
