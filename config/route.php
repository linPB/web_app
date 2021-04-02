<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;

Route::group('/admin/auth', function () {
    Route::get('/login/index', [app\admin\controller\auth\Login::class, 'index']);
    Route::get('/login/logout', [app\admin\controller\auth\Login::class, 'logout']);
    Route::post('/login/do_login', [app\admin\controller\auth\Login::class, 'doLogin']);
    Route::get('/login/captcha', [app\admin\controller\auth\Login::class, 'captcha']);
    Route::get('/index/home', [app\admin\controller\auth\Index::class, 'index']);
    Route::get('/index/dashboard', [app\admin\controller\auth\Index::class, 'dashboard']);
});

Route::group('/admin/sys', function () {
    Route::get('/user/index', [app\admin\controller\sys\User::class, 'index']);
    Route::get('/user/show_edit', [app\admin\controller\sys\User::class, 'showEdit']);
    Route::post('/user/edit', [app\admin\controller\sys\User::class, 'edit']);
    Route::get('/user/show_store', [app\admin\controller\sys\User::class, 'showStore']);
    Route::post('/user/store', [app\admin\controller\sys\User::class, 'store']);
    Route::post('/user/del', [app\admin\controller\sys\User::class, 'del']);

    Route::get('/menu/index', [app\admin\controller\sys\Menu::class, 'index']);
    Route::get('/menu/show_edit', [app\admin\controller\sys\Menu::class, 'showEdit']);
    Route::post('/menu/edit', [app\admin\controller\sys\Menu::class, 'edit']);
    Route::get('/menu/store', [app\admin\controller\sys\Menu::class, 'showStore']);
    Route::post('/menu/show_store', [app\admin\controller\sys\Menu::class, 'store']);

    Route::get('/role/index', [app\admin\controller\sys\Role::class, 'index']);
    Route::get('/role/show_edit', [app\admin\controller\sys\Role::class, 'showEdit']);
    Route::post('/role/edit', [app\admin\controller\sys\Role::class, 'edit']);
    Route::get('/role/store', [app\admin\controller\sys\Role::class, 'showStore']);
    Route::post('/role/show_store', [app\admin\controller\sys\Role::class, 'store']);

    Route::get('/permission/index', [app\admin\controller\sys\Permission::class, 'index']);
    Route::get('/permission/show_edit', [app\admin\controller\sys\Permission::class, 'showEdit']);
    Route::post('/permission/edit', [app\admin\controller\sys\Permission::class, 'edit']);
    Route::get('/permission/store', [app\admin\controller\sys\Permission::class, 'showStore']);
    Route::post('/permission/show_store', [app\admin\controller\sys\Permission::class, 'store']);
});