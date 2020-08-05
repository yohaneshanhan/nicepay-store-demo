<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
include_once(app_path() . '\Library\Nicepay\NicepayConfig.php');
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

// Route::fallback(function() {
//     return 'Hm, why did you land here somehow?';
// });



Route::get('/checkout', 'HomeController@home');
Route::get('/inquiry', 'HomeController@inquiry');

Route::get('/getData','HomeController@getData');
Route::get('/getDetail/{id}','HomeController@getDetail');

Route::post('/sendRequestCheckout', 'CheckoutController@requestCheckout');
Route::post('/sendRequestInquiry', 'CheckStatusController@requestInquiry');
Route::post('/sendRequestCancel', 'CancelController@requestCancel');

Route::get('/{any}', 'HomeController@home')->where('any', '.*');

Route::get('/otherError', function(Request $request){
    return view ('otherError', $request->input());
})->name('otherError');

Route::any('result',function(Request $request){
    // Session::flash('iMid', NICEPAY_IMID);
    // Session::flash('merchantKey', NICEPAY_MERCHANT_KEY);
    return view ('result', $request->input());
});


// Route::get('/{any}', 'HomeController@home')->where('any','.*');
// Route::get('/user', 'HomeController@home');

// Route::get('/', function () {
//     return view('layouts.vue');
// });

// Route::view('/{any}', 'app')->where('any', '.*');
