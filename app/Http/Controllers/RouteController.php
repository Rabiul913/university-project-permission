<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Vachicle;
use App\Models\Route;
use App\Models\Route_detail;
use App\Models\Student;

class RouteController extends Controller
{

    function __construct()
    {
        $array=array();
        $routename="routes";
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
        $LRoute=array();
        $route="routes";
        $LRoute=$this->getPermissionRoute($route);
        $routes=Route::latest()->paginate(5);        
        return view('pages.routes.index',compact('routes','LRoute'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vachicles = Vachicle::latest()->paginate(5);

        return view('pages.routes.create',compact('vachicles'));


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
            'vachicle_id'=> 'required', 
            'time'=> 'required',    
           
        ]);

        $input = $request->all();   
        // print_r($input); 
        Route::create($input);
     
         return redirect()->route('routes.index')
                        ->with('success','Route created successfully.');
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
        $route= Route::find($id);
        $vachicles = Vachicle::latest()->paginate(5);

        return view('pages.routes.edit', compact('vachicles', 'route'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'name'=> 'required',
            'vachicle_id'=> 'required', 
            'time'=> 'required',    
        ]);

        $input = $request->all();

        $route->update($input);

        return redirect()->route('routes.index')
        ->with('success','Route updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Route::find($id)->delete();
     
        return redirect()->route('routes.index')
        ->with('success','Route deleted successfully.');
    }

    public function search()
    {
        // echo "hello";
        $routes = Route::latest()->paginate(5);
        return view('pages.routes.index2', compact('routes'));

    }

    public function getRoutes($id=NULL) 
    {      
        // $id = $request->id; 
        
        // $routes = DB::select("select s.name , s.student_id , v.vachicle_no from students s,vachicles v,
        // routes r where v.id=r.vachicle_id and s.id=r.student_id and r.id='$id'");

        $routes=DB::table('routes')
        ->join('route_details','route_details.route_id','=','routes.id')
        ->join('vachicles','vachicles.id','=','routes.vachicle_id')
        ->join('students','route_details.student_id','=','students.id')
        ->select('vachicles.vachicle_no','students.name as sname','students.student_id')
        ->where('route_details.route_id',$id)
        ->get();
        
        // dd($routes);
        // return $routes ;
        // $output="";

        // foreach ($routes as $key => $route)
        // {

        // $output.='<tr>'.

        // '<td>'.$route->name.'</td>'.

        // '<td>'.$route->student_id.'</td>'.

        // '<td>'.$route->vachicle_no.'</td>'.

        // '</tr>';

        // }
        // return Response($routes);
        return json_encode($routes);
    }


}
