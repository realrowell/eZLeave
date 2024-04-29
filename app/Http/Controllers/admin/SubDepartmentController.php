<?php

namespace App\Http\Controllers\admin;

use App\Models\SubDepartment;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    public function admin_organization_subdepartments_grid(){
        $subdepartments = Subdepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->paginate(12);
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.subdepartments_grid',compact('subdepartments'),
            ['departments' => $departments]
        );
    }
    public function admin_organization_subdepartments_list(){
        $subdepartments = Subdepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->get();
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.subdepartments_list',
            [
                'departments' => $departments,
                'subdepartments' => $subdepartments
            ]
        );
    }

    public function create_subdepartment(Request $request){
        $data = $request->validate([
            'subdepartment_title' => 'required|unique:sub_departments,sub_department_title',
            'dept_name' => 'required'
        ],[
            'subdepartment_title.unique' => 'The :attribute: :input is already available!',
        ]);
        $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);
        $data['dept_name'] = strip_tags($data['dept_name']);
        $subdepartments = SubDepartment::create([
            'sub_department_title' => $data['subdepartment_title'],
            'department_id' => $data['dept_name'],
        ]);
        return redirect()->back()->with('success','Sub-department has been created!');
    }

    public function update_subdepartment(Request $request, $id){
        if($request->filled('subdepartment_title') || $request->filled('dept_name')){
            $data = $request->validate([
                'subdepartment_title' => 'required',
                'dept_name' => 'required'
            ]);

            $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);
            $data['dept_name'] = strip_tags($data['dept_name']);

            $subdepartments = SubDepartment::where('id', $id)
            ->update([
                'sub_department_title' => $data['subdepartment_title'],
                'department_id' => $data['dept_name'],
            ]);
            return redirect()->back()->with('success','Sub-department has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_subdepartment($id){
        $subdepartments = SubDepartment::where('id', $id)
            ->update([
                'status_id' => ('sta-1009')
            ]);
            return redirect()->back()->with('warning','Sub-department has been deleted!');
    }
}
