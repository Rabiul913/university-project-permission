<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route_detail;
use App\Models\Stop;
use App\Models\Student;
use App\Models\Route;
use DB;
class RouteDetailController extends Controller
{


    function __construct()
    {
        $array=array();
        $routename="routedetails";
        $array=$this->getMiddleRoute($routename);
        $index= implode("|",$array);  

            $this->middleware('permission:'.$index, ['only' => ['index','store']]); 
            $this->middleware('permission:'.$array['create'], ['only' => ['create','store']]);
            $this->middleware('permission:'.$array['edit'],  ['only' => ['edit','update']]);
            $this->middleware('permission:'.$array['delete'], ['only' => ['destroy']]);    
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $LRDetail=array();
        $Rdetail="routes";
        $LRDetail=$this->getPermissionRoute($Rdetail);


        $schedules=DB::table('route_details')
        ->join('routes','route_details.route_id','=','routes.id')
        ->join('students','route_details.student_id','=','students.id')
        ->join('stops','route_details.start_stop_id','=','stops.id')
        ->select('route_details.id','routes.name as rname','students.name as sname','stops.name as stname')
        ->get();
        $stops=DB::table('route_details')
        ->join('stops','route_details.end_stop_id','=','stops.id')
        ->select('stops.name as ename')
        ->get();
        $j=0;

        // $schedules=([$schedule,$stops]);
// dd($stops[0]);
        return view('pages.schedules.index',compact('schedules','stops','LRDetail','j'))
        ->with('i', (request()->input('page', 0) - 0) * 5);
                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        
        $stops=Stop::latest()->paginate(5);  
        $routes=Route::latest()->paginate(5);  
        $students=Student::latest()->paginate(5);  
        return view('pages.schedules.create',compact('stops','routes','students'));


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'student_id'=> 'required', 
            'route_id'=> 'required', 
            'start_stop_id'=> 'required',  
            'end_stop_id'=> 'required',           
        ]);

        $input = $request->all();    
        Route_detail::create($input);
     
         return redirect()->route('schedules.index')
                        ->with('success','Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stops=Stop::latest()->paginate(5);  
        $routes=Route::latest()->paginate(5);  
        $students=Student::latest()->paginate(5);
        $schedule= Route_detail::find($id);

        return view('pages.schedules.edit',compact('stops','routes','students','schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route_detail $route_detail)
    {
        $request->validate([

            'student_id'=> 'required', 
            'route_id'=> 'required', 
            'start_stop_id'=> 'required',  
            'end_stop_id'=> 'required',           
        ]);
        $input = $request->all();

        $$route_detail->update($input);

        return redirect()->route('schedules.index')
        ->with('success','Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Route_detail::find($id)->delete();
               
        return redirect()->route('schedules.index')
        ->with('success','Schedule deleted successfully.');
    }

    public function getRouteDetails(Request $request) 
    { 
        // $details=DB::table('stops')
        // ->where('route_id',$id)
        // ->get();
            $id = $request->route_id; 
            $details  =DB::table('stops')
            ->where('route_id',$id)->pluck("name","id");
           
            //  dd($details);
            return $details;

        // dd($details);
        // return json_encode($details);
    }
}
