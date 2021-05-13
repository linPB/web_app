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
    Route::post('/user/show', [app\admin\controller\sys\User::class, 'show']);
    Route::post('/user/upd_show', [app\admin\controller\sys\User::class, 'editShow']);
    Route::post('/user/upd', [app\admin\controller\sys\User::class, 'edit']);
    Route::post('/user/add_show', [app\admin\controller\sys\User::class, 'storeShow']);
    Route::post('/user/store', [app\admin\controller\sys\User::class, 'store']);
    Route::post('/user/del', [app\admin\controller\sys\User::class, 'del']);
    Route::post('/user/reset_pd', [app\admin\controller\sys\User::class, 'resetPd']);

    Route::get('/menu/index', [app\admin\controller\sys\Menu::class, 'index']);
    Route::post('/menu/show', [app\admin\controller\sys\Menu::class, 'show']);
    Route::post('/menu/upd', [app\admin\controller\sys\Menu::class, 'edit']);
    Route::post('/menu/store', [app\admin\controller\sys\Menu::class, 'store']);
    Route::post('/menu/del', [app\admin\controller\sys\Menu::class, 'del']);

    Route::get('/role/index', [app\admin\controller\sys\Role::class, 'index']);
    Route::post('/role/show', [app\admin\controller\sys\Role::class, 'show']);
    Route::post('/role/upd_show', [app\admin\controller\sys\Role::class, 'editShow']);
    Route::post('/role/upd', [app\admin\controller\sys\Role::class, 'edit']);
    Route::post('/role/add_show', [app\admin\controller\sys\Role::class, 'storeShow']);
    Route::post('/role/store', [app\admin\controller\sys\Role::class, 'store']);
    Route::post('/role/del', [app\admin\controller\sys\Role::class, 'del']);

    Route::get('/permission/index', [app\admin\controller\sys\Permission::class, 'index']);
    Route::post('/permission/show', [app\admin\controller\sys\Permission::class, 'show']);
    Route::post('/permission/upd', [app\admin\controller\sys\Permission::class, 'edit']);
    Route::post('/permission/store', [app\admin\controller\sys\Permission::class, 'store']);
    Route::post('/permission/del', [app\admin\controller\sys\Permission::class, 'del']);
});