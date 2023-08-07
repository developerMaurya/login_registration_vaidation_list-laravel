<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\userRegister;

class EmployeeController extends Controller
{
    // Display the login form
    public function login()
    {
        return view('welcome');
    }
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
public function handlelogin(Request $request)
{
    $allUsers = userRegister::orderBy('id', 'DESC')->get();
    $uemail = $request->email;
    $upassword = $request->password;

    foreach ($allUsers as $user) {
        $demail = $user->email;
        $dpassword = $user->password;
        $admintype = $user->utype;

        if ($demail == $uemail && $dpassword == $upassword) {
            // Store user's email in the session
            $request->session()->put('user_email', $uemail);

            if ($admintype == "Admin") {
                return redirect()->route('employees.index');
            } elseif ($admintype == "User") {
                return redirect()->route('homepage');
            } else {
                echo "Please wait, server problem. Try again later!";
            }
        }
    }

    return view('welcome')->withErrors(['email' => 'Invalid email and password']);
}


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // user registration 
    public function userRegistration(){
        return view('registration');
    }
    public function handleuserRegistration(Request $request){
        $validator=Validator::make($request->all(),[
            // 'email'=>['required',Rule::unique('userRegister','email')],
            'email'=>'required',
            'password'=>['required','min:5','max:100'],
            'address'=>'required',
            'zip'=>['required','max:7'],
            'utype'=>'required'
        ]);
        if($validator->passes()){
            $registerUser=new userRegister();
            $registerUser->email=$request->email;
            $registerUser->password=$request->password;
            // $registerUser->password=Hash::make($request->password);     // working 
            $registerUser->address=$request->address;
            $registerUser->zip=$request->zip;
            $registerUser->utype=$request->utype;
            $registerUser->save();
            return redirect()->route('employees.index');
        }else{
            return redirect()->route('userRegister')->withErrors($validator)->withInput();
        }
        
    }
    // show all data 
    public function index(){
        // $employees=Employee::orderBy('id','DESC')->get();  // working 
        $employees=Employee::orderBy('id','DESC')->paginate(5);
        $userEmail = session('user_email');
        echo $userEmail;
        return view('employee.list',['employees'=>$employees]);
    }
    // create
    public function create(){
        return view('employee.create');
    }
    // method for add employee
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'image'=>'sometimes|image:gif,png,jpeg,jpg',
        ]);
        if($validator->passes()){
            // new is use to create a new data
            $employee=new Employee();
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->address=$request->address;
            $employee->save();
            return redirect()->route('employees.index');
            // upload image here
            if($request->image){
                $ext=$request->image->getClientOriginalExtension();
                $newFileName=time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);  // save file in folder
                // update in db as image in image filed
                $employee->image=$newFileName;
                $employee->save();

                File::delete(public_path().'/uploads/employees/',$oldImage);
            }     

            $request->session()->flash('success','Employee added successfully.');

            return redirect()->route('employees.index');
        }else{
            // return with error
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }
    // Edit 

    public function edit($id){
        $employee=Employee::findORFail($id);
        
        return view('employee.edit',['employee'=>$employee]);
    }
    // update 

    public function update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'image'=>'sometimes|image:gif,png,jpeg,jpg',
        ]);
        if($validator->passes()){
            // check there is not use new becuse we update , not a create 
            $employee=Employee::find($id);
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->address=$request->address;
            $employee->save();

            // upload image here
            if($request->image){
                $oldImage=$employee->image;
                $ext=$request->image->getClientOriginalExtension();
                $newFileName=time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);  // save file in folder
                // update in db as image in image filed
                $employee->image=$newFileName;
                $employee->save();

                File::delete(public_path().'/uploads/employees/',$oldImage);
            }   

            $request->session()->flash('success','Employee updated successfully.');

            return redirect()->route('employees.index');
        }else{
            // return with error
            return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
        }
    }
    // delete
    public function destroy($id,Request $request){
        $employee=Employee::findOrFail($id);
        File::delete(public_path().'uploads/employees/'.$employee->image);
        $employee->delete();
        $request->session()->flash('success','Employee Deleted Successfully');
        return redirect()->route('employees.index');
    }
    // homepage
    public function homepage(){
        // To retrieve the user's email from the session
        $userEmail = session('user_email');
        echo $userEmail;
        return view('homepage');
    }
    // logout
    public function logout(Request $request){
        $request->session()->forget('user_email');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    // end
}
