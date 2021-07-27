<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Task;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }
    public function show(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Task::whereDate('start_date', '>=', $request->start)
                       ->whereDate('end_date',   '<=', $request->end)
                       ->get(['id', 'name', 'start_date', 'end_date']);
            return response()->json($data);
    	}
    	return view('calendar');
    }


    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
    public function statment(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Task::create([
    				'name'		=>	$request->name,
					'project_id' => $request->proj_id,
    				'start_date'		=>	$request->start_date,
    				'end_date'		=>	$request->end_date
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Task::find($request->id)->update([
    				'name'		=>	$request->title,
    				'start_date'		=>	$request->start,
    				'end_date'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Task::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}
