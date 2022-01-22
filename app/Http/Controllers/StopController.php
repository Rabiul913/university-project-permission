<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\Route;
use DB;

class StopController extends Controller
{

    function __construct()
    {
        $array=array();
        $routename="stops";
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
        $LStop=array();
        $stop="stops";
        $LStop=$this->getPermissionRoute($stop);
        $stops=Stop::latest()->paginate(5);        
        return view('pages.stops.index',compact('stops','LStop'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes=Route::latest()->paginate(5);   
        return view('pages.stops.create',compact('routes'));
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
            'name'=> 'required',
            'route_id'=> 'required', 
        ]);

        $input = $request->all();   
        Stop::create($input);
     
         return redirect()->route('stops.index')
                        ->with('success','Stop created successfully.');
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
        $routes=Route::latest()->paginate(5); 
        $stops=DB::table('routes')
        ->join('stops', 'routes.id', '=', 'stops.route_id')
        ->where('stops.id',$id )
        ->get();


        $stop=$stops[0];
        return view('pages.stops.edit', compact('stop', 'routes'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Stop $stop)
    {
        $request->validate([
            'name'=> 'required',
            'route_id'=> 'required', 
             
        ]);

        $input = $request->all();

        $stop->update($input);

        return redirect()->route('stops.index')
        ->with('success','Stop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
