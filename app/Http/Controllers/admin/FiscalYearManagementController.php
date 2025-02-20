<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FiscalYearManagementController extends Controller
{
    public function CreateFiscalYear(Request $request){
        $request->validate([
            'fiscalyear_title' => 'required',
            'fiscalyear_description' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $fiscalyear_check = FiscalYear::where('status_id','sta-1007')->get();
        if(count($fiscalyear_check) > 0){
            foreach($fiscalyear_check as $fiscalyear){
                if($request->start_date >= $fiscalyear->fiscal_year_start && $request->start_date <= $fiscalyear->fiscal_year_end){
                    return redirect()->back()->with('error','Fiscal Year Already Exist');
                }
                if($request->end_date >= $fiscalyear->fiscal_year_start && $request->end_date <= $fiscalyear->fiscal_year_end){
                    return redirect()->back()->with('error','Fiscal Year Already Exist');
                }
            }
        }

        $fiscalyear = FiscalYear::create([
            'fiscal_year_title' => $request->fiscalyear_title,
            'fiscal_year_description' => $request->fiscalyear_description,
            'fiscal_year_start' => $request->start_date,
            'fiscal_year_end' => $request->end_date,
            'status_id' => 'sta-1007',
        ]);

        Log::info( "SYSTEM UPDATE NOTICE || Fiscal Year Creation || ".$fiscalyear->fiscal_year_title." has been created by: ".auth()->user()->email );
        return redirect()->back()->with('success','Fiscal Year Created Successfully');
    }


    public function UpdateFiscalYear(Request $request, $fiscalyear_id){
        $request->validate([
            'fiscalyear_description' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $fiscalyear = FiscalYear::where('id',$fiscalyear_id)->first();

        if($fiscalyear->status_id == 'sta-1006'){
            return redirect()->back()->with('error','Fiscal Year is Archived');
        }

        if($fiscalyear->fiscal_year_start != $request->start_date || $fiscalyear->fiscal_year_end != $request->end_date){
            $fiscalyear_check = FiscalYear::where('status_id','sta-1007')->get();
            if(count($fiscalyear_check) > 0){
                foreach($fiscalyear_check as $fiscal_year){
                    if($request->start_date >= $fiscal_year->fiscal_year_start && $request->start_date <= $fiscal_year->fiscal_year_end){
                        return redirect()->back()->with('error','Fiscal Year Already Exist');
                    }
                    if($request->end_date >= $fiscal_year->fiscal_year_start && $request->end_date <= $fiscal_year->fiscal_year_end){
                        return redirect()->back()->with('error','Fiscal Year Already Exist');
                    }
                }
            }
        }

        $fiscalyear = FiscalYear::where('id',$fiscalyear_id)->update([
            'fiscal_year_description' => $request->fiscalyear_description,
            'fiscal_year_start' => $request->start_date,
            'fiscal_year_end' => $request->end_date,
        ]);

        Log::info( "SYSTEM UPDATE NOTICE || Fiscal Year Update || ".$fiscalyear_id." has been updated by: ".auth()->user()->email );
        return redirect()->back()->with('success','Fiscal Year Updated Successfully');
    }


    public function ArchiveFiscalYear($fiscalyear_id){
        $current_datetime = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_datetime->toDateString())->where('fiscal_year_end','>=',$current_datetime->toDateString())->first();

        if($current_fiscal_year->id == $fiscalyear_id){
            return redirect()->back()->with('error','Cannot Archive Current Fiscal Year');
        }

        $fiscalyear = FiscalYear::where('id',$fiscalyear_id)->update([
            'status_id' => 'sta-1006',
        ]);

        Log::info( "SYSTEM UPDATE NOTICE || Fiscal Year Archive || ".$fiscalyear_id." has been archived by: ".auth()->user()->email );
        return redirect()->back()->with('success','Fiscal Year Archived Successfully');
    }

    public function UnArchiveFiscalYear($fiscalyear_id){
        $current_datetime = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_datetime->toDateString())->where('fiscal_year_end','>=',$current_datetime->toDateString())->first();

        $fiscalyear = FiscalYear::where('id', $fiscalyear_id)->first();

        // Check if there is an active fiscal year with the same start and end date
        $existing_fiscal_year = FiscalYear::where('fiscal_year_start', $fiscalyear->fiscal_year_start)
                                        ->where('status_id', 'sta-1007')
                                        ->orWhere('fiscal_year_end', $fiscalyear->fiscal_year_end)
                                        ->where('status_id', 'sta-1007')
                                        ->first();

        if ($existing_fiscal_year) {
            return redirect()->back()->with('error', 'Cannot Unarchive Fiscal Year with the same start and end date as an active Fiscal Year');
        }

        $fiscalyear = FiscalYear::where('id',$fiscalyear->id)->update([
            'status_id' => 'sta-1007',
        ]);

        Log::info( "SYSTEM UPDATE NOTICE || Fiscal Year Unarchive || ".$fiscalyear_id." has been unarchived by: ".auth()->user()->email );
        return redirect()->back()->with('success','Fiscal Year Unarchived Successfully');
    }

    public function DeleteFiscalYear($fiscalyear_id){
        $fiscalyear = FiscalYear::where('id',$fiscalyear_id)->update([
            'status_id' => 'sta-1009',
        ]);

        Log::info( "SYSTEM UPDATE NOTICE || Fiscal Year Delete || ".$fiscalyear_id." has been deleted by: ".auth()->user()->email );
        return redirect()->back()->with('success','Fiscal Year Deleted Successfully');
    }
}
