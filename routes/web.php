<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
	'uses' => 'ProductController@getIndex',
	'as' => 'product.index'
]);

Route::get('/add-to-cart/{id}', [
	'uses' => 'ProductController@getAddToCart',
	'as' => 'product.addToCart'
]);

Route::get('/reduce/{id}', [
	'uses' => 'ProductController@getReduceByOne',
	'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
	'uses' => 'ProductController@getRemoveItem',
	'as' => 'product.remove'
]);

Route::get('/shopping-cart', [
	'uses' => 'ProductController@getCart',
	'as' => 'product.shoppingCart'
]);

Route::get('/checkout', [
	'uses' => 'ProductController@getCheckout',
	'as' => 'checkout',
	'middleware' => 'auth1'
]);

Route::post('/checkout', [
	'uses' => 'ProductController@postCheckout',
	'as' => 'checkout',
	'middleware' => 'auth1'
]);

Route::group(['prefix' => 'user'], function () {
	Route::group(['middleware' => 'guest'], function () {
		Route::get('/signup', [
			'uses' => 'UserController@getSignup',
			'as' => 'user.signup'
		]);

		Route::post('/signup', [
			'uses' => 'UserController@postSignup',
			'as' => 'user.signup'
		]);

		Route::get('/signin', [
			'uses' => 'UserController@getSignin',
			'as' => 'user.signin'

		]);

		Route::post('/signin', [
			'uses' => 'UserController@postSignin',
			'as' => 'user.signin'
		]);
	});

	Route::group(['middleware' => 'auth1'], function () {
		Route::get('/profile', [
			'uses' => 'UserController@getProfile',
			'as' => 'user.profile'
		]);

		Route::get('/logout', [
			'uses' => 'UserController@getLogout',
			'as' => 'user.logout'
		]);
	});
});

## testes
Auth::routes();
Route::get('/setup-card', function (Request $request) {
	$user = User::find(auth()->user()->id);

	return view('update-payment-method', [
		'intent' => $user->createSetupIntent()
	]);
});

Route::post('/card-save', function (Request $request) {
	$user = User::find(auth()->user()->id);

	$user->updateDefaultPaymentMethod($request->get('card'));
});

Route::get('/{sku}/product-buy', function (Request $request, $sku) {
	\Stripe\Stripe::setApiKey('sk_test_');
	$sku = \Stripe\SKU::retrieve($sku);
	$usr = User::find(auth()->user()->id);
	$usr->invoiceFor($sku->attributes->name, $sku->price, [], [
		'tax_percent' => 16,
	]);

	return redirect()->to('/');
})->name('product-buy');

Route::get('/{plan}/plan-buy', function (Request $request, $plan) {
	\Stripe\Stripe::setApiKey('sk_test_');
	$plan = \Stripe\Plan::retrieve($plan);
	$usr = User::find(auth()->user()->id);
	$usr->newSubscription($plan->product, $plan->id)->create($usr->defaultPaymentMethod()->asStripePaymentMethod()->id);
	return redirect()->to('/');
})->name('plan-buy');
