<?php

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PayrollsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Role;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard', [
            'payrollsCount' => Payroll::all()->count(),
            'employeesCount' => Employee::all()->count(),
            'rolesCount' => Role::all()->count(),
            'departmentsCount' => Department::all()->count(),
            'latestEmployees' => Employee::latest()->take(5)->get(),
            'latestPayrolls' => Payroll::latest()->take(5)->get()
        ]);
    })->name('dashboard')->middleware(['dashboard']);
    Route::resource('departments', DepartmentsController::class)->except(['create', 'show', 'edit'])->middleware(['departments']);
    Route::resource('roles', RolesController::class)->except(['create', 'show', 'edit'])->middleware(['roles']);
    Route::middleware(['employees'])->group(function() {
        Route::put('employees/edit-bulk', [EmployeesController::class, 'updateBulk'])->name('employees.edit.bulk');
        Route::delete('employees/delete-bulk', [EmployeesController::class, 'destroyBulk'])->name('employees.destroy.bulk');
        Route::resource('employees', EmployeesController::class)->except(['create', 'show', 'edit']);
    });
    Route::resource('users', UsersController::class)->only(['update']);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/update/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::apiResource('payrolls', PayrollsController::class)->only(['update', 'destroy']);
});
