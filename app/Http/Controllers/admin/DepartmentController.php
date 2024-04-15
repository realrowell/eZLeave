<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SubDepartment;
use App\Models\EmployeePosition;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    public function admin_organization_departments_grid(){
        $subdepartments = SubDepartment::all()->where('status_id','sta-1007'); //only active sub departments
        $departments = Department::where('status_id','sta-1007')->orderBy('department_title','asc')->get();
        $employees = Employee::all()->where('status_id','sta-2001');
        // dd($subdepartment_counts);
        return view('profiles.admin.organization.departments_grid',
            [
                'departments' => $departments,
                'subdepartments' => $subdepartments,
                'employees' => $employees,
            ]
        );
    }

    public function admin_organization_departments_list(){
        $departments = Department::where('status_id','sta-1007')->orderBy('department_title','asc')->get();
        return view('profiles.admin.organization.departments_list',
            ['departments' => $departments]
        );
    }

    public function create_department(Request $request){
        $data = $request->validate([
            'department_title' => 'required|max:50|unique:departments,department_title'
        ],[
            'department_title.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'department_title.unique' => 'The :attribute: :input is already available!',
        ]);

        $data['department_title'] = strip_tags($request['department_title']);
        $departments = Department::create([
            'department_title' => $data['department_title']
        ]);
        return redirect()->back()->with('success','Department has been created!');
    }

    public function update_department(Request $request, $id){

        if($request->filled('department_title')){
            $data = $request->validate([
                'department_title' => 'required|max:50'
            ],[
                'department_title.max' => ':attribute field should not exceed the max lenght of :max characters!',
            ]);

            $data['department_title'] = strip_tags($data['department_title']);
                $department = Department::where('id', $id)
                ->update([
                    'department_title' => $data['department_title']
                ]);
                return redirect()->back()->with('success','Department has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_department($id){
        $department = Department::where('id', $id)
            ->update([
                'status_id' => ('sta-1009')
            ]);
            return redirect()->back()->with('warning','Department has been deleted!');
    }



}
