<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;


class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('read', Event::class);

        if($request->ajax()) {
                
            $dataWholeDay = DB::table('events')
                        ->select(DB::raw('CONCAT(title," - " ,users.name ) as title, events.id, CAST(start AS DATE) AS start, (CAST(DATE_ADD(end, INTERVAL 1 DAY) AS DATE)) AS end, wholeDay'))
                        ->join('users','events.user_id', '=', 'users.id')
                        ->where('start', '>=', $request->start)
                        ->where('end', '<=', $request->end)
                        ->where('wholeDay', '=', 1)
                        ->get();


          $dataNotWholeDay = DB::table('events')
                        ->select(DB::raw('CONCAT(title," - " ,users.name ) as title, events.id, start, 
                             end, wholeDay'))
                        ->join('users','events.user_id', '=', 'users.id')
                        ->where('start', '>=', $request->start)
                        ->where('end', '<=', $request->end)
                        ->where('wholeDay', '=', 0)
                        ->get();

            $leaveApplication = DB::table('leave_applications')
                                ->where('leaveStatus', '=', Config::get('constants.application_status.approve'))
                                ->select(['id', 'id as leave', 'name as title', 'startDate as start', 'endDate as end', 'fullDay as wholeDay'])
                                ->get();
                                            
            $merged = $dataWholeDay->merge($dataNotWholeDay)->merge($leaveApplication);

             return response()->json($merged);
        }
  
        session(['pageTitle' => 'Calender']);
        session(['pageTitleIcon' => 'fa fa-calendar-times-o']);

        return view('calender.all');
    }

    public function ajax(Request $request)
    {
 
        switch ($request->type) {

           case 'add':
            $this->authorize('create', Event::class);

            $validator = Validator::make($request->all(), [
              'title' => 'required',
              'start' => 'required|date',
              'end' => 'required|date|after_or_equal:start', 
            ]);

            if ($validator->passes()) {
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'wholeDay' => $request->wholeDay,
                    'user_id' => $request->user()->id,
                ]);

                return response()->json($event);
            }

          return response()->json(['error'=>$validator->errors()->all()]);        
          break;
  
           case 'update':

            $event = Event::find($request->id);

            $this->authorize('update', $event);

            $validator = Validator::make($request->all(), [
              'title' => 'required',
              'start' => 'required|date',
              'end' => 'required|date|after_or_equal:start', 
              'id' =>'required',
            ]);             

            if ($validator->passes()) {
                $event->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
                  'wholeDay' => $request->wholeDay,             
                ]);
                return response()->json($event);

            }
            return response()->json(['error'=>$validator->errors()->all()]);        
            break;
  
           case 'delete':

            $this->authorize('delete', $event);
            
            $event = Event::find($request->id);

            $validator = Validator::make($request->all(), [
              'id' =>'required',
            ]);

            if ($validator->passes()) {
              $event->delete(); 
              return response()->json($event);
            }
            return response()->json(['error'=>$validator->errors()->all()]);        
            break;
             
           default:
             # code...
             break;
        }
    }
}
