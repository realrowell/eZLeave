<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function admin_organization_departments_grid(){
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.departments_grid',
            ['departments' => $departments]
        );
    }
    public function admin_organization_departments_list(){
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.departments_list',
            ['departments' => $departments]
        );
    }

    public function create_department(Request $request){
        $data = $request->validate([
            'department_title' => 'required|max:50'
        ],[
            'department_title.max' => ':attribute field should not exceed the max lenght of :max characters!',
        ]);
        
        $data['department_title'] = strip_tags($request['department_title']);
        $departments = Department::create([
            'department_title' => $data['department_title']
        ]);
        return redirect()->back()->with('success','Department has been created!');
    }

    public function update_department(Request $request, $id){
        $data = $request->validate([
            'department_title' => 'required|max:50'
        ],[
            'department_title.max' => ':attribute field should not exceed the max lenght of :max characters!',
        ]);

        $data['department_title'] = strip_tags($data['department_title']);
        if($request->filled('department_title')){
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
                'status_id' => ('sta-1006')
            ]);
            return redirect()->back()->with('warning','Department has been deleted!');
    }

    
    
}
