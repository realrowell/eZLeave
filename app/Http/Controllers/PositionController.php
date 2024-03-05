<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Subdepartment;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function admin_organization_positions_grid(){
        $positions = Position::all()->where('status_id','sta-1007');
        $subdepartments = Subdepartment::all()->where('status_id','sta-1007');
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.positions_grid',
            ['positions' => $positions],
            ['subdepartments' => $subdepartments],
            ['departments' => $departments]
        );
    }
    public function admin_organization_positions_list(){
        $positions = Position::all()->where('status_id','sta-1007');
        $subdepartments = Subdepartment::all()->where('status_id','sta-1007');
        $departments = Department::all()->where('status_id','sta-1007');
        return view('profiles.admin.organization.positions_list',
            ['positions' => $positions],
            ['subdepartments' => $subdepartments],
            ['departments' => $departments]
        );
    }

    public function create_position(Request $request){
        $data = $request->validate([
            'position_title' => 'required|max:50',
            'position_description' => 'required|max:300',
            // 'subdepartment_title' => 'required|max:12'
        ]);

        $data['position_title'] = strip_tags($data['position_title']);
        $data['position_description'] = strip_tags($data['position_description']);
        // $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);

        $positions = Position::create([
            'position_title' => $data['position_title'],
            'position_description' => $data['position_description'],
            // 'subdepartment_id' => $data['subdepartment_title'],
        ]);
        return redirect()->back()->with('success','Position has been created!');
    }

    public function update_position(Request $request, $id){
        $data = $request->validate([
            'position_title' => 'max:50',
            'position_description' => 'max:300',
            // 'subdepartment_title' => 'max:12'
        ]);

        $data['position_title'] = strip_tags($data['position_title']);
        $data['position_description'] = strip_tags($data['position_description']);
        // $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);

        if($request->filled('position_title') || $request->filled('position_description') ||$request->filled('subdepartment_title')){
            $positions = Position::where('id', $id)
            ->update([
                'position_title' => $data['position_title'],
                'position_description' => $data['position_description'],
                // 'subdepartment_id' => $data['subdepartment_title'],
            ]);
            return redirect()->back()->with('success','Position has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_position($id){
        $positions = Position::where('id', $id)
        ->update([
            'status_id' => ('sta-1006')
        ]);
        return redirect()->back()->with('warning','Position has been deleted!');
    }
}

