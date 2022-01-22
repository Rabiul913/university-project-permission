<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'student_id',
        "present_address",
        "permanent_address",
       'class_id',
       'section_id',
        "phone",
        'image',
    ];

    static function getStudents(){
        $result= DB::select("select s.id,s.student_id,s.name,s.present_address,s.permanent_address,s.email,c.name class_name, sec.name section_name,s.phone,s.image from classes c,students s, sections sec where c.id=s.class_id and sec.id=s.section_id");
        return $result;
}


}
