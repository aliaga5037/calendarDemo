<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Calendar;

use Auth;

class AjaxController extends Controller
{
   public function store(Request $request)
    {
    	$calendar=new Calendar;
    	$calendar->text=$request->text;
    	$calendar->user_id=Auth::user()->id;
    	$calendar->start_date=$request->start;
    	$calendar->end_date=$request->end;
    	$calendar->save();
    }
}
