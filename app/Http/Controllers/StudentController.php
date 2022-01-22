<?php

namespace App\Http\Controllers;

use Rap2hpoutre\FastExcel\Facades\FastExcel;
use DB;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Student;
use App\Models\Route;
use App\Models\Vachicles;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\IOFactory;


class StudentController extends Controller
{

    function __construct()
    {
        $array=array();
        $routename="students";
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
        $LStudent=array();
        $student="students";
        $LStudent=$this->getPermissionRoute($student);
        $students = Student::getStudents();
        
        return view('pages.students.index',compact('students','LStudent'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $classes=Classe::getClasses();
        $classes = Classe::latest()->paginate(5);
        return view('pages.students.create',compact('classes'));
    }

    public function getSections(Request $request) 
    {      
        $id = $request->class_id; 
            $sections = DB::table("sections")->where("class_id",$id)->pluck("name","id");
           
            return $sections;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo $request->permanent_address;
        $request->validate([
            'name' => 'required',
            'name'=>'required',
            'email'=>'required',
            'student_id'=>'required',
            'present_address'=>'required',
            'permanent_address'=>'required',
            'class_id'=>'required',
            'section_id'=>'required',
            'phone'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();  
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/students/';
            $studentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $studentImage);
            $input['image'] = "$studentImage";
        }
        Student::create($input);
     
         return redirect()->route('students.index')
                        ->with('success','Student created successfully.');
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
        $student=Student::find($id);
        $sections=DB::select("select s.id, s.name from sections s,classes c,students std where s.class_id=std.class_id and c.id=s.class_id and std.id='$id' ");
        $classes=Classe::get();
        $sectionclass=DB::select("select c.id class_id,s.id section_id from classes c, sections s,students std where c.id=std.class_id and s.id=std.section_id and std.id='$id'");

        $sectionClass=$sectionclass[0];

        return view('pages.students.edit', compact('student','sections', 'classes', 'sectionClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'name'=>'required',
            'email'=>'required',
            'student_id'=>'required',
            'present_address'=>'required',
            'permanent_address'=>'required',
           'class_id'=>'required',
           'section_id'=>'required',
            'phone'=>'required',
        ]);

        $input = $request->all();
  
        if ($image = $request->file('image')) {
            unlink("image/students/".$student->image);
            $destinationPath = 'image/students/';
            $studentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $studentImage);
            $input['image'] = "$studentImage";
        }else{
            unset($input['image']);
        }

        $student->update($input);

        return redirect()->route('students.index')
        ->with('success','Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        unlink("image/students/".$student->image);

        $student->delete();
       
        return redirect()->route('students.index')
        ->with('success','Student deleted successfully.');
    }

    


public function exportStudent() {

    // echo 'hi';
    // Load students
    $students = DB::table('students')->join('classes','classer.id','=','students.class_id')
    ->join('sections','sections.id','=','students.section_id')
    ->select('students.*','classes.name as cname','sections.name as sname')
    ->get();
    // dd($students);
    // Export all students in excel
    FastExcel::data($students)->export('file_name.xlsx');
    
    // // Or Export all students in csv
    // FastExcel::data($students)->export('file_name.csv');
}



/**

    * @param Request $request

    * @return \Illuminate\Http\RedirectResponse

    * @throws \Illuminate\Validation\ValidationException

    * @throws \PhpOffice\PhpSpreadsheet\Exception

    */

    function importData(Request $request){




        $this->validate($request, [
 
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
 
        ]);
 
 
 
 
        $the_file = $request->file('uploaded_file');
 
        try{
 
            $spreadsheet = IOFactory::load($the_file->getRealPath());
 
            $sheet        = $spreadsheet->getActiveSheet();
 
            $row_limit    = $sheet->getHighestDataRow();
 
            $column_limit = $sheet->getHighestDataColumn();
 
            $row_range    = range( 2, $row_limit );
 
            $column_range = range( 'H', $column_limit );
 
            $startcount = 2;
 
 
 
 
            $data = array();
 
 
 
 
            foreach ( $row_range as $row ) {
 
                $data[] = [
 
                    // 'CustomerName' =>$sheet->getCell( 'A' . $row )->getValue(),
 
                    // 'Gender' => $sheet->getCell( 'B' . $row )->getValue(),
 
                    // 'Address' => $sheet->getCell( 'C' . $row )->getValue(),
 
                    // 'City' => $sheet->getCell( 'D' . $row )->getValue(),
 
                    // 'PostalCode' => $sheet->getCell( 'E' . $row )->getValue(),
 
                    // 'Country' =>$sheet->getCell( 'F' . $row )->getValue(),

                    'student_id'=>$sheet->getCell( 'A' . $row )->getValue(),
                    'name'=>$sheet->getCell( 'B' . $row )->getValue(),
                    'present_address'=>$sheet->getCell( 'C' . $row )->getValue(),
                    'permanent_address'=>$sheet->getCell( 'D' . $row )->getValue(),
                    'class_id'=>$sheet->getCell( 'E' . $row )->getValue(),
                    'section_id'=>$sheet->getCell( 'F' . $row )->getValue(),
                    'phone'=>$sheet->getCell( 'G' . $row )->getValue(),
                    'email'=>$sheet->getCell( 'H' . $row )->getValue(), 
                ];
 
                $startcount++;
 
            }
 
 
 
 
            DB::table('students')->insert($data);
 
        } catch (Exception $e) {
 
            $error_code = $e->errorInfo[1];
 
 
 
 
            return back()->withErrors('There was a problem uploading the data!');
 
        }
 
        return back()->withSuccess('Great! Data has been successfully uploaded.');
 
 
 
 
    }
 
 
   /**

    * @param $customer_data

    */

    public function ExportExcel($student_data){

        ini_set('max_execution_time', 0);
 
        ini_set('memory_limit', '4000M');
 
 
 
 
        try {
 
            $spreadSheet = new Spreadsheet();
 
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
 
            $spreadSheet->getActiveSheet()->fromArray($student_data);
 
 
 
 
            $Excel_writer = new Xls($spreadSheet);
 
            header('Content-Type: application/vnd.ms-excel');
 
            header('Content-Disposition: attachment;filename="Student_ExportedData.xls"');
 
            header('Cache-Control: max-age=0');
 
            ob_end_clean();
 
            $Excel_writer->save('php://output');
 
            exit();
 
        } catch (Exception $e) {
 
            return;
 
        }
 
 
 
 
    }
 
 
 
 
    /**
 
     *This function loads the customer data from the database then converts it
 
     * into an Array that will be exported to Excel
 
     */
 
    function exportData(){
 
        // $data = DB::table('tbl_customer')->orderBy('CustomerID', 'DESC')->get();
        $data= DB::table('students')->join('classes','classes.id','=','students.class_id')
        ->join('sections','sections.id','=','students.section_id')
        ->select('students.*','classes.name as cname','sections.name as sname')
        ->get();
 
        // dd($data);
 
        $data_array [] = array("Studentname","StudentId","Address","ClassName","SectionName","Mobile","Email");
 
        foreach($data as $data_item)
 
        {
 
            $data_array[] = array(
 
                'Studentname'=>$data_item->name,
                'StudentId'=>$data_item->student_id,
                'Address'=>$data_item->present_address,
                'ClassName'=>$data_item->cname,
                'SectionName'=>$data_item->sname,
                'Mobile'=>$data_item->phone,
                'Email'=>$data_item->email,
            ); 
 
        }
 
        $this->ExportExcel($data_array);
 
 
 
 
    }



}
