<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getMiddleRoute($routename){
        // dd($routename);
     
        if(str_contains($routename, 's')){
            $routeN=rtrim($routename, 's');
        }
        if(str_contains($routename, 'ss')){
            // $routeN=substr_replace($routename ,"",-1);
            $routeN=$routename;
        }
        // dd($routeN);
        $routes=Route::getroutes();
    
        $array=array();
            foreach($routes as $route){
                if ($route->getprefix()=='student'){
                    // dd($route);
                    $data=  $route->methods()[0].":: ". $route->uri();
                                    //  dd($data);
                    if(str_contains($data,$routename) && str_contains($data,'GET')&& (!str_contains($data, 'create')) && (!str_contains($data, 'edit')) && (!str_contains($data, '{'.$routeN.'}')) && (!str_contains($data, 'DELETE'))){   
                        $array['index']=$data;   
                        // dd($array['index'])  ;
                    }
                    if(str_contains($data,$routename) && str_contains($data, 'create')){
                        
                        $array['create']=$data;    
                    }
                    if(str_contains($data,$routename) && str_contains($data, 'edit')){
                        $array['edit']=$data;    
                    }
                    if(str_contains($data,$routename) && str_contains($data, 'DELETE')){
                        
                        $array['delete']=$data;    
                    }
                    
                }    
            }
            // dd($array);
            return $array;
         
    }
    
    
        public static function getPermissionRoute($routename){
            

            if(str_contains($routename, 's')){
                $routeN=rtrim($routename, 's');
            }
            if(str_contains($routename, 'ss')){
                // $routeN=substr_replace($routename ,"",-1);
                $routeN=$routename;
            }
            // $routeN=rtrim($routename, 's');
    
            $id=Auth::user()->id;
            // dd($id);
            $role_id=DB::Table('roles')->select('id')
            ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
            ->where('model_has_roles.model_id',$id)->get()->toArray();
    
            $roleid=$role_id[0];
            // dd($roleid);
    
            $permissions=DB::Table('permissions')->select('http_uri')
                        ->join('role_has_permissions','role_has_permissions.permission_id','=','permissions.id')
                        ->where('role_has_permissions.role_id',$roleid->id)
                        ->where('http_uri', 'like', '%'.$routename.'%')->get()->toArray();
    // dd($http_uri);
    
    
            // $permissions = DB::Table('permissions')->select('http_uri')->where('http_uri', 'like', '%'.$routename.'%')->get()->toArray();
            // dd($permissions);
            $i=0;
            $pList = array();
            $pList['list']="No";
            $pList['create']="No";
            $pList['delete']="No";
            $pList['edit']="No";
    
            foreach ($permissions as $key=>$value) {
                if ((str_contains($value->http_uri, $routename)==1)&&(str_contains($value->http_uri, 'GET::')==1) && (!str_contains($value->http_uri, 'create')) && (!str_contains($value->http_uri, 'edit')) && (!str_contains($value->http_uri, '{'.$routeN.'}')) && (!str_contains($value->http_uri, 'DELETE'))) {
                    $pList['list'] = $value->http_uri;
                } 
               
                if ((str_contains($value->http_uri, 'create')==1)&&(str_contains($value->http_uri, $routename)==1)) {  
                    $pList['create'] = $value->http_uri;
                }
            
                if (str_contains($value->http_uri, 'DELETE')==1) {  
                    $pList['delete'] = $value->http_uri;
                } 
                
                if ((str_contains($value->http_uri, 'edit')==1)&&(str_contains($value->http_uri, '{'.$routeN.'}')==1)) {
                    $pList['edit'] = $value->http_uri;
                }
            
                $i++;
            }
        return $pList;
    }
}
