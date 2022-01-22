<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vachicle;

class VachicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vachicles = Vachicle::latest()->paginate(5);
        
        return view('pages.vachicles.index',compact('vachicles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vachicles.create');
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
            'vachicle_no'=> 'required',
            'depurture_time'=> 'required',          
        ]);

        $input = $request->all();    
        Vachicle::create($input);
     
         return redirect()->route('vachicles.index')
                        ->with('success','Vachicle created successfully.');
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
        $vachicle= Vachicle::find($id);
        return view('pages.vachicles.edit', compact('vachicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vachicle $vachicle)
    {
        $request->validate([

            'name'=> 'required',
            'vachicle_no'=> 'required',
            'depurture_time'=> 'required',          
        ]);

        $input = $request->all();

        $vachicle->update($input);

        return redirect()->route('vachicles.index')
        ->with('success','Vachicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vachicle::find($id)->delete();
        DB::delete("delete from routes where vachicle_id='$id'");
     
        return redirect()->route('vachicles.index')
        ->with('success','Vachicle deleted successfully.');
    }
}
