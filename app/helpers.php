<?php

use App\Models\FiscalYear;
use App\Models\Notification;
use Carbon\Carbon;

if (! function_exists('user_notifications')){

    function user_notifications(){
        return Notification::where('employee_id',auth()->user()->id)->where('status_id','sta-1007')->orderBy('created_at','desc')->get();
    }

}

if(!function_exists('timestamp_leadtime')){
    function timestamp_leadtime($timestamp){
        $current_time = Carbon::now();

        if ($timestamp->diffInMinutes($current_time) <= 59){
            if ($timestamp->diffInMinutes($current_time) == 0){
                return "just now";
            }
            elseif ($timestamp->diffInMinutes($current_time) <= 1){
                return "a minute ago";
            }
            else{
                return $timestamp->diffInMinutes($current_time)." minutes ago";
            }
        }
        elseif ($timestamp->diffInHours($current_time) <= 5){
            if ($timestamp->diffInHours($current_time) <= 1){
                return "an hour ago";
            }
            else{
                return $timestamp->diffInHours($current_time)." hours ago";
            }
        }
        elseif ($timestamp->diffInHours($current_time) <= 48){
            if (Carbon::parse($timestamp)->format('m/d/Y') == Carbon::parse($current_time)->format('m/d/Y')){
                return "Today at ".Carbon::parse($timestamp)->format('h:ia');
            }
            elseif ($timestamp->diffInHours($current_time) <= 48){
                return "Yesterday at ".Carbon::parse($timestamp)->subDay()->format('h:ia');
            }
        }
        else{
            return Carbon::parse($timestamp)->format('m/d/Y \\a\\t\ h:ia');
        }
    }
}

if(!function_exists('currentFiscalYear')){
    function currentFiscalYear(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        return $current_fiscal_year;
    }
}

if(!function_exists('lengthOfService')){
    function lengthOfService($date_hired){
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired_datetime = new DateTime($date_hired);
        $length_of_service = $current_date->diff($date_hired_datetime);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

        return $length_of_service;
    }
}
