<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AreaOfAssignment;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\HrStaff;
use App\Models\MaritalStatus;
use App\Models\Position;
use App\Models\PositionLevel;
use App\Models\ProfilePhoto;
use App\Models\Role;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN GRID
     */
    public function admin_accounts_grid(){
        $users = User::orderBy('last_name','asc')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.admin.account_management.accounts_grid_view',compact('users'))->with($data);
    }

    public function admin_visit_employee_view($username){
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first();

        // compute the total length of service
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired = new DateTime($user->employees->date_hired);
        $length_of_service = $current_date->diff($date_hired);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

        if($user->employees->employee_positions->reports_tos == null){
            $reports_to = "NONE";
        }
        else{
            $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
        }

        if($user->employees->employee_positions->second_reports_tos == null){
            $second_reports_to = "NONE";
        }
        else{
            $second_reports_to = optional(optional($user->employees->employee_positions->second_reports_tos)->users)->first_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->middle_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->last_name." ".
            optional(optional(optional($user->employees->employee_positions->second_reports_tos)->users)->suffixes)->suffix_title;
        }

        return view('profiles.admin.account_management.visit_employee_view',[
            'user'=>$user,
            'employees'=>$employees,
            'length_of_service' => $length_of_service,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
        ]);
    }

    public function admin_update_employee_view($username){
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();
        $user_reports_tos=Employee::with('employee_positions')->get();
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first();

        // dd($user_reports_to_name);

        if($user->employees->employee_positions->reports_tos == null){
            $reports_to = "NONE";
        }
        else{
            $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
        }

        if($user->employees->employee_positions->second_reports_tos == null){
            $second_reports_to = "NONE";
        }
        else{
            $second_reports_to = optional(optional($user->employees->employee_positions->second_reports_tos)->users)->first_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->middle_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->last_name." ".
            optional(optional(optional($user->employees->employee_positions->second_reports_tos)->users)->suffixes)->suffix_title;
        }

        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'user_reports_to_name' => optional($user->employees->employee_positions->reports_tos)->last_name.', '.
                                        optional($user->employees->employee_positions->reports_tos)->first_name,
        ];

        return view('profiles.admin.account_management.visit_employee_update_view',[
            'user'=>$user,
            'employees'=>$employees,
            'user_reports_tos' => $user_reports_tos,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
        ])->with($data);
    }

    public function admin_create_employee(Request $request){
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'nullable|max:50',
            'suffix' => 'nullable|max:8',
            'gender' => 'required',
            'marital_status' => 'required',
            'birthdate' => 'required|date',
            'date_hired' => 'date',
            'email' => 'unique:users|required|max:100',
            'user_name' => 'unique:users|required|max:50',
            'contact_number' => 'nullable|max:11',
            'position' => 'required',
            'sap_id_number' => 'unique:employees|required',
            'employee_status' => 'required',
            'area_of_assignment' => 'required',
        ],[
            'firstname.max','lastname.max','middlename.max',
            'email.max','user_name.max', 'contact_number.max'
                => ':attribute field should not exceed the max lenght of :max characters!',
            'firstname.required','lastname.required','gender.required',
            'marital_status.required','email.required',
            'user_name.required','position.required','sap_id_number.required',
            'employee_status.required','area_of_assignment.required'
                => ':attribute field should not leave blank',
        ]);

        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['suffix_id'] = strip_tags($data['suffix']);
        $data['gender'] = strip_tags($data['gender']);
        $data['marital_status'] = strip_tags($data['marital_status']);
        $data['birthdate'] = strip_tags($data['birthdate']);
        $data['date_hired'] = strip_tags($data['date_hired']);
        $data['email'] = strip_tags($data['email']);
        $data['user_name'] = strip_tags($data['user_name']);
        $data['contact_number'] = strip_tags($data['contact_number']);
        $data['position'] = strip_tags($data['position']);
        $data['sap_id_number'] = strip_tags($data['sap_id_number']);
        $data['employee_status'] = strip_tags($data['employee_status']);
        $data['area_of_assignment'] = strip_tags($data['area_of_assignment']);

        $birthdate_pass = new DateTime($data['birthdate']);
        $birthdate_pass = $birthdate_pass->format('mdY');
        // dd($data['sap_id_number']);

        $users = User::create([
            'first_name' => $data['firstname'],
            'middle_name' => $data['middlename'],
            'last_name' => $data['lastname'],
            'suffix_id' => $data['suffix'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'role_id' => 'rol-0003',
            'password' => Hash::make($birthdate_pass),
        ]);
        $employee_positions = EmployeePosition::create([
            'position_id' => $data['position'],
            'area_of_assignment_id' => $data['area_of_assignment'],
            'status_id' => 'sta-1007',
        ]);
        $employees = Employee::create([
            'user_id' => $users->id,
            'sap_id_number' => $data['sap_id_number'],
            'contact_number' => $data['contact_number'],
            'employee_position_id' => $employee_positions->id,
            'birthdate' => $data['birthdate'],
            'gender_id' => $data['gender'],
            'marital_status_id' => $data['marital_status'],
            'employment_status_id' => $data['employee_status'],
            'date_hired' => $data['date_hired'],
            'status_id' => 'sta-2001',
        ]);
        return redirect()->back()->with('success','Employee account has been created!');
    }

    public function admin_create_account(Request $request){
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'nullable|max:50',
            'suffix' => 'nullable|max:8',
            'email' => 'unique:users|required|max:100',
            'user_name' => 'unique:users|required|max:50',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
        ],[
            'firstname.max','lastname.max','middlename.max',
            'email.max','user_name.max'
                => ':attribute field should not exceed the max lenght of :max characters!',
            'password.min'
                => ':attribute field should have atleast :min characters!',
            'firstname.required','lastname.required','email.required',
            'user_name.required','password.required','role.required'
                => ':attribute field should not leave blank',
            'password.confirmed'
                =>'Confirmation password does not match with Password.'
        ]);

        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['suffix_id'] = strip_tags($data['suffix']);
        $data['role'] = strip_tags($data['role']);
        $data['email'] = strip_tags($data['email']);
        $data['user_name'] = strip_tags($data['user_name']);
        $data['password'] = strip_tags($data['password']);

        $users = User::create([
            'first_name' => $data['firstname'],
            'middle_name' => $data['middlename'],
            'last_name' => $data['lastname'],
            'suffix_id' => $data['suffix'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'role_id' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        if($users->role_id == 'rol-0001'){
            $admin = Admin::create([
                'user_id' => $users->id,
                'status_id' => 'sta-1007',
            ]);
        }
        elseif($users->role_id == 'rol-0002'){
            $hrstaff = HrStaff::create([
                'user_id' => $users->id,
                'status_id' => 'sta-1007',
            ]);
        }
        return redirect()->back()->with('success','Account has been created!');
    }

    public function admin_update_employee(Request $request, $user_id, $employee_id, $employee_position_id ){
        $user_name = User::where('id', $user_id)->get()->first();
        $employee = Employee::where('id', $employee_id)->get()->first();

        $data = $request->all();
        $data = $request->validate([
            'firstname' => 'sometimes|max:50',
            'lastname' => 'sometimes|max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'gender' => 'sometimes',
            'marital_status' => 'sometimes',
            'birthdate' => 'sometimes|date',
            'address_line1' => 'sometimes|max:100',
            'address_city' => 'sometimes|max:50',
            'address_province' => 'sometimes|max:50',
            'address_region' => 'sometimes|max:50',
            'contact_number' => 'required|max:11',
            'employment_status' => 'sometimes',
            'date_hired' => 'date|sometimes',
            'reports_to' => 'sometimes',
            'second_reports_to'=> 'sometimes',
            'position' => 'sometimes',
            'sap_id_number' => 'sometimes|unique:employees,sap_id_number,'.$employee->id,
            'area_of_assignment' => 'sometimes',
            'email' => 'nullable|email|max:100|unique:users,user_name,'.$user_name->user_name,
            'user_name' => 'unique:users|sometimes|max:50',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // dd($data['reports_to']);


        if($request->has('reports_tos')|| $request->has('second_reports_to')) {
            $employee_position = EmployeePosition::where('id', $employee_position_id)
                                                ->update([
                                                    'employee_id' => $user_name->employees->id,
                                                    'status_id' => 'sta-1006'
                                                ]);

            $employee_positions = EmployeePosition::create([
                'position_id' => $user_name->employees->employee_positions->positions->id,
                'area_of_assignment_id' => $user_name->employees->employee_positions->area_of_assignments->id,
                'reports_to_id' => $data['reports_to'],
                'second_superior_id' => $data['second_reports_to'],
            ]);
            $users = Employee::where('id',$user_name->employees->id)
                        ->update([
                            'employee_position_id' =>  $employee_positions->id,
                        ]);
            // dd($employee_position->id);
        }

        // if(!empty($request['firstname'])){
        //     $users = User::where('id',$user_id)
        //         ->update([
        //             'first_name' =>  $data['firstname'],
        //         ]);
        //     $message = 'User address has been updated!';
        //     $message_type = 'success';
        // }
        // if(!empty($request['middlename'])){
        //     $users = User::where('id',$user_id)
        //         ->update([
        //             'middle_name' =>  $data['middlename'],
        //         ]);
        //         $message = 'User address has been updated!';
        //         $message_type = 'success';
        // }
        // if(!empty($request['lastname'])){
        //     $users = User::where('id',$user_id)
        //         ->update([
        //             'last_name' =>  $data['lastname'],
        //         ]);
        //         $message = 'User address has been updated!';
        //         $message_type = 'success';
        // }
        // if(!empty($request['suffix'])){
        //     $users = User::where('id',$user_id)
        //         ->update([
        //             'suffix_id' =>  $data['suffix'],
        //         ]);
        //         $message = 'User address has been updated!';
        //         $message_type = 'success';
        // }
        return redirect()->to(route('admin_visit_employee_view',['username'=>$user_name['user_name']]))->with('success','User has been updated!');
    }

    public function update_profile_photo(Request $request, $user_name){
        $data = $request->validate([
            'profile_photo' => 'required',
        ]);
        $user = User::where('user_name',$user_name)->first();
        $user_profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->get()->first();

        if($user_profile_photo){
            $old_image = $user_profile_photo->profile_photo;
            Storage::delete('/public/images/profile_photos/'.$old_image);
            $user_profile_photo->delete();
        }
        // dd($user_profile_photo->profile_photo);

        $fileNameExt = $request->file('profile_photo')->getClientOriginalName();
        $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
        $fileExt = $request->file('profile_photo')->getClientOriginalExtension();
        $fileNameToStore = 'profile_photo.'.$fileName.'_'.time().'.'.$user_name.'.'.$fileExt;
        $pathToStore = $request->file('profile_photo')->storeAs('public/images/profile_photos', $fileNameToStore);

        $leaveapplication = ProfilePhoto::create([
            'profile_photo' => $fileNameToStore,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success','Profile photo has been updated!');
    }
}
