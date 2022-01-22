<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [   
        'class_id',
        'name',
    ];

    static function getSections(){
            $result= DB::select("select s.id,s.name,c.name class_name from classes c, sections s where c.id=s.class_id");
            return $result;
    }
}
