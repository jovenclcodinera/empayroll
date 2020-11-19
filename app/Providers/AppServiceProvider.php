<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Observers\DepartmentObserver;
use App\Observers\EmployeeObserver;
use App\Observers\RoleObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Department::observe(DepartmentObserver::class);
        Role::observe(RoleObserver::class);
        Employee::observe(EmployeeObserver::class);

        View::composer('auth.register', function($view) {
            $view->with([
                'roles' => Role::where('title', '!=', 'UNASSIGNED')->orderBy('title')->get(),
                'departments' => Department::where('name', '!=', 'Unassigned')->orderBy('name')->get()
            ]);
        });
    }
}
