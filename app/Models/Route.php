<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Route extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','vachicle_id', 'time',
    ];


    // static function StudentVachicle(){
    //     $result= DB::select("select r.student_id ,r.start_point,r.destination, r.vachicle_id from students s, vachicles v, routes r where s.id=r.student_id and v.id=r.vachicle_id");
    //     return $result;
    // }
}
