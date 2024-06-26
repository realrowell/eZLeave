<?php

namespace App\Http\Controllers\admin;

use App\Models\AreaOfAssignment;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeePosition;

class AreaOfAssignmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    public function admin_organization_areaofassignemnts_grid(){

        $area_of_assignments = AreaOfAssignment::all()->where('status_id','sta-1007');
        $system_settings = SystemSetting::latest('id')->first();
        // dd($system_settings);
        return view('profiles.admin.organization.area_of_assignments_grid',
            ['area_of_assignments' => $area_of_assignments],
            ['system_settings' => $system_settings]
        );
    }
    public function admin_organization_areaofassignemnts_list(){
        $area_of_assignments = AreaOfAssignment::all()->where('status_id','sta-1007');
        $system_settings = SystemSetting::latest('id')->first();

        return view('profiles.admin.organization.area_of_assignments_list',
            ['area_of_assignments' => $area_of_assignments],
            ['system_settings' => $system_settings]
        );
    }

    public function admin_organization_areaofassignemnts_profile($id){
        $area_of_assignments = AreaOfAssignment::find($id);
        $system_settings = SystemSetting::latest('id')->first();
        $employee_positions = EmployeePosition::where('area_of_assignment_id',$area_of_assignments->id)->get();
        $employees = Employee::where('status_id','sta-2001')->get();

        $data = [
            'area_of_assignments' => $area_of_assignments,
            'system_settings' => $system_settings,
            'employees' => $employees,
            'employee_positions' => $employee_positions,
        ];

        return view('profiles.admin.organization.area_of_assignments_profile')->with($data);
    }

    public function create_area_of_assignments(Request $request){
        $data = $request->validate([
            'location_address' => 'required|max:100|unique:area_of_assignments,location_address',
            'location_desc' => 'required|max:300',
            'embedmap' => 'max:1000'
        ],[
            'location_address.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'location_desc.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'embedmap.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'location_address.unique' => 'The :attribute: :input is already available!',
        ]);

        $data['location_address'] = strip_tags($data['location_address']);
        $data['location_desc'] = strip_tags($data['location_desc']);

        $area_of_assignments = AreaOfAssignment::create([
            'location_address' => $data['location_address'],
            'location_desc' => $data['location_desc'],
            'embedded_google_map' => $data['embedmap']
        ]);
        return redirect()->back()->with('success','Area of Assignment has been created!');
    }

    public function update_area_of_assignments(Request $request, $id){
        $data = $request->validate([
            'location_address' => 'required|max:100',
            'location_desc' => 'required|max:300',
            'embedmap' => 'max:1000'
        ],[
            'location_address.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'location_desc.max' => ':attribute field should not exceed the max lenght of :max characters!',
            'embedmap.max' => ':attribute field should not exceed the max lenght of :max characters!',
        ]);

        $data['location_address'] = strip_tags($data['location_address']);
        $data['location_desc'] = strip_tags($data['location_desc']);

        if($request->filled('location_address') || $request->filled('location_desc') || $request->filled('embedmap')){
            $area_of_assignments = AreaOfAssignment::where('id', $id)
            ->update([
                'location_address' => $data['location_address'],
                'location_desc' => $data['location_desc'],
                'embedded_google_map' => $data['embedmap'],
            ]);
            return redirect()->back()->with('success','Area of Assignment has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_area_of_assignments($id){
        $area_of_assignments = AreaOfAssignment::where('id', $id)
            ->update([
                'status_id' => ('sta-1006')
            ]);
            return redirect()->back()->with('warning','Area of assignment has been deleted!');
    }

}
