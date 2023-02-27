<?php
$route_admin = route_admin()==null?'admin':route_admin();//admin / setting()->route_admin
Route::group(['namespace' => 'Auth'], function () {
    $route_login = route_login()==null?'admin-login':route_login();//admin / setting()->route_admin
    Route::get($route_login, function () {
        return view('Admin.auth.login');
    })->name('admin.auth.login');
    Route::post($route_login, 'LoginController@checkLogin')->name('admin.auth.login');
    Route::get('/logoutAdmin', 'LoginController@logoutAdmin')->name('logout-admin');
});

Route::group(['namespace' => 'Admin','prefix' => $route_admin,'middleware' => 'authAdmin'],function (){
    Route::get('/','DashboardController@getDashboard')->name('admin_index');
    Route::get('/dashboard','DashboardController@getDashboard')->name('dashboard');
    Route::group(['prefix' => 'services'], function () {
        Route::get('/','ServicesController@getService')->name('services');
        Route::get('/datatable','ServicesController@getDatatable')->name('service_datatable');
        Route::get('/update','ServicesController@getUpdateServices')->name('service_update');
        Route::post('/update','ServicesController@postUpdateServices')->name('service_update');
        Route::post('/insert','ServicesController@postInsertServices')->name('service_insert');
        Route::post('/delete','ServicesController@destroyService')->name('service_delete');
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/all','ProjectsController@getProject')->name('projects');
        Route::get('/expired','ProjectsController@getExpired')->name('projects_expired');
        Route::get('/unexpired','ProjectsController@getUnexpired')->name('projects_unexpired');


        Route::get('/datatable','ProjectsController@getDatatable')->name('project_datatable');
        Route::get('/datatable-expired','ProjectsController@getDatatableExpired')->name('projects_datatable_exprired');
        Route::get('/datatable-unexpired','ProjectsController@getDatatableUnexpired')->name('projects_datatable_unexpired');

        Route::get('/update','ProjectsController@getUpdateProjects')->name('project_update');
        Route::post('/update','ProjectsController@postUpdateProjects')->name('project_update');
        Route::post('/insert','ProjectsController@postInsertProjects')->name('project_insert');
        Route::post('/delete','ProjectsController@destroyProject')->name('project_delete');
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/','PagesController@getPage')->name('pages');
        Route::get('/datatable','PagesController@getDatatable')->name('page_datatable');
        Route::get('/update','PagesController@getUpdatePages')->name('page_update');
        Route::post('/update','PagesController@postUpdatePages')->name('page_update');
        Route::post('/insert','PagesController@postInsertPages')->name('page_insert');
        Route::post('/delete','PagesController@destroyPage')->name('page_delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/','UsersController@getUser')->name('users');
        Route::get('/datatable','UsersController@getDatatable')->name('user_datatable');
        Route::get('/update','UsersController@getUpdateUsers')->name('user_update');
        Route::post('/update','UsersController@postUpdateUsers')->name('user_update');
        Route::post('/insert','UsersController@postInsertUsers')->name('user_insert');
        Route::post('/delete','UsersController@destroyUser')->name('user_delete');
        Route::get('/profile-admin','UsersController@getProfileAdmin')->name('profile_admin');
        Route::post('/profile-admin-update','UsersController@postUpdateProfileAdmin')->name('profile_admin_update');

    });

    Route::group(['prefix' => 'contact'], function () {
        Route::get('/','ContactController@getContact')->name('contact');
        Route::get('/datatable','ContactController@getDatatable')->name('contact_datatable');
        Route::post('/delete','ContactController@destroyContact')->name('contact_delete');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/','SettingsController@getSetting')->name('settings');
        Route::get('/data','SettingsController@fetchSetting')->name('admin.settings.data');
        Route::post('/update-guest','SettingsController@updateGuest')->name('settings_update_guest');
        Route::post('/update-mail','SettingsController@updateMail')->name('settings_update_mail');
        Route::post('/update-header','SettingsController@updateHeader')->name('admin.settings.update_header');
        Route::post('/skill-area','SettingsController@skillArea')->name('admin.settings.skill_area');
        Route::post('/featureds','SettingsController@featureds')->name('admin.settings.featureds');
        Route::post('/awesome','SettingsController@awesome')->name('admin.settings.awesome');
        Route::post('/funfact','SettingsController@funfact')->name('admin.settings.funfact');
        Route::post('/clients','SettingsController@clients')->name('admin.settings.clients');
    });
    Route::group(['prefix' => 'tin-tuc'], function () {
        Route::get('/','NewsController@getNews')->name('admin.news.dashboard');
        Route::get('/datatable','NewsController@fetchData')->name('admin.news.datatables');
        Route::get('/update','NewsController@getDataById')->name('admin.news.update');
        Route::post('/update','NewsController@updateData')->name('admin.new s.update');
        Route::post('/insert','NewsController@insertData')->name('admin.news.insert');
        Route::post('/delete','NewsController@deleteData')->name('admin.news.delete');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/','CategoriesController@getCategories')->name('admin.categories.dashboard');
        Route::get('/fetch-data','CategoriesController@fetchIndex')->name('admin.categories.fetchdata');
        Route::get('/datatable','CategoriesController@fetchData')->name('admin.categories.datatables');
        Route::get('/update','CategoriesController@getDataById')->name('admin.categories.update');
        Route::post('/update','CategoriesController@updateData')->name('admin.categories.update');
        Route::post('/insert','CategoriesController@insertData')->name('admin.categories.insert');
        Route::post('/delete','CategoriesController@deleteData')->name('admin.categories.delete');
    });
    Route::group(['prefix'=>'header_home'],function(){
        Route::get('/datatable','HeaderHomeController@fetchData')->name('admin.header_home.datatables');
        Route::post('/insert','HeaderHomeController@insert')->name('admin.header_home.insert');
        Route::get('/update','HeaderHomeController@getDataById')->name('admin.header_home.update');
        Route::post('/update','HeaderHomeController@updateData')->name('admin.header_home.update');
        Route::post('/delete','HeaderHomeController@delete')->name('admin.header_home.delete');
    });
    Route::group(['prefix'=>'skill_area'],function(){
        Route::get('/datatable','SkillAreaController@fetchData')->name('admin.skill_area.datatables');
        Route::post('/insert','SkillAreaController@insert')->name('admin.skill_area.insert');
        Route::get('/update','SkillAreaController@getDataById')->name('admin.skill_area.update');
        Route::post('/update','SkillAreaController@updateData')->name('admin.skill_area.update');
        Route::post('/delete','SkillAreaController@delete')->name('admin.skill_area.delete');
    });
    Route::group(['prefix'=>'featureds'],function(){
        Route::get('/datatable','FeaturedsController@fetchData')->name('admin.featureds.datatables');
        Route::post('/insert','FeaturedsController@insert')->name('admin.featureds.insert');
        Route::get('/update','FeaturedsController@getDataById')->name('admin.featureds.update');
        Route::post('/update','FeaturedsController@updateData')->name('admin.featureds.update');
        Route::post('/delete','FeaturedsController@delete')->name('admin.featureds.delete');
    });
    Route::group(['prefix'=>'awesome'],function(){
        Route::get('/datatable','AwesomeController@fetchData')->name('admin.awesome.datatables');
        Route::post('/insert','AwesomeController@insert')->name('admin.awesome.insert');
        Route::get('/update','AwesomeController@getDataById')->name('admin.awesome.update');
        Route::post('/update','AwesomeController@updateData')->name('admin.awesome.update');
        Route::post('/delete','AwesomeController@delete')->name('admin.awesome.delete');
    });
    Route::group(['prefix'=>'clients'],function(){
        Route::get('/datatable','ClientsController@fetchData')->name('admin.clients.datatables');
        Route::post('/insert','ClientsController@insert')->name('admin.clients.insert');
        Route::get('/update','ClientsController@getDataById')->name('admin.clients.update');
        Route::post('/update','ClientsController@updateData')->name('admin.clients.update');
        Route::post('/delete','ClientsController@delete')->name('admin.clients.delete');
    });
});