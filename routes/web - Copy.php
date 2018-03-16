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

Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	//Admin
	Route::get('/admins/ajax','AdminController@id_ajax');
	Route::resource('/admins', 'AdminController');

	//Advance Pay
	Route::resource('/deposits', 'DepositController');
	
	//Users
	Route::get('/users/ajax','UserController@id_ajax');
	Route::resource('/users', 'UserController');
	
	//company
	Route::resource('/companies', 'CompanyController');

	//Workshop
	Route::resource('/workshops', 'WorkshopController');

	//Location - Ajax
	Route::get('/locations/ajax','LocationController@id_ajax');
	Route::resource('/locations', 'LocationController');

	//Employees
	//Route::get('/employees/ajax','EmployeeController@id_ajax');
	//Route::resource('/employees', 'EmployeeController');

	//Department
	Route::resource('/departments', 'DepartmentController');

	//Designation
	Route::resource('/designations', 'DesignationController');

	//Employee Type
	Route::resource('/employee-types', 'EmployeeTypeController');

	//Expense Category
	Route::resource('/expense-categories', 'ExpenseCategoryController');

	//Sub Expense Category
	Route::get('/subexpenses/ajax','SubExpenseController@id_ajax');
	Route::resource('/subexpenses', 'SubExpenseController');

	//Sub Sub Expense Category - Ajax
	Route::get('/subsubexpenses/ajax','SubSubExpenseController@id_ajax');
	Route::resource('/subsubexpenses', 'SubSubExpenseController');

});



	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/dashboard', 'HomeController@index')->name('home');

	//Expense Category
	Route::resource('/expense-categories', 'ExpenseCategoryController');

	//Sub Expense Category
	Route::get('/subexpenses/ajax','SubExpenseController@id_ajax');
	Route::resource('/subexpenses', 'SubExpenseController');

	//Sub Sub Expense Category - Ajax
	Route::get('/subsubexpenses/ajax','SubSubExpenseController@id_ajax');
	Route::resource('/subsubexpenses', 'SubSubExpenseController');
	
	//Expense
	Route::resource('/expenses', 'ExpenseController');


