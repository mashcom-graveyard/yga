<?php

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


Route::group(['middleware' => ['auth', 'active_only']], function () {


    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', 'HomeController@dashboard');

    Route::post('/member/update/{id}', 'MemberController@update');
    Route::resource('/member', 'MemberController');

    Route::resource('/category', 'CategoryController')->middleware('admin_only');
    Route::resource('/sport', 'SportsController')->middleware('admin_only');
    Route::resource('/province', 'ProvincesController')->middleware('admin_only');

    Route::resource('/designation', 'DesignationsController')->middleware('admin_only');
    Route::post('/designation/zone/update','DesignationsController@zoneUpdate')->middleware('admin_only');

    Route::resource('/venue', 'VenueController')->middleware('admin_only');
    Route::get('/venue/{id}/rules', 'VenueController@rules')->middleware('admin_only');
    Route::post('/venue/{id}/rules', 'VenueController@saveRules')->middleware('admin_only');

    Route::resource('/rules', 'RulesController')->middleware('admin_only');
    Route::post('/rules', 'HomeController@saveRules')->middleware('admin_only');

    Route::resource('/zone', 'ZonesController')->middleware('admin_only');

    Route::post('/section/update', 'HomeController@update')->middleware('admin_only');

    Route::get('rules/settings/transport', 'RulesController@settings');

    //Route::get('/home', 'HomeController@index')->name('home');


    Route::resource('/users', 'UserController');//->middleware(['admin_only','general_manager']);
    Route::get('/users/toggle_status/{id}', 'UserController@toggleStatus')->middleware('admin_only');



    Route::get('/pdf/{id}',function($id){
        return PDF::loadFile('https://youthgames.changamire.com/generate/pass/'.$id)
            ->setPaper('a4')
            ->setOption('margin-bottom', 0)
            ->inline('card.pdf');
    });

    Route::get('/print/cards/{province}/{sport}',function ($province,$sport){
        return PDF::loadFile("https://youthgames.changamire.com//province_sports_cards/$province/$sport")
            ->setPaper('a4')
            ->setOption('margin-bottom', 0)
            ->inline('card.pdf');


    });
    Route::get('report','ReportsController@master');


});

Route::get('/security/password',function(){
    return view('auth.passwords.reset');
})->middleware('auth');
Route::post('/security/password','UserController@changePassword')->name('change.password')->middleware('auth');

Route::get('/generate/pass/{id}', 'MemberController@generatePass');
Route::get('/province_sports_cards/{province}/{sport}','MemberController@generateProvinceSportCards');


Route::any('/deactivated', function () {

    echo "Account deactivated, Contact System admin for more details";
    return;
});


Route::get('/api/dump', function () {

    if (isset($_GET['youth7613'])) {
        return \App\Member::with('member_designation', 'member_sport', 'member_province')->get()->toJson();
    }
    return "false";
});

Route::get('/api/dump/villages', function () {

    if (isset($_GET['youth7613'])) {
        return \App\Venue::all()->toJson();
    }
    return "false";
});

Route::get('/api/dump/rules', function () {
    if (isset($_GET['youth7613'])) {
        return App\Rule::all()->toJson();
    }
});

Route::get('/api/dump/zones', function () {
    if (isset($_GET['youth7613'])) {
        return App\Zone::all()->toJson();
    }
});

Route::get('/api/dump/designations', function () {
    if (isset($_GET['youth7613'])) {
        return App\Designation::all()->toJson();
    }
});
Route::get('/api/dump/category', function () {
    if (isset($_GET['youth7613'])) {
        return App\Category::all()->toJson();
    }
});

Route::get('/api/dump/sport', function () {
    if (isset($_GET['youth7613'])) {
        return App\Sport::all()->toJson();
    }
});

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();





