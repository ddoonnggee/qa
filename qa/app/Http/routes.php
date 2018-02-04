<?php

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
Route::get('pk', ['as' => 'pk', 'uses' => 'IndexController@pk']);
// Route::get('clear', ['as' => 'clear', 'uses' => 'IndexController@clear']);

//Login
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    //Dashboard
    Route::get('/', ['as' => 'admin.dashboard.index', 'uses' => 'DashboardController@index']);

    //Users
    Route::resource('users', 'UserController');

    //Roles
    Route::resource('roles', 'RoleController');

    //Permissions
    Route::resource('permissions', 'PermissionController');
    Route::post('permissions/update-sort', ['as' => 'admin.permissions.update_sort', 'uses' => 'PermissionController@updateSort']);

    //PermissionGroup
    Route::resource('permissiongroups', 'PermissionGroupController', ['except' => ['show']]);
    Route::group(['prefix' => 'permissiongroups','as' => 'admin.permissiongroups.'], function () {
        Route::get('build-tree', ['as' => 'build_tree', 'uses' => 'PermissionGroupController@buildTree']);
        Route::post('update-sort', ['as' => 'update_sort', 'uses' => 'PermissionGroupController@updateSort']);
    });

    //Articles
    Route::resource('articles', 'ArticleController');

    // 分类
    Route::resource('cate', 'CateController');
    // 题库
    Route::resource('question', 'QuestionController');
    // 答案
    Route::resource('answer', 'AnswerController');
    // PK轮次
    Route::resource('round', 'RoundController');
    // PK轮次
    Route::resource('member', 'MemberController');

    //Settings
    Route::resource('settings', 'SettingController');
});

//Api
Route::group(['prefix' => 'api', 'middleware' => 'allowOrigin'], function () {
    Route::controller('interface', 'Api\InterfaceController');
    //Users
    Route::resource('users', 'Api\UserController', ['only' => ['index', 'show']]);
});
