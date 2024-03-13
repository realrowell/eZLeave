<?php

namespace App\Http\Controllers;

use App\Models\AreaOfAssignment;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Position;
use App\Models\Role;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{



    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_employees_grid(){
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->orderBy('last_name','asc')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.hr_staff.employee_management.employees_grid_view',compact('users'))->with($data);
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_employees_list(){
        $users = User::where('status_id','sta-2001')->orderBy('last_name','asc')->paginate(15);
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.hr_staff.employee_management.employees_list_view',compact('users'))->with($data);
    }

    /**
     * SEARCH RESULT
     *
     *
     * SHOW EMPLOYEES SEARCH RESULT IN GRID
     */
    public function hrstaff_employee_management_employees_grid_search(Request $request){

        $input_search = explode(' ',$request->search_input,2);
        // dd($input_search);
        $last_name_input = implode($input_search);
        $data=[
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'users' => User::where('last_name','LIKE','%' .$last_name_input. '%')->orWhere('first_name','LIKE','%' .$last_name_input. '%')->get()
        ];

        return view('profiles.hr_staff.employee_management.employees_grid_view_search')->with($data);
    }

    /**
     * SEARCH RESULT
     *
     *
     * SHOW EMPLOYEES SEARCH RESULT IN LIST
     */
    public function hrstaff_employee_management_employees_list_search(Request $request){
        $input_search = explode(' ',$request->search_input,2);
        $last_name_input = implode($input_search);
        $data=[
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'users' => User::where('last_name','LIKE','%' .$last_name_input. '%')->orWhere('first_name','LIKE','%' .$last_name_input. '%')->get()
        ];
        return view('profiles.hr_staff.employee_management.employees_list_view_search')->with($data);
    }

    /**
     * REGULAR
     *
     *
     * SHOW REGULAR EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_regular_grid(){
        // $users = User::where('status_id','sta-2001')->orderBy('last_name','asc')->paginate(12);
        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0001')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.hr_staff.employee_management.employees_regular_grid_view',compact('users'))->with($data);
    }


    /**
     * REGULAR
     *
     *
     * SHOW REGULAR EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_regular_list(){

        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0001')->paginate(15);
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.hr_staff.employee_management.employees_regular_list_view',compact('users'))->with($data);
    }

    /**
     * PROBATIONARY
     *
     *
     * SHOW REGULAR EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_probationary_grid(){
        // $users = User::where('status_id','sta-2001')->orderBy('last_name','asc')->paginate(12);
        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0002')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.hr_staff.employee_management.employees_probi_grid_view',compact('users'))->with($data);
    }


    /**
     * PROBATIONARY
     *
     *
     * SHOW REGULAR EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_probationary_list(){

        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0002')->paginate(15);
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.hr_staff.employee_management.employees_probi_list_view',compact('users'))->with($data);
    }

    /**
     *
     *
     *
     * CREATE USER
     */
    public function create_user(Request $request){
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'gender' => 'required',
            'marital_status' => 'required',
            'birthdate' => 'required|date',
            'email' => 'unique:users|required|max:100',
            'user_name' => 'unique:users|required|max:50',
            'password' => 'required|min:8|max:255',
            'contact_number' => 'required|max:11',
            'position' => 'required',
            'subdepartment' => 'required',
            'employee_status' => 'required',
            'area_of_assignment' => 'required',
            'password' => 'required|confirmed|min:6',
            'role' => 'nullable'
        ],[
            'firstname.max','lastname.max','middlename.max',
            'email.max','user_name.max','password.max',
            'contact_number.max'
                => ':attribute field should not exceed the max lenght of :max characters!',
            'firstname.required','lastname.required','gender.required',
            'marital_status.required','birthdate.required','email.required',
            'user_name.required','contact_number.required','position.required',
            'employee_status.required','area_of_assignment.required',
            'password.required','subdepartment.required'
                => ':attribute field should not leave blank',
        ]);

        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['suffix_id'] = strip_tags($data['suffix']);
        $data['gender'] = strip_tags($data['gender']);
        $data['marital_status'] = strip_tags($data['marital_status']);
        $data['birthdate'] = strip_tags($data['birthdate']);
        $data['email'] = strip_tags($data['email']);
        $data['user_name'] = strip_tags($data['user_name']);
        $data['password'] = strip_tags($data['password']);
        $data['contact_number'] = strip_tags($data['contact_number']);
        $data['position'] = strip_tags($data['position']);
        $data['subdepartment'] = strip_tags($data['subdepartment']);
        $data['employee_status'] = strip_tags($data['employee_status']);
        $data['area_of_assignment'] = strip_tags($data['area_of_assignment']);

        if(auth()->user()->role_id == 'rol-0002'){
            $data['role'] = 'rol-0003'; //Assigning user as employee by default when creating from hrstaff account
        }

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

        $employee_positions = EmployeePosition::create([
            'position_id' => $data['position'],
            'subdepartment_id' => $data['subdepartment'],
            'area_of_assignment_id' => $data['area_of_assignment'],
            'status_id' => 'sta-1007',
        ]);
        $employees = Employee::create([
            'user_id' => $users->id,
            'contact_number' => $data['contact_number'],
            'employee_position_id' => $employee_positions->id,
            'birthdate' => $data['birthdate'],
            'gender_id' => $data['gender'],
            'marital_status_id' => $data['marital_status'],
            'employment_status_id' => $data['employee_status'],
            'status_id' => 'sta-2001',
        ]);
        return redirect()->back()->with('success','User has been created!');
    }

    /**
     *
     *
     *
     * UPDATE USER
     */
    public function update_user(Request $request, $user_id, $employee_id, $employee_position_id){
        $users_username = User::where('id',$user_id)->get()->first();
        // dd($users_username['id']);

        $data = $request->validate([
            'firstname' => 'max:50',
            'lastname' => 'max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'birthdate' => 'date',
            'email' => 'sometimes|email|max:100|unique:users,email,'.$user_id,
            'user_name' => 'max:50|unique:users,user_name,'.$users_username['id'],
            'contact_number' => 'max:11',
            'password' => 'nullable|confirmed|min:8|max:255',
            // 'password_confirmation' => 'nullable|confirmed',
            'position' => 'nullable',
            'subdepartment' => 'nullable',
            'area_of_assignment' => 'nullable',
            'reports_to' => 'nullable',
            'marital_status' => 'nullable',
            'employment_status' => 'nullable'
        ],[
            'firstname.max','lastname.max','middlename.max',
            'email.max','user_name.max','password.max',
            'contact_number.max'
                => ':attribute field should not exceed the max lenght of :max characters!',
        ]);

        // dd($data);

        $request['firstname'] = strip_tags($request['firstname']);
        $request['lastname'] = strip_tags($request['lastname']);
        $request['middlename'] = strip_tags($request['middlename']);
        $request['suffix_id'] = strip_tags($request['suffix']);
        $request['gender'] = strip_tags($request['gender']);
        $request['marital_status'] = strip_tags($request['marital_status']);
        $request['birthdate'] = strip_tags($request['birthdate']);
        $request['email'] = strip_tags($request['email']);
        $request['user_name'] = strip_tags($data['user_name']);
        $request['password'] = strip_tags($request['password']);
        $request['contact_number'] = strip_tags($request['contact_number']);
        $request['position'] = strip_tags($request['position']);
        $request['subdepartment'] = strip_tags($request['subdepartment']);
        $request['employment_status'] = strip_tags($request['employment_status']);
        $request['area_of_assignment'] = strip_tags($request['area_of_assignment']);
        $request['date_hired'] = strip_tags($request['date_hired']);
        $request['reports_to'] = strip_tags($request['reports_to']);

        // dd($request);

        $users = User::where('id', $user_id)
            ->update([
                'first_name' => $request['firstname'],
                'middle_name' => $request['middlename'],
                'last_name' => $request['lastname'],
                'suffix_id' => $request['suffix'],
                'email' => $request['email'],
                'user_name' => $request['user_name'],
                'password' => Hash::make($request['password']),
            ]);

        $new_user_name = User::where('user_name', $request['user_name'])->get()->first();
        $employee_positions = EmployeePosition::where('id', $employee_position_id)->get()->first();
        $new_employee_position = EmployeePosition::where('id', $employee_position_id)->get()->first();
        // dd($data['subdepartment']);

        // if($request->has('position') && !empty($request->input('position'))){
        //     $employee_positions = EmployeePosition::where('id', $employee_position_id)
        //     ->update([
        //         'employee_id' => $users_username->employees->id,
        //         'status_id' => 'sta-1006',
        //     ]);
        //     if($request->has('area_of_assignment') && !empty($request->input('area_of_assignment'))){
        //         // dd('the field has position and area of assignment');
        //         $employee_positions = EmployeePosition::create([
        //                 'position_id' => $data['position'],
        //                 'subdepartment_id' => $data['subdepartment'],
        //                 'area_of_assignment_id' => $data['area_of_assignment'],
        //                 'status_id' => 'sta-1007',
        //             ]);
        //     }
        //     else{
        //         // dd($data['subdepartment']);
        //         $employee_positions = EmployeePosition::create([
        //             'position_id' => $data['position'],
        //             'subdepartment_id' => $data['subdepartment'],
        //             'area_of_assignment_id' => $new_employee_position['area_of_assignment_id'],
        //             'status_id' => 'sta-1007',
        //         ]);
        //     }
        // }
        // elseif($request->has('subdepartment') && !empty($request->input('subdepartment'))){
        //     $employee_positions = EmployeePosition::where('id', $employee_position_id)
        //     ->update([
        //         'employee_id' => $users_username->employees->id,
        //         'status_id' => 'sta-1006',
        //     ]);
        //     $employee_positions = EmployeePosition::create([
        //         'position_id' => $new_employee_position['position_id'],
        //         'subdepartment_id' => $data['subdepartment'],
        //         'status_id' => 'sta-1007',
        //     ]);
        // }
        // elseif($request->has('area_of_assignment') && !empty($request->input('area_of_assignment'))){
        //     $employee_positions = EmployeePosition::where('id', $employee_position_id)
        //     ->update([
        //         'employee_id' => $users_username->employees->id,
        //         'status_id' => 'sta-1006',
        //     ]);
        //     $employee_positions = EmployeePosition::create([
        //         'position_id' => $new_employee_position['position_id'],
        //         'subdepartment_id' => $data['subdepartment'],
        //         'area_of_assignment_id' => $data['area_of_assignment'],
        //         'status_id' => 'sta-1007',
        //     ]);
        // }

        // if($request->has('position') && $request->has('subdepartment') && $request->has('area_of_assignment')){
        //     dd($request['position'],$request['subdepartment'],$request['area_of_assignment']);
        // }
        // if(!empty($request->input('position')) || !empty($request->input('subdepartment')) || !empty($request->input('area_of_assignment'))){
        //     // dd();
        //     if(!empty($request->input('position'))){
        //         dd($request['position']);
        //     }
        //     elseif(!empty($request->input('subdepartment'))){
        //         dd($request['subdepartment']);
        //     }
        //     elseif(!empty($request->input('area_of_assignment'))){
        //         dd($request['area_of_assignment']);
        //     }
        // }

        // if(!empty($request->input('position')) || !empty($request->input('subdepartment')) || !empty($request->input('area_of_assignment'))){
        //     $employee_positions = EmployeePosition::where('id', $employee_position_id)
        //     ->update([
        //         'employee_id' => $users_username->employees->id,
        //         'designation_description' => 'sta-1006',
        //         'position_id' => $request['subdepartment'],
        //         'subdepartment_id' => $request['subdepartment'],
        //         'area_of_assignment_id' => $request['subdepartment'],
        //         'reports_to_id' => $request['subdepartment'],
        //         'position_designation_id' => $request['subdepartment'],
        //         // 'status_id' => 'sta-1006',
        //     ]);
        // }
        switch(!empty($request->input('position')) || !empty($request->input('subdepartment')) || !empty($request->input('area_of_assignment')) || !empty($request->input('reports_to'))){
        // switch(isset($request->position) || isset($request->subdepartment) || isset($request->area_of_assignment) || isset($request->reports_to)){
            case isset($request->position):
                $employee_positions = EmployeePosition::where('id', $employee_position_id)
                ->update([
                    'employee_id' => $users_username->employees->id,
                    'status_id' => 'sta-1006',
                ]);
                if(!empty($request->input('area_of_assignment'))){
                    if(!empty($request->input('subdepartment'))){
                        if(!empty($request->input('reports_to'))){
                            $employee_positions = EmployeePosition::create([
                                'position_id' => $data['position'],
                                'subdepartment_id' => $data['subdepartment'],
                                'area_of_assignment_id' => $data['area_of_assignment'],
                                'reports_to_id' => $data['reports_to_id'],
                                'status_id' => 'sta-1007',
                            ]);
                        }
                        else{
                            $employee_positions = EmployeePosition::create([
                                'position_id' => $data['position'],
                                'subdepartment_id' => $data['subdepartment'],
                                'area_of_assignment_id' => $data['area_of_assignment'],
                                'reports_to_id' => $new_employee_position['reports_to_id'],
                                'status_id' => 'sta-1007',
                            ]);
                        }
                    }
                    elseif(!empty($request->input('reports_to'))){
                        $employee_positions = EmployeePosition::create([
                            'position_id' => $data['position'],
                            'subdepartment_id' => $new_employee_position['subdepartment_id'],
                            'area_of_assignment_id' => $data['area_of_assignment'],
                            'reports_to_id' => $data['reports_to'],
                            'status_id' => 'sta-1007',
                        ]);
                    }
                    else{
                        $employee_positions = EmployeePosition::create([
                            'position_id' => $data['position'],
                            'subdepartment_id' => $new_employee_position['subdepartment_id'],
                            'area_of_assignment_id' => $data['area_of_assignment'],
                            'reports_to_id' => $new_employee_position['reports_to_id'],
                            'status_id' => 'sta-1007',
                        ]);
                    }
                }
                elseif(!empty($request->input('subdepartment'))){
                    if(!empty($request->input('reports_to'))){
                        $employee_positions = EmployeePosition::create([
                            'position_id' => $data['position'],
                            'subdepartment_id' => $data['subdepartment'],
                            'area_of_assignment_id' => $new_employee_position['area_of_assignment_id'],
                            'reports_to_id' => $data['reports_to'],
                            'status_id' => 'sta-1007',
                        ]);
                    }
                    else{
                        $employee_positions = EmployeePosition::create([
                            'position_id' => $data['position'],
                            'subdepartment_id' => $data['subdepartment'],
                            'area_of_assignment_id' => $new_employee_position['area_of_assignment_id'],
                            'reports_to_id' => $new_employee_position['reports_to_id'],
                            'status_id' => 'sta-1007',
                        ]);
                    }

                }
                elseif(!empty($request->input('reports_to'))){
                    $employee_positions = EmployeePosition::create([
                        'position_id' => $data['position'],
                        'subdepartment_id' => $new_employee_position['subdepartment_id'],
                        'area_of_assignment_id' => $new_employee_position['area_of_assignment_id'],
                        'reports_to_id' => $data['reports_to'],
                        'status_id' => 'sta-1007',
                    ]);
                }
                else{
                    $employee_positions = EmployeePosition::create([
                        'position_id' => $data['position'],
                        'subdepartment_id' => $new_employee_position['subdepartment_id'],
                        'area_of_assignment_id' => $new_employee_position['area_of_assignment_id'],
                        'reports_to_id' => $new_employee_position['reports_to_id'],
                        'status_id' => 'sta-1007',
                    ]);
                }
                // dd('pos', $request['position']);
                break;
            case isset($request->subdepartment):
                dd('sub', $request['subdepartment']);
                break;
            case isset($request->area_of_assignment):
                dd('ar', $request['area_of_assignment']);
                break;
            case isset($request->reports_to):
                dd('re', $request['reports_to']);
                break;
            default:
                break;
        }


        $employees = Employee::where('id', $employee_id)
            ->update([
                'contact_number' => $request['contact_number'],
                'employee_position_id' => $employee_positions->id,
                'birthdate' => $request['birthdate'],
                'gender_id' => $request['gender'],
                'marital_status_id' => $request['marital_status'],
                'employment_status_id' => $request['employment_status'],
            ]);
        return redirect()->to('/hr/user/profile/'.$new_user_name['user_name'])->with('success','User has been updated!');

    }

    public function delete_user($id){

    }


    public function visit_profile_view($username){
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();

        // compute the total length of service
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired = new DateTime($user->employees->date_hired);
        $length_of_service = $current_date->diff($date_hired);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

        $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
        if (empty($reports_to)){
            $reports_to = "NONE";
        }

        return view('profiles.hr_staff.employee_management.visit_user_view',[
            'user'=>$user,
            'employees'=>$employees,
            'length_of_service' => $length_of_service,
            'reports_to' => $reports_to,
        ]);
    }

    public function visit_profile_update($username){
        $user=User::where('user_name',$username)->get()->first();
        $user_reports_tos=Employee::with('employee_positions')->get();

        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
        ];
        // dd($user);
        $employees=Employee::all();
        return view('profiles.hr_staff.employee_management.visit_user_update',[
            'user'=>$user,
            'employees'=>$employees,
            'user_reports_tos' => $user_reports_tos
        ])->with($data);
    }
}
