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
    return view('welcome');
});

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('home');

//  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
//  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//  Route::get('/', 'AdminController@index')->name('admin.dashboard');
//  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

//Admin
//	Route::get('/admins/ajax','AdminController@id_ajax');
//	Route::resource('/admins', 'AdminController');
	
	
//Expense
Route::resource('/expenses', 'ExpenseController');

//Asset
Route::resource('/assets/new', 'AssetNewController');
Route::resource('/assets/old', 'AssetController');

//Reports
Route::get('/report/deposits', 'ReportController@deposit');
Route::get('/report/expenses', 'ReportController@expense');
Route::get('/report/ledgers', 'ReportController@ledger');
Route::get('/report/assets', 'ReportController@asset');
Route::get('/report/assets/expiry', 'ReportController@expiry');
Route::get('/report/overall', 'ReportController@overall');
// Route::get('/report/datatable', 'ReportController@datatable_ajax');

Route::group(['middleware' => 'CheckAdmin'], function() {
	
	//Users
	Route::get('/users/ajax','UserController@id_ajax');
	Route::resource('/users', 'UserController');
	
	//Deposits
	Route::resource('/deposits', 'DepositController');
	
	Route::group(['middleware' => 'CheckSuperUser'], function() {

		//company
		Route::resource('/companies', 'CompanyController');
		
		//Workshop
		Route::get('/workshops/ajax','WorkshopController@id_ajax');
		Route::resource('/workshops', 'WorkshopController');

		//Location - Ajax
		//Route::get('/locations/ajax','LocationController@id_ajax');
		Route::resource('/locations', 'LocationController');

		//Department
		Route::resource('/descriptions', 'DescriptionController');

		//Tax
		Route::resource('/taxes', 'TaxController');

		//Designation
		Route::resource('/designations', 'DesignationController');

		//Employee(user) Type
		Route::resource('/employee-types', 'EmployeeTypeController');

		//Expense Category
		Route::resource('/expense-categories', 'ExpenseCategoryController');

		//Sub Expense Category
		Route::get('/subexpenses/ajax','SubExpenseController@id_ajax');
		Route::resource('/subexpenses', 'SubExpenseController');
		
		//Purchase Category
		Route::resource('/purchase-categories', 'PurchaseCategoryController');
		
		//Asset Category
		Route::resource('/asset-categories', 'AssetCategoryController');

		//Sub Asset Category
		Route::get('/subassets/ajax','SubAssetController@id_ajax');
		Route::resource('/subassets', 'SubAssetController');
		
		//Sub Purchase Category
		//Route::get('/subpurchase/ajax','SubPurchaseController@id_ajax');
		//Route::resource('/subpurchase', 'SubPurchaseController');

		//Employees
		//Route::get('/employees/ajax','EmployeeController@id_ajax');
		//Route::resource('/employees', 'EmployeeController');
		
		//Sub Sub Expense Category - Ajax
		//Route::get('/subsubexpenses/ajax','SubSubExpenseController@id_ajax');
		//Route::resource('/subsubexpenses', 'SubSubExpenseController');
		
	});

});


