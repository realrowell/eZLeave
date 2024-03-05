<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeePosition;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function returns the employee profile page with data
     *
     * 
     * VIEW PROFILE
     */
    public function employee_profile(){
        $username = auth()->user()->user_name;
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();

        $user_full_name = $user->first_name." ".$user->middle_name." ".$user->last_name." ".optional($user->suffixes)->suffix_title;

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
        
        return view('profiles.employee.profile.user_profile',[
            'employees'=>$employees,
            'user' => $user,
            'length_of_service' => $length_of_service,
            'reports_to' => $reports_to,
            'user_full_name' => $user_full_name
        ]);
    }

    /**
     * this function is used to view the update user page
     *
     * 
     * VIEW UPDATE PROFILE EMPLOYEE
     */
    public function employee_profile_update_view(){
        $username = auth()->user()->user_name;
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

        return view('profiles.employee.profile.user_profile_edit',[
            'employees'=>$employees,
            'user' => $user,
            'reports_to' => $reports_to,
        ]);
        // return view('profiles.employee.profile.user_profile_edit');
    }

    /**
     * this function is used to update user information in database
     *
     * 
     * VIEW UPDATE PROFILE EMPLOYEE
     */
    public function employee_update_profile(Request $request){
        $user = User::where('id',auth()->user()->id)->get()->first();
        // dd($user['user_name']);
        $data = $request->validate([
            'user_name' => 'max:50|unique:users,user_name,'.$user['user_name'],
            'contact_number' => 'max:11',
            'password' => 'nullable|confirmed|min:6|max:255',
            'address_line_1' => 'sometimes|max:255',
            'address_city' => 'sometimes|max:255',
            'address_province' => 'sometimes|max:255',
            'address_region' => 'sometimes|max:255'
        ],[
            'user_name.unique' => 'The username has already been taken. Please try another one!',
            'user_name.max' => 'Username should not be more than :max  characters.',
            'contact_number.max' => ':attribute field should not exceed the max lenght of :max characters!',
        ]);
        
        $request['user_name'] = strip_tags($data['user_name']);
        $request['password'] = strip_tags($request['password']);
        $request['contact_number'] = strip_tags($request['contact_number']);
        $request['address_line_1'] = strip_tags($request['address_line_1']);
        $request['address_city'] = strip_tags($request['address_city']);
        $request['address_province'] = strip_tags($request['address_province']);
        $request['address_region'] = strip_tags($request['address_region']);

        if(!empty($request['address_line_1'])){
            if($user['address_id'] == null){
                $employee_address = EmployeeAddress::create([
                    'address_line_1' =>  $request['address_line_1'],
                    'city' => $request['address_city'],
                    'province' => $request['address_province'],
                    'region' => $request['address_region']
                ]);
                $message = 'User address has been updated!';
                $message_type = 'success';
            }
            else{
                $employee_address = EmployeeAddress::where('id',$user['address_id'])
                ->update([
                    'address_line_1' =>  $request['address_line_1'],
                    'city' => $request['address_city'],
                    'province' => $request['address_province'],
                    'region' => $request['address_region']
                ]);
                $message = 'User address has been updated!';
                $message_type = 'success';
            }
        }

        if(!empty($request['contact_number'])){
            $employee = Employee::where('user_id',$user['id'])
            ->update([
                'contact_number' => $request['contact_number']
            ]);
            $message = 'User details has been updated!';
            $message_type = 'success';
        }

        if(!empty($request['user_name']) && empty($request['password'])){
            $users = User::where('id', $user['id'])
            ->update([
                'user_name' => $request['user_name'],
            ]);
            $message = 'User account details has been updated!';
            $message_type = 'success';
        }
        elseif(empty($request['user_name']) && !empty($request['password'])){
            $users = User::where('id', $user['id'])
            ->update([
                'password' => Hash::make($request['password']),
            ]);
            $message = 'User account details has been updated!';
            $message_type = 'success';
        }
        elseif(!empty($request['user_name']) && !empty($request['password'])){
            $users = User::where('id', $user['id'])
            ->update([
                'user_name' => $request['user_name'],
                'password' => Hash::make($request['password']),
            ]);
            $message = 'User account details has been updated!';
            $message_type = 'success';
        }
        else{
            $message = 'No changes had been made to your account!';
            $message_type = 'info';
        }
        return redirect()->route('employee_profile')->with($message_type,$message);
    }
}
