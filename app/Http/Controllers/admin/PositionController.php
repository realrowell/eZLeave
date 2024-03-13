<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use App\Models\Position;
use App\Models\PositionLevel;
use App\Models\PositionTitles;
use App\Models\Subdepartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    /**
     * Display the Positions in Grid
     *
     *
     * POSITIONS GRID VIEW
     */
    public function admin_organization_positions_grid(){
        $positions = Position::all()->where('status_id','sta-1007');
        $subdepartments = Subdepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->get();
        $view_subdepartments = Subdepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->paginate(5);
        $departments = Department::all()->where('status_id','sta-1007');
        $position_levels = PositionLevel::all();
        $position_titles = PositionTitles::where('status_id','sta-1007')->orderBy('position_title','asc')->get();
        return view('profiles.admin.organization.positions_grid',compact('view_subdepartments'),
            [
                'positions' => $positions,
                'subdepartments' => $subdepartments,
                'position_levels' => $position_levels,
                'departments' => $departments,
                'position_titles' => $position_titles
            ]
        );
    }

    /**
     * Display the Positions in List
     *
     *
     * POSITIONS LIST VIEW
     */
    public function admin_organization_positions_list(){
        $positions = Position::where('status_id','sta-1007')->orderBy('position_description','asc')->paginate(20);
        $subdepartments = Subdepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->get();
        $departments = Department::all()->where('status_id','sta-1007');
        $position_levels = PositionLevel::all();
        $position_titles = PositionTitles::where('status_id','sta-1007')->orderBy('position_title','asc')->get();
        return view('profiles.admin.organization.positions_list',compact('positions'),
        [
            'subdepartments' => $subdepartments,
            'position_levels' => $position_levels,
            'departments' => $departments,
            'position_titles' => $position_titles
        ]
        );
    }

    public function create_position(Request $request){

        $data = $request->validate([
            'position_title' => 'required|max:50',
            'position_description' => 'required|max:300',
            'subdepartment_title' => 'required',
            'position_level' => 'required'
        ]);

        $data['position_title'] = strip_tags($data['position_title']);
        $data['position_description'] = strip_tags($data['position_description']);
        $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);
        $data['position_level'] = strip_tags($data['position_level']);

        $positions = Position::create([
            'position_title_id' => $data['position_title'],
            'position_description' => $data['position_description'],
            'subdepartment_id' => $data['subdepartment_title'],
            'position_level_id' => $data['position_level'],
        ]);
        return redirect()->back()->with('success','Position has been created!');
    }

    public function update_position(Request $request, $id){
        $data = $request->validate([
            'position_title' => 'max:50',
            'position_description' => 'max:300',
            'subdepartment_title' => 'sometimes',
            'position_level' => 'sometimes'
        ]);

        $data['position_title'] = strip_tags($data['position_title']);
        $data['position_description'] = strip_tags($data['position_description']);
        $data['subdepartment_title'] = strip_tags($data['subdepartment_title']);
        $data['position_level'] = strip_tags($data['position_level']);

        if($request->filled('position_title') || $request->filled('position_description') || $request->filled('subdepartment_title') || $request->filled('position_level')){
            $positions = Position::where('id', $id)
            ->update([
                'position_title_id' => $data['position_title'],
                'position_description' => $data['position_description'],
                'subdepartment_id' => $data['subdepartment_title'],
                'position_level_id' => $data['position_level'],
            ]);
            return redirect()->back()->with('success','Position has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_position($id){
        $positions = Position::where('id', $id)
        ->update([
            'status_id' => ('sta-1009')
        ]);
        return redirect()->back()->with('warning','Position has been deleted!');
    }

    public function create_position_title(Request $request){
        $data = $request->validate([
            'position_title' => 'required|max:50',
        ]);

        $data['position_title'] = strip_tags($data['position_title']);

        $positions = PositionTitles::create([
            'position_title' => $data['position_title'],
        ]);

        return redirect()->back()->with('success','Position Title has been created!');
    }

    public function update_position_title(Request $request, $id){
        $data = $request->validate([
            'position_title' => 'max:50',
        ]);

        $data['position_title'] = strip_tags($data['position_title']);

        if($request->filled('position_title')){
            $positions = PositionTitles::where('id', $id)
            ->update([
                'position_title' => $data['position_title']
            ]);
            return redirect()->back()->with('success','Position has been updated!');
        }
        return redirect()->back()->with('info','No changes has been made!');
    }

    public function delete_position_title($id){
        $positions = PositionTitles::where('id', $id)
        ->update([
            'status_id' => ('sta-1006')
        ]);
        return redirect()->back()->with('warning','Position has been deleted!');
    }
}

