<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sections = Section::getSections();
        
        return view('pages.sections.index',compact('sections'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles=Role::pluck('name','name')->all();
        $classes = Classe::latest()->paginate(5);
        return view('pages.sections.create',compact('classes'));
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

            'class_id'=> 'required', 
            'name'=> 'required',          
        ]);

        $input = $request->all();    
        Section::create($input);
     
         return redirect()->route('sections.index')
                        ->with('success','Section created successfully.');
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
        $section = Section::find($id);
        $classes=Classe::get();
        $sectionclass=DB::select("select c.id id,c.name class_name from classes c, sections s where c.id=s.class_id and s.id='$id'");
        $sectionClass=$sectionclass[0];
         
        // print(old('class_id'));
        // print_r($section->class_id);
        // print_r($sectionClass->id);

        return view('pages.sections.edit', compact('section', 'classes', 'sectionClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([

            'class_id'=> 'required', 
            'name'=> 'required',          
        ]);

        $input = $request->all(); 
        $section->update($input);

        return redirect()->route('sections.index')
        ->with('success','Section updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Section::find($id)->delete();
       
        return redirect()->route('sections.index')
        ->with('success','Section deleted successfully.');
    }
}
