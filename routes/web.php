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

Route::get('/', function () {



    return view('auth.login');
});


Route::get('/logout', function () {
  Auth::logout();
  Session::flush();

 return Redirect::route('login');
});




Auth::routes();


Route::get('clean',function(){
    
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    
    return "temizlik yapıldı";
    
    
    
});

Route::group(['middleware' => 'auth'], function()
{
Route::get('/onaybekleyen', 'DashBoardController@onaybekleyen')->name('onaybekleyen');
Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');
Route::get('/devameden', 'DashBoardController@devameden')->name('devameden');
Route::get('/tamamlanan', 'DashBoardController@tamamlanan')->name('tamamlanan');
Route::get('/iptalteklif', 'DashBoardController@iptalteklif')->name('iptalteklif');

Route::post('/gelenteklifonayla', 'DashBoardController@gelenteklifonayla')->name('gelenteklifonayla');
Route::post('/gelenteklifsil', 'DashBoardController@gelenteklifsil')->name('gelenteklifsil');
Route::post('/gelentekliffiyatver', 'DashBoardController@gelentekliffiyatver')->name('gelentekliffiyatver');



Route::post('onaysil', 'DashBoardController@onaysil')->name('onaysil');

Route::get('/onaybekleyenedit/{id}', 'DashBoardController@onaybekleyenedit')->name('onaybekleyenedit');
Route::get('/onaybekleyenyazdir/{id}', 'DashBoardController@onaybekleyenyazdir')->name('onaybekleyenyazdir');
Route::post('/onaybekleyenupdate/{id}', 'DashBoardController@onaybekleyenupdate')->name('onaybekleyenupdate');
Route::get('/onaygidenmail/{id}', 'DashBoardController@onaygidenmail')->name('onaygidenmail');

//DEVAM EDEN ROUTE BAŞLANGIÇ
Route::post('/tekliftamamla', 'DashBoardController@tekliftamamla')->name('tekliftamamla');
Route::post('/devamsil', 'DashBoardController@devamsil')->name('devamsil');
Route::get('/devamedenedit/{id}', 'DashBoardController@devamedenedit')->name('devamedenedit');
Route::post('/devamedenupdate/{id}', 'DashBoardController@devamedenupdate')->name('devamedenupdate');
Route::get('/devamedenyazdir/{id}', 'DashBoardController@devamedenyazdir')->name('devamedenyazdir');
Route::get('/devamgidenmail/{id}', 'DashBoardController@devamgidenmail')->name('devamgidenmail');


//TAMAMLANAN ROUTE BAŞLANGIÇ
Route::get('/tamamlananedit/{id}', 'DashBoardController@tamamlananedit')->name('tamamlananedit');
Route::post('/tamamlananupdate/{id}', 'DashBoardController@tamamlananupdate')->name('tamamlananupdate');
Route::get('/tamamlananyazdir/{id}', 'DashBoardController@tamamlananyazdir')->name('tamamlananyazdir');
Route::get('/tamamgidenmail/{id}', 'DashBoardController@tamamgidenmail')->name('tamamgidenmail');



Route::get('/yeniisekle', 'DashBoardController@yeniisekle')->name('yeniisekle');
Route::post('/isekle', 'DashBoardController@isekle')->name('isekle');

// TERCUMANLAR ROUTE
Route::get('/tercumanekle', 'DashBoardController@tercumanekle')->name('tercumanekle');
Route::get('/tumtercumanlar', 'DashBoardController@tumtercumanlar')->name('tumtercumanlar');
Route::post('/vttercumanekle', 'DashBoardController@vttercumanekle')->name('vttercumanekle');
Route::get('tercumanbasvurulari', 'DashBoardController@tercumanbasvurulari')->name('tercumanbasvurulari');
Route::post('tercumanbasvurusil', 'DashBoardController@tercumanbasvurusil')->name('tercumanbasvurusil');
Route::post('tercumanbasvuruonayla', 'DashBoardController@tercumanbasvuruonayla')->name('tercumanbasvuruonayla');
Route::get('/tercumanmaliyet', 'DashBoardController@tercumanmaliyet')->name('tercumanmaliyet');

Route::post('tercumansil', 'DashBoardController@tercumansil')->name('tercumansil');

Route::post('tercumansil2', 'DashBoardController@tercumansil2')->name('tercumansil2');


Route::post('coklutercumansil', 'DashBoardController@coklutercumansil')->name('coklutercumansil');


//BURDAN DEVAM ET
Route::post('toplulkstasi', 'DashBoardController@toplulkstasi')->name('toplulkstasi');

Route::post('tercumanguncelle/{id}','DashBoardController@tercumanguncelle')->name('tercumanguncelle');

Route::get('/dilsil/{id}', 'DashBoardController@dilsil')->name('dilsil');




Route::get('/tercumanduzenle/{id}', 'DashBoardController@tercumanduzenle')->name('tercumanduzenle');
Route::post('maliyetara', 'DashBoardController@maliyetara')->name('maliyetara');
Route::post('tercumanara', 'DashBoardController@tercumanara')->name('tercumanara');

//TERCUMANLAR İŞ TAKİP ROUTE

Route::get('/tercumanistakipekle', 'DashBoardController@tercumanistakipekle')->name('tercumanistakipekle');
Route::post('/tercumanformistakipekle', 'DashBoardController@tercumanformistakipekle')->name('tercumanformistakipekle');
Route::get('/tercumanistakipcetveli', 'DashBoardController@tercumanistakipcetveli')->name('tercumanistakipcetveli');
Route::post('/tercumanistakipcetvelisil', 'DashBoardController@tercumanistakipcetvelisil')->name('tercumanistakipcetvelisil');
Route::post('lksekle', 'DashBoardController@lksekle')->name('lksekle');

Route::get('/tercumantakipduzenle/{id}', 'DashBoardController@tercumantakipduzenle')->name('tercumantakipduzenle');

Route::post('istakipupdate/{id}', 'DashBoardController@istakipupdate')->name('istakipupdate');

Route::get('/lksyeeklenenler', 'DashBoardController@lksyeeklenenler')->name('lksyeeklenenler');

Route::post('lksara', 'DashBoardController@lksara')->name('lksara');


Route::get('idgonder/{id}', 'DashBoardController@idgonder')->name('idgonder');


Route::get('tercumanidgonder/{id}', 'DashBoardController@tercumanidgonder')->name('tercumanidgonder');




//ADLİYE WEB ROUTER

Route::get('adliyeisekle', 'DashBoardController@adliyeisekle')->name('adliyeisekle');
Route::post('adliyeiseklepost', 'DashBoardController@adliyeiseklepost')->name('adliyeiseklepost');

Route::get('adliyedevameden', 'DashBoardController@adliyedevameden')->name('adliyedevameden');


Route::post('adliyedevamonayla', 'DashBoardController@adliyedevamonayla')->name('adliyedevamonayla');
Route::post('adliyekayitsil', 'DashBoardController@adliyekayitsil')->name('adliyekayitsil');
Route::get('adliyeedit/{id}', 'DashBoardController@adliyeedit')->name('adliyeedit');
Route::post('adliyeupdate/{id}', 'DashBoardController@adliyeupdate')->name('adliyeupdate');
Route::get('adliyetamamlanan', 'DashBoardController@adliyetamamlanan')->name('adliyetamamlanan');


Route::get('geribildirimformu', 'DashBoardController@geribildirimformu')->name('geribildirimformu');

Route::get('istatistik', 'DashBoardController@istatistik')->name('istatistik');

//SAĞ ÜST MENU ROUTELERİ
Route::get('taslaklar', 'DashBoardController@taslaklar')->name('taslaklar');
Route::get('hesapno', 'DashBoardController@hesapno')->name('hesapno');
Route::get('subeiletisim', 'DashBoardController@subeiletisim')->name('subeiletisim');
Route::get('logolar', 'DashBoardController@logolar')->name('logolar');
Route::get('denememetin','DashBoardController@denememetin')->name('denememetin');

//RAPOR ROUTE
Route::post('raporara', 'DashBoardController@raporara')->name('raporara');

Route::get('test', 'DashBoardController@test')->name('test');
Route::get('mailgonder', 'DashBoardController@mail')->name('mail');
Route::post('toplugelenteklifsil', 'DashBoardController@toplugelenteklifsil')->name('toplugelenteklifsil');




    Route::get('test2', 'DashBoardController@test2')->name('test2');



});
