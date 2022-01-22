<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Classe;

class ClasseController extends Controller
{

        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $array=array();
        $routename="class";
        $array=$this->getMiddleRoute($routename);
        // dd($array);
        $index= implode("|",$array);  
// dd($array);
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
        $LClass=array();
        $class="class";
        $LClass=$this->getPermissionRoute($class);
        $classes = Classe::latest()->paginate(5);
        // dd($LClass);
        
        return view('pages.classes.index',compact('classes','LClass'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.classes.create');
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
        ]);
        $input = $request->all();    
        Classe::create($input);
     
         return redirect()->route('classes.index')
                        ->with('success','Class created successfully.');
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
        $class= Classe::find($id);
        return view('pages.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $class)
    {
        //
        $request->validate([

            'name'=> 'required',          
        ]);
        $input = $request->all();

        $class->update($input);

        return redirect()->route('classes.index')
        ->with('success','Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classe::find($id)->delete();
        DB::delete("delete from sections where class_id='$id'");
       
        return redirect()->route('classes.index')
        ->with('success','Class deleted successfully.');
    }
}
