<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //phan quyen user
        Gate::define('list_taikhoan', 'App\Policies\UserPolicy@view');
        Gate::define('add_taikhoan', 'App\Policies\UserPolicy@create');
        Gate::define('edit_taikhoan', 'App\Policies\UserPolicy@update');
        Gate::define('delete_taikhoan', 'App\Policies\UserPolicy@delete');

        //phan quyen role
        Gate::define('list_roles', 'App\Policies\RolesPolicy@view');
        Gate::define('add_roles', 'App\Policies\RolesPolicy@create');
        Gate::define('edit_roles', 'App\Policies\RolesPolicy@update');
        Gate::define('delete_roles', 'App\Policies\RolesPolicy@delete');

        //phan quyen permission
        Gate::define('list_permission', 'App\Policies\PermissionPolicy@view');
        Gate::define('add_permission', 'App\Policies\PermissionPolicy@create');
        Gate::define('edit_permission', 'App\Policies\PermissionPolicy@update');
        Gate::define('delete_permission', 'App\Policies\PermissionPolicy@delete');

        //phan quyen phong ban
        Gate::define('list_phongban', 'App\Policies\PhongbanPolicy@view');
        Gate::define('add_phongban', 'App\Policies\PhongbanPolicy@create');
        Gate::define('edit_phongban', 'App\Policies\PhongbanPolicy@update');
        Gate::define('delete_phongban', 'App\Policies\PhongbanPolicy@delete');

        //phan quyen chucvu
        Gate::define('list_chucvu', 'App\Policies\ChucvuPolicy@view');
        Gate::define('add_chucvu', 'App\Policies\ChucvuPolicy@create');
        Gate::define('edit_chucvu', 'App\Policies\ChucvuPolicy@update');
        Gate::define('delete_chucvu', 'App\Policies\ChucvuPolicy@delete');

        //phan quyen dmkhoiPb
        Gate::define('list_dmkhoipb', 'App\Policies\DmkhoiPbPolicy@view');
        Gate::define('add_dmkhoipb', 'App\Policies\DmkhoiPbPolicy@create');
        Gate::define('edit_dmkhoipb', 'App\Policies\DmkhoiPbPolicy@update');
        Gate::define('delete_dmkhoipb', 'App\Policies\DmkhoiPbPolicy@delete');

        //phan quyen can bo
        Gate::define('list_canbo', 'App\Policies\CanboPolicy@view');
        Gate::define('add_canbo', 'App\Policies\CanboPolicy@create');
        Gate::define('edit_canbo', 'App\Policies\CanboPolicy@update');
        Gate::define('delete_canbo', 'App\Policies\CanboPolicy@delete');

        //phân quyền chức năng bảng lương
        Gate::define('list_bangluong', 'App\Policies\BangluongPolicy@view');
        Gate::define('add_bangluong', 'App\Policies\BangluongPolicy@create');
        Gate::define('edit_bangluong', 'App\Policies\BangluongPolicy@update');
        Gate::define('delete_bangluong', 'App\Policies\BangluongPolicy@delete');




    }
}
