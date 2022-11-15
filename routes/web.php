<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PermissionRoleController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\RoleUserController;
use App\Http\Controllers\Admin\ACL\UserProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('teste-acl', function(){
        dd(auth()->user());
    });

    //routes user x profiles
    Route::get('users/{id}/profile/{idProfile}/detach', [UserProfileController::class, 'detachProfileUser'])->name('users.profile.detach');
    Route::post('users/{id}/profiles', [UserProfileController::class, 'attachProfilesUser'])->name('users.profiles.attach');
    Route::any('users/{id}/profiles/create', [UserProfileController::class, 'profilesAvailable'])->name('users.profiles.available');
    Route::get('users/{id}/profiles', [UserProfileController::class, 'profiles'])->name('users.profiles');
    Route::get('/profiles/{id}/users', [UserProfileController::class, 'users'])->name('profiles.users');


    //routes permission x profile
    Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
    Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');


    //routes role x user
    Route::get('users/{id}/role/{idPermission}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
    Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attach');
    Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
    Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
    Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users');

    //routes role x permission
    Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionProfile'])->name('roles.permission.detach');
    Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsProfile'])->name('roles.permissions.attach');
    Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permission.roles');

    //routes permission
    Route::resource('/permissions', PermissionController::class);
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');

    //routes users 
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);

    //routes roles 
    Route::any('roles/search', [RolesController::class, 'search'])->name('roles.search');
    Route::resource('roles', RolesController::class);

    //routes Profile 
    Route::resource('/profiles', ProfileController::class);
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');


    //route home dashboard
    Route::get('/', [SiteController::class, 'index'])->name('admin.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
