<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\EmployeeType;
use App\Company;
use App\Location;
use App\Workshop;
use App\Designation;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	
	    	$users = User::AllUsers();
	        return view('user.index')->with('users',$users);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$employee_types = EmployeeType::all();
    	$companies = Company::all();
    	$designations = Designation::all();
    	
    	if(Auth::user()->user_type==1)
    	{
	    	
	        return view('user.create')->with(array('companies' => $companies, 'designations' => $designations, 'employee_types' => $employee_types));
		}
		if(Auth::user()->user_type==3)
    	{
    		//$locations = Location::all()->where('workshop_id',Auth::user()->workshop_id );
    		return view('user.create')->with(array( 'designations' => $designations, 'employee_types' => $employee_types));
    	}
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'workshop'=>'required|max:255',
			'employee_type'=>'required|max:255'
		]);
		
		
		$user = new User;
		
		if(empty($request->hod))
		$user->hod = 0;
		else
		$user->hod = $request->hod;
		
		$date = $request->dob;
		$user->dob = date_format(date_create($date),"Y-m-d");
		
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->mobile = $request->mobile;
		//$user->phone = $request->phone;
		//$user->company_id = Auth::user()->company_id;
		if(Auth::user()->user_type==3)
    	{
    		$user->company_id = Auth::user()->company_id;
			$user->workshop_id = Auth::user()->workshop_id;
		}
		else
		{
			$user->company_id = $request->company;
			$user->workshop_id = $request->workshop;
		}
		//$user->location_id = $request->location;
		$user->user_type = $request->employee_type;
		$user->designation_id = $request->designation;
		$user->address = $request->address;
		$user->status = 1;
		$user->user_sys = \Request::ip();
		$user->updated_by = Auth::id();
		$user->created_by = Auth::id();
		$result = $user->save();
		
		
		if($result){
			return back()->with('success', 'Record added successfully!');
		}
		else{
			return back()->with('error', 'Something went wrong!');
		}
    }

    public function show($id)
    {
    	$users = User::find($id);
    	$employeetype = User::find($id)->EmployeeType; 
    	$workshop = User::find($id)->Workshop;
    	$designation = User::find($id)->Designation;
        return view('user.show')->with(array('users' => $users, 'employeetype' => $employeetype, 'workshop' => $workshop, 'designation' => $designation));
    }

    public function edit($id)
    {
        $users = User::find($id);
    	$companies = Company::all();
    	$workshops = Workshop::all()->where('id',$users->workshop_id);
    	//$locations = Location::all()->where('id',$users->location_id);
    	$designations = Designation::all();
        return view('user.edit')->with(array('users' => $users,'companies' => $companies, 'workshops' => $workshops, 'designations' => $designations));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'name' => 'required|string|max:255',
			'mobile'=>'required|max:255',
			'workshop'=>'required|max:255',
			'employee_type'=>'required|max:255'
		]);
		
		$user = User::find($id);
		if(empty($request->hod))
		$user->hod = 0;
		else
		$user->hod = $request->hod;
		
		$date = $request->dob;
		$user->dob = date_format(date_create($date),"Y-m-d");
		if(Auth::user()->user_type==3)
    	{
    		$user->company_id = Auth::user()->company_id;
			$user->workshop_id = Auth::user()->workshop_id;
		}
		else
		{
			$user->company_id = $request->company;
			$user->workshop_id = $request->workshop;
		}
		
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->mobile = $request->mobile;
		$user->workshop_id = $request->workshop;
		$user->location_id = $request->location;
		$user->user_type = $request->employee_type;
		$user->designation_id = $request->designation;
		$user->address = $request->address;
		$user->status = 1;
		$user->user_sys = \Request::ip();
		$user->updated_by = Auth::id();
		$result = $user->save();
		
		
		if($result){
			return back()->with('success', 'Record updated successfully!');
		}
		else{
			return back()->with('error', 'Something went wrong!');
		}
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $result = $users->delete($id);
        if($result){
			return redirect()->back()->with('success', 'Record deleted successfully!');
		}
		else{
			return redirect()->back()->with('error', 'Something went wrong!');
		}
    }
    
    public function id_ajax(Request $request)
    {
		$workshop_id = $request->id;
		$employee = User::where('workshop_id',$workshop_id)->get();
		print_r(json_encode($employee));
	}
}
