<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AreaOfAssignment;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeePosition;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\HrStaff;
use App\Models\MaritalStatus;
use App\Models\Notification;
use App\Models\Position;
use App\Models\ProfilePhoto;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\Email;

class AccountManagementController extends Controller
{
    /***
     *
     *
     *
     * CREATE EMPLOYEE ACCOUNT
     */
    public function admin_create_employee(Request $request){
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'nullable|max:50',
            'suffix' => 'nullable|max:8',
            'gender' => 'required',
            'marital_status' => 'required',
            'birthdate' => 'required|date',
            'date_hired' => 'required|date',
            'email' => 'unique:users|required|max:100',
            'user_name' => 'unique:users|required|max:50',
            'contact_number' => 'nullable|max:11',
            'position' => 'required',
            'sap_id_number' => 'nullable',
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

    /***
     *
     *
     *
     * CREATE ADMIN / HRSTAFF ACCOUNT
     */
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


    /***
     *
     *
     *
     * UPDATE EMPLOYEE ACCOUNT
     */
    public function admin_update_employee(Request $request, $user_id, $employee_id ){
        $user_name = User::where('id', $user_id)->get()->first();
        $employee = Employee::where('id', $employee_id)->get()->first();
        $employee_position_id = $user_name->employees->employee_position_id;

        // dd($employee_position_id);
        // $employee_address = EmployeeAddress::where('employee_id', $employee_id)->where('status_id','sta-1007')->get()->first();

        $data = $request->all();
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'gender' => 'required',
            'marital_status' => 'required',
            'birthdate' => 'required|date',
            'address_line_1' => 'sometimes|max:100',
            'address_city' => 'sometimes|max:50',
            'address_province' => 'sometimes|max:50',
            'address_region' => 'sometimes|max:50',
            'contact_number' => 'nullable|max:11',
            'employment_status' => 'required',
            'date_hired' => 'nullable',
            'reports_to' => 'sometimes',
            'second_reports_to'=> 'sometimes',
            'position' => 'required',
            'sap_id_number' => 'nullable',
            'area_of_assignment' => 'required',
            'email' => 'required|email|max:100|unique:users,email,'.$user_name->id,
            'user_name' => 'required|max:50|unique:users,user_name,'.$user_name->id,
            'password' => 'nullable|min:8|confirmed',
        ]);



        $redirect_message = '';
        $redirect_message_type = '';

        if($request['firstname'] != null || $request['lastname'] != null) {
            if($request['firstname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $employee_save = Employee::where('user_id', $user_name->id)
                    ->update([
                    'gender_id' => $data['gender'],
                    'marital_status_id' => $data['marital_status'],
                    'birthdate'=> $data['birthdate'],
                    'contact_number'=> $data['contact_number'],
                    'employment_status_id'=> $data['employment_status'],
                    'date_hired'=> $data['date_hired'],
                    'sap_id_number'=> $data['sap_id_number'],
                    ]);
                $redirect_message = 'User information has been updated! Last name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['lastname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $employee_save = Employee::where('user_id', $user_name->id)
                    ->update([
                    'gender_id' => $data['gender'],
                    'marital_status_id' => $data['marital_status'],
                    'birthdate'=> $data['birthdate'],
                    'contact_number'=> $data['contact_number'],
                    'employment_status_id'=> $data['employment_status'],
                    'date_hired'=> $data['date_hired'],
                    'sap_id_number'=> $data['sap_id_number'],
                    ]);
                $redirect_message = 'User information has been updated! First name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['firstname'] != null && $request['lastname'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $employee_save = Employee::where('user_id', $user_name->id)
                    ->update([
                    'gender_id' => $data['gender'],
                    'marital_status_id' => $data['marital_status'],
                    'birthdate'=> $data['birthdate'],
                    'contact_number'=> $data['contact_number'],
                    'employment_status_id'=> $data['employment_status'],
                    'date_hired'=> $data['date_hired'],
                    'sap_id_number'=> $data['sap_id_number'],
                    ]);
                $redirect_message = 'User information has been updated!';
                $redirect_message_type = 'success';
            }
        }
        if($request['firstname'] == null && $request['lastname'] == null){
            $users = User::where('id', $user_name->id)
                ->update([
                'middle_name' => $data['middlename'],
                'suffix_id' => $data['suffix'] ,
                ]);
            $employee_save = Employee::where('user_id', $user_name->id)
                ->update([
                'gender_id' => $data['gender'],
                'marital_status_id' => $data['marital_status'],
                'birthdate'=> $data['birthdate'],
                'contact_number'=> $data['contact_number'],
                'employment_status_id'=> $data['employment_status'],
                'date_hired'=> $data['date_hired'],
                'sap_id_number'=> $data['sap_id_number'],
                ]);
            $redirect_message = ' First name and Last name fields are cannot be null! We revert this fields';
            $redirect_message_type = 'warning';
        }

        //
        // UPDATE ADDRESS
        //
        // updating user address
        //
        if($request['address_line_1'] != null){
            if($user_name->employees->address_id == null){
                if($request['address_city'] == null || $request['address_province'] == null || $request['address_region'] == null){
                    $redirect_message = $redirect_message.' - CITY, PROVINCE, and REGION fields must not be null';
                    $redirect_message_type = 'error';
                }
                if($request['address_city'] != null && $request['address_province'] != null){
                    $employee_address_save = EmployeeAddress::create([
                        'address_line_1' => $data['address_line_1'],
                        'city' => $data['address_city'],
                        'province' => $data['address_province'],
                        'region' => $data['address_region'],
                    ]);
                    $employees = Employee::where( 'id', $user_name->employees->id )
                        ->update(['address_id'=>$employee_address_save->id
                    ]);
                    $redirect_message = 'Employee Address has been updated.';
                    $redirect_message_type = 'success';
                }
            }
            else{
                if($request['address_city'] == null || $request['address_province'] == null || $request['address_region'] == null){
                    $redirect_message = $redirect_message.'<li>- CITY, PROVINCE, and REGION fields must not be null</li> ';
                    $redirect_message_type = 'error';
                }
                if($request['address_city'] != null && $request['address_province'] != null){
                    $employee_address_save = EmployeeAddress::where('id', $user_name->employees->address_id)
                        ->update([
                            'status_id'     => 'sta-1006',
                    ]);
                    $employee_address_save = EmployeeAddress::create([
                        'address_line_1' => $data['address_line_1'],
                        'city' => $data['address_city'],
                        'province' => $data['address_province'],
                        'region' => $data['address_region'],
                    ]);
                    $employees = Employee::where( 'id', $user_name->employees->id )
                        ->update(['address_id'=>$employee_address_save->id
                    ]);
                    $redirect_message = 'Employee Address has been updated.';
                    $redirect_message_type = 'success';
                }

            }
        }

        if($employee_position_id == null){
            if($request['position'] != null || $request['area_of_assignment' != null]){
                if($request['reports_to'] != null && $request['second_reports_to'] == null){
                    $employee_positions = EmployeePosition::create([
                        'reports_to_id' => $data['reports_to'],
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
                    $employees = Employee::where( 'id', $user_name->employees->id )
                        ->update(['employee_position_id'=>$employee_positions->id
                    ]);
                }
                elseif($request['reports_to'] == null && $request['second_reports_to'] != null){
                    $employee_positions = EmployeePosition::create([
                        'second_superior_id' => $data['second_reports_to'],
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
                    $employees = Employee::where( 'id', $user_name->employees->id )
                        ->update(['employee_position_id'=>$employee_positions->id
                    ]);
                }
                elseif($request['reports_to'] == null && $request['second_reports_to'] == null){
                    $employee_positions = EmployeePosition::create([
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
                    $employees = Employee::where( 'id', $user_name->employees->id )
                        ->update(['employee_position_id'=>$employee_positions->id
                    ]);
                }
            }
        }

        if($request['reports_to'] != null || $request['second_reports_to'] != null || $request['position'] != null || $request['area_of_assignment']){
            if($request['reports_to'] != null){
                $employee_positions = EmployeePosition::where('id',$employee_position_id)
                    ->update([
                        'reports_to_id' => $data['reports_to'],
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
            }
            if($request['second_reports_to'] != null){
                $employee_positions = EmployeePosition::where('id',$employee_position_id)
                    ->update([
                        'second_superior_id' => $data['second_reports_to'],
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
            }
        }

        if($request['position'] != null || $request['area_of_assignment'] != null){
            $employee_positions = EmployeePosition::where('id',$employee_position_id)
                    ->update([
                        'position_id' => $data['position'],
                        'area_of_assignment_id' => $data['area_of_assignment'],
                    ]);
        }

        if($request['second_reports_to'] == null){
            $employee_positions = EmployeePosition::where('id',$employee_position_id)
                ->update([
                    'second_superior_id' => $data['second_reports_to'],
                ]);
        }

        if($request->has('email') || $request->has('user_name')){
            if($request['user_name'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'user_name' => $data['user_name'],
                    ]);
            }

            $users = User::where('id', $user_name->id)
                    ->update([
                    'email' => $data['email']
                    ]);
        }
        if($request['password'] != null){
            $users = User::where('id', $user_name->id)
                ->update([
                'password' => Hash::make($data['password'])
                ]);
        }


        $redirect_message_type = 'success';
        $redirect_message = 'Account has updated succesfully';

        Log::notice('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' has successfully update User: '.$user_name->id.' | '.$user_name->first_name.$user_name->middle_name.$user_name->last_name);

        if(auth()->user()->role_id == 'rol-0001'){
            return redirect()->to(route('admin_visit_employee_view',['username'=>$data['user_name']]))->with($redirect_message_type,$redirect_message);

        }
        elseif(auth()->user()->role_id == 'rol-0002'){
            return redirect()->to(route('user_profile',['username'=>$data['user_name']]))->with($redirect_message_type,$redirect_message);
        }
        else{
            return redirect(route('index'))->with('warning','Something went wrong. Please contact your Administrator');
        }
    }

    /***
     *
     *
     *
     * UPDATE PROFILE PHOTO
     */
    public function update_profile_photo(Request $request, $user_name){
        $data = $request->validate([
            'profile_photo' => 'max:2048|required|image',
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

    /***
     *
     *
     *
     * EMPLOYEE RESET PASSWORD
     */
    public function account_reset_password($username){
        $user = User::where('user_name',$username)->first();

        $users = User::where( 'id', $user->id )
            ->update([
                'password' => Hash::make(Carbon::parse($user->employees->birthdate)->isoFormat('MMDDY'))
        ]);
        $notifications = Notification::create([
            'title' => 'Your Password has been Reset!',
            'subject' => 'If you did not make the request, please contact your System Admin immediately!',
            'body' => null,
            'notification_type_id' => 'nt-1001',
            'author_id' => auth()->user()->id,
            'employee_id' => $user->id,
        ]);

        return redirect()->back()->with('success','Password has been reset succefully!');
    }

    /***
     *
     *
     *
     * ACCOUNT RESET PASSWORD
     */
    public function admin_account_reset_password($username){
        $user = User::where('user_name',$username)->first();

        $users = User::where( 'id', $user->id )
            ->update([
                'password' => Hash::make($user->email)
        ]);

        return redirect()->back()->with('success','Password has been reset succefully!');
    }

    /***
     *
     *
     *
     * ACCOUNT RESET PASSWORD
     */
    public function account_deactivate($username){
        $user = User::where('user_name',$username)->first();

        $users = User::where( 'id', $user->id )
            ->update([
                'status_id' => 'sta-2002'
        ]);

        return redirect()->back()->with('warning','Account has Deactivated!');
    }

    /***
     *
     *
     *
     * ACCOUNT RESET PASSWORD
     */
    public function account_activate($username){
        $user = User::where('user_name',$username)->first();

        $users = User::where( 'id', $user->id )
            ->update([
                'status_id' => 'sta-2001'
        ]);

        return redirect()->back()->with('success','Account has Activate succefully!');
    }

    /***
     *
     *
     *
     * UPDATE ADMIN / HRSTAFF ACCOUNT
     */
    public function update_admin_account(Request $request, $username, Exception $e){
        $user_name = User::where('user_name', $username)->get()->first();

        $data = $request->all();
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'email' => 'required|email|max:100|unique:users,email,'.$user_name->id,
            'user_name' => 'required|max:50|unique:users,user_name,'.$user_name->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if($request['firstname'] != null || $request['lastname'] != null) {
            if($request['firstname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated! Last name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['lastname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated! First name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['firstname'] != null && $request['lastname'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated!';
                $redirect_message_type = 'success';
            }
        }
        if($request['firstname'] == null && $request['lastname'] == null){
            $users = User::where('id', $user_name->id)
                ->update([
                'middle_name' => $data['middlename'],
                'suffix_id' => $data['suffix'] ,
                ]);
            $redirect_message = ' First name and Last name fields are cannot be null! We revert this fields';
            $redirect_message_type = 'warning';
        }

        if($request->has('email') || $request->has('user_name')){
            if($request['user_name'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'user_name' => $data['user_name'],
                    ]);
            }
            if($request['Email'] != null){
                $users = User::where('id', $user_name->id)
                        ->update([
                        'email' => $data['email']
                        ]);
            }
        }
        if($request['password'] != null){
            $users = User::where('id', $user_name->id)
                ->update([
                'password' => Hash::make($data['password'])
                ]);
        }
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->back()->withInput()->with('token', csrf_token());
        }
        return redirect()->to(route('admin_visit_account_view',['username'=>$user_name['user_name']]))->with($redirect_message_type,$redirect_message);
    }

    /***
     *
     *
     *
     * UPDATE ADMIN / HRSTAFF ACCOUNT
     */
    public function update_admin_profile(Request $request, Exception $e){
        $user_name = User::where('user_name', auth()->user()->user_name)->get()->first();

        $data = $request->all();
        $data = $request->validate([
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'max:50',
            'suffix' => 'max:8',
            'email' => 'required|email|max:100|unique:users,email,'.$user_name->id,
            'user_name' => 'required|max:50|unique:users,user_name,'.$user_name->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if($request['firstname'] != null || $request['lastname'] != null) {
            if($request['firstname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated! Last name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['lastname'] != null){
                $user_save = User::where('id', $user_name->id)
                    ->update([
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated! First name must not be null!';
                $redirect_message_type = 'success';
            }
            if($request['firstname'] != null && $request['lastname'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'first_name' => $data['firstname'],
                    'last_name' => $data['lastname'],
                    'middle_name' => $data['middlename'],
                    'suffix_id' => $data['suffix'] ,
                    ]);
                $redirect_message = 'User information has been updated!';
                $redirect_message_type = 'success';
            }
        }
        if($request['firstname'] == null && $request['lastname'] == null){
            $users = User::where('id', $user_name->id)
                ->update([
                'middle_name' => $data['middlename'],
                'suffix_id' => $data['suffix'] ,
                ]);
            $redirect_message = ' First name and Last name fields are cannot be null! We revert this fields';
            $redirect_message_type = 'warning';
        }

        if($request->has('email') || $request->has('user_name')){
            if($request['user_name'] != null){
                $users = User::where('id', $user_name->id)
                    ->update([
                    'user_name' => $data['user_name'],
                    ]);
            }
            if($request['Email'] != null){
                $users = User::where('id', $user_name->id)
                        ->update([
                        'email' => $data['email']
                        ]);
            }
        }
        if($request['password'] != null){
            $users = User::where('id', $user_name->id)
                ->update([
                'password' => Hash::make($data['password'])
                ]);
        }
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->back()->withInput()->with('token', csrf_token());
        }

        if(auth()->user()->role_id == 'rol-0001'){
            return redirect()->to(route('admin_profile'))->with($redirect_message_type,$redirect_message);
        }
        elseif(auth()->user()->role_id == 'rol-0002'){
            return redirect()->to(route('hrstaff_profile'))->with($redirect_message_type,$redirect_message);
        }
        else{
            return redirect(route('index'))->with('warning','Something went wrong. Please contact your Administrator');
        }

    }

    public function GetSubdepartmentFromDepartment($id){
        $subdepartments = SubDepartment::where('department_id',$id)->where('status_id','sta-1007')->get();
        echo json_encode($subdepartments);
    }

    public function GetPositionFromSubdepartment($id){
        $positions = Position::where('subdepartment_id',$id)->where('status_id','sta-1007')->get();
        echo json_encode($positions);
    }

    public function GetReportsToFromPosition($id){
        $positions = Position::where('subdepartment_id',$id)->where('status_id','sta-1007')->get();
        echo json_encode($positions);
    }
}
